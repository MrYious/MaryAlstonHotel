<?php
	include 'dbConnection.php';
    session_start();
    unset($_SESSION['errorMsg']);


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $oldUsername = $_SESSION['username'];
		$oldPassword = $_POST['oldPassword'];
		$oldEncryptedPassword = md5($oldPassword);

		$newUsername = $_POST['newUsername'];
		$newPassword = $_POST['newPassword'];
		$confirmNewPassword = $_POST['confirmNewPassword'];
		$newEncryptedPassword = md5($newPassword);

        // header('Content-Type: application/json; charset=utf-8');
        // $response['user'] = $_SESSION['username'];
        // $response['pass'] = $oldPassword;
        // echo json_encode($response);

        // QUERY
		$sql = "SELECT * FROM `admin_tbl` WHERE `username` = '". $oldUsername ."'";
		$result = $conn->query($sql);

		// RESULT
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				if($oldUsername == $row['username'] && $oldEncryptedPassword == $row['password']){
                    if($newPassword === $confirmNewPassword){
                        $sql = "UPDATE admin_tbl SET username='".$newUsername."', password='". $newEncryptedPassword."' WHERE username='".$oldUsername."'";
                        if ($conn->query($sql) === TRUE) {
                            $_SESSION['username'] = $oldUsername;
                            $_SESSION['password'] = $oldEncryptedPassword;
                            header('location:/admin/settings.php');
                        } else {
                            $_SESSION['errorMsg'] = 'Error Updating Credentials';
                            header('location:/admin/settings.php');
                        }
                    } else {
                        $_SESSION['errorMsg'] = 'Incorrect username and password';
                        header('location:/admin/settings.php');
                    }
				}else{
                    $_SESSION['errorMsg'] = 'Incorrect password';
                    header('location:/admin/settings.php');
				}
			}
		}else{
			echo 'Error '.$conn->error;
            $_SESSION['errorMsg'] = 'Incorrect password';
            header('location:/admin/settings.php');
		}


        

        // $response['msg'] = 'New Guests Fail';
        // echo json_encode($response);

        // try {

        //     $stmtGuest = $conn->prepare("INSERT INTO guest_tbl (firstname, lastname, birthdate, fromTua, email, mobileNo) VALUES (?, ?, ?, ?, ?, ?)");
        //     $stmtGuest->bind_param("ssssss", $firstname, $lastname, $birthdate, $fromTua, $email, $mobileNo );

        //     $firstname = $data['guestInfo']['firstName'];
        //     $lastname = $data['guestInfo']['lastName'];
        //     $birthdate = $data['guestInfo']['birthDate'];
        //     $fromTua = $data['guestInfo']['fromTua'];
        //     $email = $data['guestInfo']['email'];
        //     $mobileNo = $data['guestInfo']['mobileNo'];

        //     $stmtGuest->execute();

        //     $response['msgGuest'] = 'New Guests Success';
        //     $response['guestID'] = $stmtGuest->insert_id;
        //     $response['transactionCode'] = uniqid() . '-' . $stmtGuest->insert_id;

        //     $stmtBooking = $conn->prepare("INSERT INTO booking_tbl (transactionCode, guest_id, roomCode, inDate, outDate, nights, children, adult, guests, specialRequests, costFirst, costSecond, costTotal)
        //                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        //     $stmtBooking->bind_param("siissiiiissss", $transactionCode, $guest_id, $roomCode, $inDate, $outDate, $nights, $children, $adult, $guests, $specialRequests, $costFirst, $costSecond, $costTotal );

        //     $transactionCode =  $response['transactionCode'];
        //     $guest_id = $response['guestID'];
        //     $roomCode = $data['roomDetail']['id'];
        //     $inDate = $data['inDate'];
        //     $outDate = $data['outDate'];
        //     $nights = $data['nights'];
        //     $children = $data['guests']['children'];
        //     $adult = $data['guests']['adults'];
        //     $guests = $data['guests']['total'];
        //     $specialRequests = $data['guestInfo']['specialRequests'];
        //     $costFirst = $data['costs']['firstNight'];
        //     $costSecond = $data['costs']['otherNights'];
        //     $costTotal = $data['costs']['total'];

        //     $stmtBooking->execute();

        //     $response['msgBooking'] = 'New Booking Success';
        //     $response['bookingID'] = $stmtBooking->insert_id;

        //     echo json_encode($response);

        // } catch(PDOException $e){

        //     $response['msg'] = 'Submission Failed';
        //     echo json_encode($response);

        // }
    }else{
		header('location:/admin/settings.php');
    }

?>