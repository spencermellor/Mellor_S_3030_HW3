<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json; charset=UTF-8');

$results = [];

$visitor_name = '';
$visitor_email = '';
$visitor_message = '';

if (isset($_POST['firstname'])) {
    $visitor_name = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
}

if (isset($_POST['lastname'])) {
    $visitor_name .= ' '.filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['email'])) {
    $visitor_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}
if (isset($_POST['message'])) {
    $visitor_message = filter_var(htmlspecialchars($_POST['message']), FILTER_SANITIZE_STRING);
}

$results['email'] = $visitor_email;
$results['name'] = $visitor_name;

$email_headers = array(
    'From'=>$visitor_email
);

$email_subject = "Inquiry from Porfolio Website";
$email_recipient = "spencercmellor@gmail.com";
$email_message = sprintf('Name: %s, Email %s, Message: %s', $visitor_name, $visitor_email, $visitor_message);
$email_message = 'hello';

$email_result = mail($email_recipient, $email_subject, $email_message, $email_headers);

if ($email_result) {
    $results['message'] = $email_result;
} else {
    $results['message'] = 'Error, it broken'.$email_result   ;
}

echo json_encode($results);