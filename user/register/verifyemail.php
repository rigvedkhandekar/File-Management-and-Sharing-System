<?php

if (isset ($_POST['user_email']) && isset ($_POST['otp']) && $_POST['verify-email'] == 1 ) {

    $email = $_POST['user_email'];
    $otp = $_POST['otp'];

    echo $email;
    echo $otp;

    $to = $email;
    $subject = 'Verify Your Email';
    $message = 'Dear user, your otp for email verification is : ' . $otp;
    $headers = 'From: kapoorkailas@gmail.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type: text/html; charset=utf-8';

         if (mail($to, $subject, $message, $headers))
                 echo "Email sent";
        else
                 echo "Email sending failed";

    echo json_encode(array('otp'=>$otp));


}
?>