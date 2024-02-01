<?php
	include 'dbConnection.php';

    $response['message'] = '';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        header('Content-Type: application/json; charset=utf-8');

        try {
            $stmtGuest = $conn->prepare("INSERT INTO message_tbl (name, email, message) VALUES (?,?,?)");
            $stmtGuest->bind_param("sss", $name, $email, $message);

            $stmtGuest->execute();

            $response['message'] = 'Action Success';
            echo json_encode($response);
        } catch(PDOException $e){

            $response['message'] = 'Action Failed';
            echo json_encode($response);

        }
    }else{
		header('location:/');
    }

?>