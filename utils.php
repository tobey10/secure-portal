<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';

    function sendEmail($to, $toName, $subj, $msg) {
		$mail = new PHPMailer(true);
		try {
	    //Server settings
	    $mail->isSMTP();
	    $mail->Host       = SMTP_HOST;
	    $mail->SMTPAuth   = true;
	    $mail->Username   = SMTP_USERNAME;
	    $mail->Password   = SMTP_PASSWORD;
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	    $mail->Port       = SMTP_PORT;

	    //Recipients
	    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
	    $mail->addAddress($to, $toName);

	    // Content
	    $mail->isHTML(true);
	    $mail->Subject = $subj;
	    $mail->Body    = $msg;

	    $mail->send();
	    return true;
		} 
		catch(Exception $e) {
			return false;
		}
	}