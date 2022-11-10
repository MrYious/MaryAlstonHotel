<?php
	include 'dbConnection.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id = $_POST['id'];
		$status = $_POST['status'];

        // QUERY
		$sql = "UPDATE booking_tbl SET bookingStatus='". $status ."' WHERE id='". $id ."'";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>