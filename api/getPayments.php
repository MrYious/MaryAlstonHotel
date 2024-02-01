<?php
	include 'dbConnection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        header('Content-Type: application/json; charset=utf-8');

        $list = [];
        $codes = [];
        $reservations = [];

        $sql = "SELECT * FROM payment_list_tbl ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_assoc()) {
                $list[$i++] = $row;
            }
        }

        $response['list'] = $list;

        for ($i=0; $i < sizeof($list); $i++) {
            $codes[$i] = $list[$i]['transCode'];
        }

        $response['codes'] = array_unique($codes);

        $sql = "SELECT * FROM booking_tbl WHERE transactionCode IN('".implode("','",array_unique($codes))."')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $j = 0;
            while($row = $result->fetch_assoc()) {
                $reservations[$j++] = $row;
            }
        }
        $response['reservations'] = $reservations;
        echo json_encode($response);

    } else {
		header('location:/');
    }
?>