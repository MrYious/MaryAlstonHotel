<?php
	include 'dbConnection.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // QUERY
		$sql = "INSERT INTO discount_tbl (`type`, `codes`, `enabled`) VALUES ('voucher','','true')";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>