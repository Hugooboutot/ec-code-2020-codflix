<?php

require_once( 'model/user.php' );

if (isset($_POST['send'])) {
	sendEmail($_POST['send']);
	echo $_POST['send'];
}

function contact() {

	require('view/auth/contactView.php');

	if (isset($_POST['send'])) {
		sendEmail($_POST['subject'], $_POST['message']);
	}

}

function sendEmail( $sujet ) {

	//  $to      = 'hugo.anthonyboutot@gmail.com';
	//  $message = $post['message'];
	//  $headers = 'From: ' . $post['email'] . "\r\n" . $post['name'];
	 
	//  mail($to, $message, $headers);
}

?>