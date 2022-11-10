<?php
	include 'dbConnection.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id = $_POST['id'];
		$paid = $_POST['paid'];

        // QUERY
		$sql = "UPDATE booking_tbl SET amountPaid='". $paid ."' WHERE id='". $id ."'";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>