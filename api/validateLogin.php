<?php
	session_start();
    unset($_SESSION['errorMsg']);

	include 'dbConnection.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$encryptedPassword = md5($password);

		// QUERY
		$sql = "SELECT * FROM `admin_tbl` WHERE `username` = '". $username ."'";
		$result = $conn->query($sql);

		// RESULT
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				if($username == $row['username'] && $encryptedPassword == $row['password']){
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $username;
					$_SESSION['name'] = $row['name'];
					$_SESSION['password'] = $encryptedPassword;
					$_SESSION['role'] = $row['role'];
					$_SESSION['permissions'] = json_decode($row['permissions']);
					header('location: /admin/dashboard.php');
				}else{
					$_SESSION['errorMsg'] = 'Incorrect username and password';
					header('location:/admin.php');
				}
			}
		}else{
			$_SESSION['errorMsg'] = 'Incorrect username and password';
			header('location:/admin.php');
		}
	}else{
		header('location:/admin.php');
	}

?>