<?php
/**
 * Cinnebar.
 *
 * @package Domaato
 * @subpackage Model
 * @author $Author$
 * @version $Id$
 */

/**
 * Report model.
 *
 * @package Domaato
 * @subpackage Model
 * @version $Id$
 */
class Model_Report extends Model
{
    /**
     * Returns an array with attributes for lists.
     *
     * @param string (optional) $layout
     * @return array
     */
    public function getUser() {
        if ( ! $this->bean->user) {
            $this->bean->user = R::dispense('user');
        }
        return $this->bean->user;
    }

    public function getAttributes($layout = 'table')
    {
        return array(
            array(
                'name' => 'person_name',
                'callback' => array(
                    'name' => 'personName'
                ),
                'sort' => array(
                    'name' => 'person.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'content',
                'sort' => array(
                    'name' => 'content'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'vote',
                'sort' => array(
                    'name' => 'vote'
                ),
                'filter' => array(
                    'tag' => 'number'
                )
            )
        );
    }

    /**
     * Returns the person name.
     *
     * @return string
     */
    public function personName()
    {
        if (! $this->bean->person) {
            return '';
        }
        return $this->bean->person->name;
    }

    /**
     * Returns SQL string.
     *
     * @param string (optional) $fields to select
     * @param string (optional) $where
     * @param string (optional) $order
     * @param int (optional) $offset
     * @param int (optional) $limit
     * @return string $sql
     */
    public function getSql($fields = 'id', $where = '1', $order = null, $offset = null, $limit = null)
    {
        $sql = <<<SQL
		SELECT
		    {$fields}
		FROM
		    {$this->bean->getMeta('type')}
		LEFT JOIN person ON person.id = person_id
		WHERE
		    {$where}
    SQL;
        //add optional order by
        if ($order) {
            $sql .= " ORDER BY {$order}";
        }
        //add optional limit
        if ($offset || $limit) {
            $sql .= " LIMIT {$offset}, {$limit}";
        }
        return $sql;
    }

    /**
     * Checks if the business this report was filed has an owner and broadcasts it if so.
     *
     * @return bool Wether a email was sent or not
     */
    public function broadcast()
    {
        if (! $this->bean->person->owner()->getId()) {
            return false;
        }
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->Subject = utf8_decode(I18n::__('domaato_report_owner_subject'));
        $mail->From = Flight::setting()->nlemailaddress;
        $mail->FromName = utf8_decode(Flight::setting()->nlemailname);
        //$mail->AddReplyTo($this->bean->replytoemail, utf8_decode($this->bean->replytoname));
        /*
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true;
        $mail->Host = $this->bean->mailserver->host;
        $mail->Port = $this->bean->mailserver->port;
        $mail->Username = $this->bean->mailserver->user;
        $mail->Password = $this->bean->mailserver->pw;
        */
        $result = true;
        Flight::render('domaato/mail/' . Flight::get('language') . '/html-head', array(
            'title' => I18n::__('domaato_report_owner_subject'),
        ), 'head');

        ob_start();
        Flight::render('domaato/mail/' . Flight::get('language') . '/report-owner-html', array(
            'record' => $this->bean
        ));
        $body_html = ob_get_contents();
        ob_end_clean();

        ob_start();
        Flight::render('domaato/mail/' . Flight::get('language') . '/report-owner-text', array(
            'record' => $this->bean
        ));
        $body_text = ob_get_contents();
        ob_end_clean();

        $mail->MsgHTML($body_html);
        $mail->AltBody = $body_text;
        $mail->ClearAddresses();
        $mail->AddAddress($this->bean->person->owner()->email);
        return $result = $mail->Send();
    }

    /**
     * Update.
     */
    public function update()
    {
        if ($this->bean->person_id) {
            $this->bean->person = R::load('person', $this->bean->person_id);
        } else {
            unset($this->bean->person);
        }
        if (! $this->bean->getId()) {
            $this->bean->stamp = time();
            $this->bean->person->setWilsonScore($this->bean->vote);
            //$this->broadcast();
        }
        parent::update();
    }

    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('person_id', array(
            new Validator_HasValue()
        ));
        $this->addValidator('content', array(
            new Validator_HasValue()
        ));
    }
}
