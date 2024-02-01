<?php
	include 'dbConnection.php';

    $response['message'] = '';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $permissions = $_POST['permissions'];

        $encryptedPassword = md5($password1);
        $permissionsJSON = json_encode($permissions);

        header('Content-Type: application/json; charset=utf-8');

        try {

            $sql = "SELECT * FROM `admin_tbl` WHERE `username` = '". $username ."'";
            $result = $conn->query($sql);

            if(mysqli_num_rows($result) > 0){
                $response['message'] = 'Username is already registered';
                echo json_encode($response);
            }else if( $password1 !== $password2){
                $response['message'] = 'Password does not match';
                echo json_encode($response);
            }else{
                $stmtGuest = $conn->prepare("INSERT INTO admin_tbl (username, name, password, permissions) VALUES (?,?,?,?)");
                $stmtGuest->bind_param("ssss", $username, $name, $encryptedPassword, $permissionsJSON);

                $stmtGuest->execute();

                $response['message'] = 'New Account Created Successfully';
                $response['isSuccess'] = true;
                echo json_encode($response);
            }
        } catch(PDOException $e){

            $response['message'] = 'Action Failed';
            echo json_encode($response);

        }
    }else{
		header('location:/');
    }

?>