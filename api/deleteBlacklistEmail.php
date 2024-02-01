<?php
	include 'dbConnection.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id = $_POST['id'];

        // QUERY
		$sql = "DELETE FROM blocklist_tbl WHERE id='". $id ."'";
        $conn->query($sql);

    }else{
		header('location:/');
    }

?>