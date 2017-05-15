<?php
/**
 * Created by PhpStorm.
 * User: p2
 * Date: 7/15/14
 * Time: 11:27 AM
 */

namespace Main\CTL;


use Main\Context\Context;
use Main\Http\RequestInfo;

class BaseCTL {
    /**
     * @var Context $ctx;
     */
    public $reqInfo, $ctx;
    public function __construct(RequestInfo $reqInfo) {
        $this->reqInfo = $reqInfo;
        $this->ctx = new Context();

    }

    public function getCtx() {
        return $this->ctx;
    }

	public function mailsender ( $mailfrom, $mailto, $subject, $msg )
	{
		$mail = new \PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail serverio
		$mail->Host = 'smtp.gmail.com';
		//$mail->Host = 'mail.agent168th.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "system@agent168th.com";

		//Password to use for SMTP authentication
		$mail->Password = "12345678";

		//Set who the message is to be sent from
		$mail->setFrom($mailfrom);

		//Set an alternative reply-to address
		//$mail->addReplyTo($mailfrom, 'First Last');

		//Set who the message is to be sent to
		$mail->addAddress($mailto, 'Admin');

		//Set the subject line
		$mail->Subject = $subject;

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($msg);

		//Replace the plain text body with one created manually
		//$mail->AltBody = $msg;

		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');

		//send the message, check for errors
		if ( ! $mail->send() ) 
		{
			//echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
			//echo "Message sent!";
		}
	}
}