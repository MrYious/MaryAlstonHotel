<?php
	include 'dbConnection.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$enabled = $_POST['enabled'];
		$type = $_POST['type'];

        // QUERY
		$sql = "UPDATE discount_tbl SET enabled='". $enabled ."' WHERE type='". $type ."'";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>