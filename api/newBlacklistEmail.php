<?php
	include 'dbConnection.php';

    $response['message'] = '';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];

        header('Content-Type: application/json; charset=utf-8');

        try {

            $sql = "SELECT * FROM `blocklist_tbl` WHERE `email` = '". $email ."'";
            $result = $conn->query($sql);

            if(mysqli_num_rows($result) > 0){
                $response['isExisting'] = true;
                echo json_encode($response);
            }else{
                $stmtGuest = $conn->prepare("INSERT INTO blocklist_tbl (email) VALUES (?)");
                $stmtGuest->bind_param("s", $email);

                $stmtGuest->execute();

                $response['isExisting'] = false;
                $response['message'] = 'Action Success';
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