<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'mailer/Exception.php';
    require 'mailer/PHPMailer.php';
    require 'mailer/SMTP.php';


    function _sendmail($sender, $recipient, $body, $subject){
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'mail.newcomersunion.com';
        $mail->Username = 'info@newcomersunion.com';
        $mail->Password = 'UkO.?OZ;q!DV';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($sender, "New Comers Union");
        $mail->addAddress($recipient, "New Comers Union");
        $mail->Priority = 1;
        $mail->AddCustomHeader("X-MSMail-Priority: High");

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        if ($mail->send()) {
            $return = array(
            'sent' => 'true',
            'error' => 'none'
            );
        }else{
            $return = array(
            'sent' => 'false',
            'error' => $mail->ErrorInfo,
            );
        }

        return $return;
    }

    function _reg($sender, $recipient, $subject, $otp){
        $body = '';
        $sent = _sendmail($sender, $recipient, $body, $subject);
        return $sent;
    }
?>