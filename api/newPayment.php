<?php
	include 'dbConnection.php';

    $response['message'] = '';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $transCode = $_POST['transCode'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        $channel = $_POST['channel'];
        $amount = $_POST['amount'];
        $refNum = $_POST['refNum'];
        $date = $_POST['date'];
        $image = $_POST['image'];

        header('Content-Type: application/json; charset=utf-8');

        try {
            $stmtGuest = $conn->prepare("INSERT INTO payment_list_tbl (transCode, name, email, note, channel, amount, referenceNum, image, date) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmtGuest->bind_param("ssssiisss", $transCode, $name, $email, $note, $channel, $amount, $refNum, $image, $date);

            $stmtGuest->execute();

            echo json_encode($response);
        } catch(PDOException $e){
            echo json_encode($response);
        }
    }else{
		header('location:/');
    }

?>