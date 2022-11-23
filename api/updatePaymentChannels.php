<?php
	include 'dbConnection.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$channel1 = $_POST['channel1'];
		$channel2 = $_POST['channel2'];
		$channel3 = $_POST['channel3'];

        // QUERY
		$sql = "UPDATE payment_tbl SET channel1='". $channel1 ."', channel2='". $channel2 ."', channel3='". $channel3 ."' WHERE id=1 ";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>