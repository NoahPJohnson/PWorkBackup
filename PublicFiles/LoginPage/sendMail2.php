<?php

/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require_once "./vendor/autoload.php";*/


function SendAnEmail($email, $subject, $message)
{
    // the message
    //$msg = "Test Line One\nTest Line Two";

    // use wordwrap() if lines are longer than 70 characters
    $message = wordwrap($message,70);

    // send email
    if (mail($email,$subject,$message))
    {
        //echo "Success.";
    }
    else
    {
        //echo "Fail.";
    }
    
}
?>