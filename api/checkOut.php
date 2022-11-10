<?php
	include 'dbConnection.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id = $_POST['id'];
		$dateTime = $_POST['dateTime'];

        // QUERY
		$sql = "UPDATE booking_tbl SET outTime='". $dateTime ."', bookingStatus='Completed' WHERE id='". $id ."'";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>