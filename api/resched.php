<?php
	include 'dbConnection.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id = $_POST['id'];
		$newIn = $_POST['newIn'];
		$newOut = $_POST['newOut'];

        // QUERY
		$sql = "UPDATE booking_tbl SET inDate='". $newIn ."', outDate='". $newOut ."', bookingStatus='Rescheduled' WHERE id='". $id ."'";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>