<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/*$config['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
$config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
$config['mailpath']         = '/usr/sbin/sendmail';
$config['smtp_host']        = 'localhost';
//$config['smtp_auth']        = false;
$config['smtp_user']        = 'aauger@anbruch.com';
$config['smtp_pass']        = 'aauger';
$config['smtp_port']        = 25;
$config['smtp_timeout']     = 30;                       // (in seconds)
$config['smtp_crypto']      = 'ssl';                    // '' or 'tls' or 'ssl'
$config['smtp_debug']       = 4;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
$config['smtp_auto_tls']    = false;                    // Whether to enable TLS encryption automatically if a server supports it, even if `smtp_crypto` is not set to 'tls'.
$config['smtp_conn_options'] = array();                 // SMTP connection options, an array passed to the function stream_context_create() when connecting via SMTP.
$config['wordwrap']         = true;
$config['wrapchars']        = 76;
$config['mailtype']         = 'html';                   // 'text' or 'html'
$config['charset']          = null;                     // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
$config['validate']         = true;
$config['priority']         = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
$config['crlf']             = "\n";                     // "\r\n" or "\n" or "\r"
$config['newline']          = "\n";                     // "\r\n" or "\n" or "\r"
$config['bcc_batch_mode']   = false;
$config['bcc_batch_size']   = 200;
$config['encoding']         = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.

// DKIM Signing
$config['dkim_domain']      = '';                       // DKIM signing domain name, for exmple 'example.com'.
$config['dkim_private']     = '';                       // DKIM private key, set as a file path.
$config['dkim_private_string'] = '';                    // DKIM private key, set directly from a string.
$config['dkim_selector']    = '';                       // DKIM selector.
$config['dkim_passphrase']  = '';                       // DKIM passphrase, used if your key is encrypted.
$config['dkim_identity']    = '';                       // DKIM Identity, usually the email address used as the source of the email.

$config['email'] = $config;*/

$config['email2'] = Array(
'protocol' => 'smtp',
'smtp_host' => 'smtp.gmail.com',
'smtp_port' => '587',
'smtp_timeout' => '30',
'smtp_user' => 'clientservices@anbruch.com',
'smtp_pass' => 'client@crm',
'charset' => 'utf-8',
'wordwrap' => TRUE,
'mailtype' => 'html',
'newline' => "\r\n",
'validation' => TRUE,
'smtp_debug' => 4,
'smtp_auto_tls' => false,
'_smtp_auth'=>TRUE,
'smtp_crypto' =>'tls' 
);

$config['email'] = Array(
'protocol' => 'smtp',
'smtp_host' => 'smtp.gmail.com',
'smtp_port' => '587',
'smtp_timeout' => '30',
'smtp_user' => 'adminservices@anbruch.com',
'smtp_pass' => 'admin@crm',
'charset' => 'utf-8',
'wordwrap' => TRUE,
'mailtype' => 'html',
'newline' => "\r\n",
'validation' => TRUE,
'smtp_debug' => 4,
'smtp_auto_tls' => false,
'_smtp_auth'=>TRUE,
'smtp_crypto' =>'tls' 
);