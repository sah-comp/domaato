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
    public function getAttributes($layout = 'table')
    {
        return array(
            array(
                'name' => 'content',
                'sort' => array(
                    'name' => 'content'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
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
        $mail->Charset = 'UTF-8';
        $mail->Subject = utf8_decode(I18n::__('domaato_report_subject'));
        $mail->From = 'no-reply@domaato.7ich.de';
        $mail->FromName = utf8_decode('no-reply');
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
        $body_html = '<h1>Test Domaato report broadcast</h1>';
        $body_text = 'Test Domaato report broadcast';
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
        if (! $this->bean->getId()) {
            $this->bean->stamp = time();
            $this->bean->person->setWilsonScore($this->bean->vote);
            $this->broadcast();
        }
        parent::update();
    }

    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('content', array(
            new Validator_HasValue()
        ));
    }
}
