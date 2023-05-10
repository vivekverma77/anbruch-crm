<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| SMTP EMAIL DETAILS
| -------------------------------------------------------------------
| This file contains an array of smtp email settings.It is used by send emails functions.
|
*/
$config['email'] = Array(
'protocol' => 'smtp',
'smtp_host' => 'email-smtp.us-east-1.amazonaws.com',
'smtp_port' => '25',
'smtp_timeout' => '30',
'smtp_user' => 'AKIAIVI4J47XQIZVE2GA',
'smtp_pass' => 'ApA/3Qe730Emsn0Rda/z2LySnJIaigx6ViZf4dp1NVax',
'charset' => 'utf-8',
'wordwrap' => TRUE,
'mailtype' => 'html',
'newline' => "\r\n",
'validation' => TRUE
);
/*$config['email'] = Array(
'protocol' => 'Smtp',
'smtp_host' => 'email-smtp.us-east-1.amazonaws.com',
'smtp_port' => '587',
'smtp_timeout' => '30',
'smtp_user' => 'AKIAIVI4J47XQIZVE2GA',
'smtp_pass' => 'ApA/3Qe730Emsn0Rda/z2LySnJIaigx6ViZf4dp1NVax',
'charset' => 'utf-8',
'wordwrap' => TRUE,
'mailtype' => 'html',
'newline' => "\r\n",
'validation' => TRUE
);*/
?>
