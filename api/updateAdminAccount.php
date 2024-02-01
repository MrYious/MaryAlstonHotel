<?php
	include 'dbConnection.php';

    header('Content-Type: application/json; charset=utf-8');

    // Settings
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $old = $_POST['old'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        $encryptedNewPassword = md5($password1);

        if( $password1 !== $password2){
            $response['message'] = 'Password does not match';
            echo json_encode($response);
        }else{
            $sql = "UPDATE admin_tbl SET username='".$username."', name='".$name."', password='". $encryptedNewPassword."' WHERE username='".$old['username']."'";
            $conn->query($sql);
            $response['message'] = 'Account Updated Successfully';
            $response['isSuccess'] = true;
            echo json_encode($response);
        }

    }else{
		header('location:/admin/settings.php');
    }

?>