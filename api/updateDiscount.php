<?php
	include 'dbConnection.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$type = $_POST['type'];
		$codes = $_POST['codes'];
        $codesJSON = json_encode($codes);

        // QUERY
		$sql = "UPDATE discount_tbl SET codes='". $codesJSON ."' WHERE type='". $type ."'";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>