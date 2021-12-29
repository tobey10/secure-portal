<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';


    function sendMail($to, $subject, $body, $toName){
        $mail = new PHPMailer(true);
        try{ 
            $mail->isSMTP();
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->isHTML(true);
            $mail->Username   = 'hudsonthomas094@gmail.com';
            $mail->Password   = 'thomas007$';    
            $mail->SetFrom('hudsonthomas094@gmail.com','Notifcation');
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($to, $toName);
            
            $mail->send();
    
            return true;
        }catch(Exception $e){
            return false;
        }
    }