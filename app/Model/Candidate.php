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
 * Candidate model.
 *
 * @package Domaato
 * @subpackage Model
 * @version $Id$
 */
class Model_Candidate extends Model
{

    /**
     * Salt for the opt-in token.
     */
    const SALT = 'z7adMM&%dasklja133q_kkllSD//&';

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
                'name' => 'email',
                'sort' => array(
                    'name' => 'email'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'token',
                'sort' => array(
                    'name' => 'token'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'stamp',
                'sort' => array(
                    'name' => 'stamp'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
        );
    }
    
    /**
     * Sends an email to that address providing a link that has to be clicked within a time span
     * to actually set the email address on the mailing list.
     *
     * @return bool Wether a email was sent or not
     */
    public function broadcast()
    {
        $mail = new PHPMailer();
        $mail->Charset = 'UTF-8';
        $mail->Subject = utf8_decode( I18n::__( 'domaato_candidate_invite_subject' ) );
        $mail->From = 'no-reply@domaato.7ich.de';
        $mail->FromName = utf8_decode( 'no-reply' );
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
        $body_html = '<h1>Test Domaato candidate invite</h1>';
        $body_html .= '<p><a href="' . Url::host() . Url::build('/newsletter/confirm/' . urlencode( $this->bean->token ) ) . '">' . I18n::__( 'domaato_newsletter_confirm' ) . '</a></p>';
        $body_text = 'Test Domaato candidate invite';
        $mail->MsgHTML( $body_html );
        $mail->AltBody = $body_text;
        $mail->ClearAddresses();
        $mail->AddAddress( $this->bean->email );
        return $result = $mail->Send();
    }
    
    /**
     * Update.
     */
    public function update()
    {
        if ( ! $this->bean->getId()) {
            $this->bean->token = md5( Model_Candidate::SALT . $this->bean->email );
            $this->bean->stamp = time();
        }
        parent::update();
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('email', array(
            new Validator_IsEmail(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'email'))
        ));
    }
}
