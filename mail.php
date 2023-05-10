<?php
$to = "akshayvijayvargiya697@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: softgetix.test@gmail.com";
//"CC: somebodyelse@example.com";

$success = mail($to,$subject,$txt);
//if()
if (!$success) {
	echo 'fail';
  print_r(error_get_last()['message']);
}else{
	echo 'success';
	print_r(error_get_last()['message']);
}
echo 'mail';
?>