<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'classes/mail/autoload.php';

//send_via_gmail("ducong", "dcnocomment@gmail.com", "123123");

function send_via_gmail($username, $to, $content){
    /**
     * This example shows settings to use when sending via Google's Gmail servers.
     * This uses traditional id & password authentication - look at the gmail_xoauth.phps
     * example to see how to use XOAUTH2.
     * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
     */

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
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
    $mail->Username = "dcnocomment@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "Azureshard";

    //Set who the message is to be sent from
    $mail->setFrom('from@roboslab.me', 'Robos Lab');

    //Set an alternative reply-to address
    $mail->addReplyTo('replyto@roboslab.me', 'Robos Lab');

    //Set who the message is to be sent to
    $mail->addAddress($to, $username);


    $mail->isHTML(true);
    $mail->Subject = 'Registration Confirmation';
    $mail->Body = $content;

    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

    //Replace the plain text body with one created manually
    //$mail->AltBody = $content;

    //Attach an image file
    $mail->addAttachment('assets/images/phpmailer_mini.png');

    //send the message, check for errors
    return $mail->send();

}

?>
