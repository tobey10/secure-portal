<?php
include 'sendMail.php';
session_start();
$subject = "Logged out";
$email = $_SESSION['email'];
$body = 'You have successfully logged out';
sendMail($email, $subject, $body, $user['email']);

session_destroy();
header('location: /task/login.php');
?>