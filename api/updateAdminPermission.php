<?php
	include 'dbConnection.php';

    header('Content-Type: application/json; charset=utf-8');

    // Settings
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $old = $_POST['old'];
        $permissions = $_POST['permissions'];

        $permissionsJSON = json_encode($permissions);

        $sql = "UPDATE admin_tbl SET permissions='".$permissionsJSON."' WHERE username='".$old['username']."'";
        $conn->query($sql);
        $response['message'] = 'Account Permissions Updated Successfully';
        echo json_encode($response);

    }else{
		header('location:/admin/settings.php');
    }

?>