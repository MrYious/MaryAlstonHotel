<?php
	include 'dbConnection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        header('Content-Type: application/json; charset=utf-8');

        $id = $_SESSION['id'];

        $list = [];

        $sql = "SELECT * FROM admin_tbl WHERE id='". $id ."'";
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