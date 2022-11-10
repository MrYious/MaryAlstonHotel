<?php
	include 'dbConnection.php';
    session_start();
    unset($_SESSION['errorMsg']);


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $oldUsername = $_SESSION['username'];
		$oldPassword = $_POST['oldPassword'];
		$oldEncryptedPassword = md5($oldPassword);

		$newUsername = $_POST['newUsername'];
		$newPassword = $_POST['newPassword'];
		$confirmNewPassword = $_POST['confirmNewPassword'];
		$newEncryptedPassword = md5($newPassword);

        // QUERY
		$sql = "SELECT * FROM `admin_tbl` WHERE `username` = '". $oldUsername ."'";
		$result = $conn->query($sql);

		// RESULT
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				if($oldUsername == $row['username'] && $oldEncryptedPassword == $row['password']){
                    if($newPassword === $confirmNewPassword){
                        $sql = "UPDATE admin_tbl SET username='".$newUsername."', password='". $newEncryptedPassword."' WHERE username='".$oldUsername."'";
                        if ($conn->query($sql) === TRUE) {
                            $_SESSION['username'] = $oldUsername;
                            $_SESSION['password'] = $oldEncryptedPassword;
                            header('location:/admin/settings.php');
                        } else {
                            $_SESSION['errorMsg'] = 'Error Updating Credentials';
                            header('location:/admin/settings.php');
                        }
                    } else {
                        $_SESSION['errorMsg'] = 'Incorrect username and password';
                        header('location:/admin/settings.php');
                    }
				}else{
                    $_SESSION['errorMsg'] = 'Incorrect password';
                    header('location:/admin/settings.php');
				}
			}
		}else{
			echo 'Error '.$conn->error;
            $_SESSION['errorMsg'] = 'Incorrect password';
            header('location:/admin/settings.php');
		}

    }else{
		header('location:/admin/settings.php');
    }

?>