<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

function emailSending($recipientEmail = "", $subject = "", $msgContent = "")
{
    $mail            = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '<Your Google Email>';
    $mail->Password   = '<Your Google App Password>';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('<Your Google Email>', '<Your Google name>');
    $mail->addAddress($recipientEmail);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $msgContent;

    $send = $mail->send();
    if ($send) {
        $sendMail = true;
    } else {
        $sendMail = false;
    }
    return $sendMail;
}
