<?php
// the message
$msg = "my testing message";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("softgetix.test@gmail.com","My subject",$msg);
?>