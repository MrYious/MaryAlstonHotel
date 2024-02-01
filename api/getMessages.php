<?php
	include 'dbConnection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        header('Content-Type: application/json; charset=utf-8');

        $list = [];

        $sql = "SELECT * FROM message_tbl ORDER BY createdAt DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_assoc()) {
                $list[$i++] = $row;
            }
        }

        $response['list'] = $list;
        echo json_encode($response);

    } else {
		header('location:/');
    }
?>