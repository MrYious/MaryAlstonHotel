<?php
	session_start();
    unset($_SESSION['errorMsg']);

	include 'dbConnection.php';

	// TODO: query database accounts

	$query = '';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if($_REQUEST['username'] == 'test' && $_REQUEST['password']=='qwertyuiop'){
			$_SESSION['username'] = 'test';
			$_SESSION['password'] = 'qwertyuiop';
			header('location: /admin/dashboard.php');
		}else{
			$_SESSION['errorMsg'] = 'Incorrect username and password';
			header('location:/admin.php');
		}
	}else{
		header('location:/admin.php');
	}

?>