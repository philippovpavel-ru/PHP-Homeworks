<?php
require_once '../vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
  ->setUsername('mu7dlkzewr61n@bk.ru')
  ->setPassword('q05jcd14h1TvvA');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['mu7dlkzewr61n@bk.ru' => 'John Doe Pavl'])
  ->setTo(['mu7dlkzewr62n@mail.ru'])
  ->setBody('Here is the message itself');

// Send the message
$result = $mailer->send($message);

var_dump($result);