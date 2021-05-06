<?php
$msg = 'Hello priyasskmedia, /n/n IPB Support Team';

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$phpmailsent = mail("priyasskmedia@gmail.com","Instructor Enrollment Test Email",$msg);

if($phpmailsent){
	echo "sent";
}else{
	echo "not sent";
}
?>