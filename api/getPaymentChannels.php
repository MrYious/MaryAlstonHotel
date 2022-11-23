<?php
	include 'dbConnection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        header('Content-Type: application/json; charset=utf-8');

        $channels = [];

        $sql = "SELECT * FROM payment_tbl WHERE id=1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_assoc()) {
                $channels[$i++] = $row;
            }
        }

        $response['channels'] = $channels;
        echo json_encode($response);

    } else {
		header('location:/');
    }
?>