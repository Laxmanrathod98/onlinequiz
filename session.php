<?php
	
    include('scripts/connect_db.php');

	session_start();

	$check=$_SESSION['login_username'];

	$session=$con->query("SELECT username FROM admins WHERE username='$check' ")or die("mysql_error()");

	$row=$session->fetch_assoc();

	$login_session=$row['username'];

	if(!isset($login_session)) {
		$user_msg = 'Please Login First!';
		header('location: login.php?user_msg='.$user_msg.'');
	}

?>