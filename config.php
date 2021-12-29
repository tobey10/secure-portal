
<?php

// Email Credentials
define('SMTP_HOST', 'mail.mydomain.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'name@mydomain.com');
define('SMTP_PASSWORD', '<my password>');
define('SMTP_FROM', 'noreply@mydomain.com');
define('SMTP_FROM_NAME', '<your name>');

// Code we want to run on every page/script
date_default_timezone_set('UTC'); 
error_reporting(0);
session_set_cookie_params(['samesite' => 'Strict']);
session_start();
