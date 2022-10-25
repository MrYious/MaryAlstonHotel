<?php
	include 'dbConnection.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST['formData'];

        header('Content-Type: application/json; charset=utf-8');
        // $response['msg'] = 'New Guests Fail';
        // echo json_encode($response);

        try {

            $stmtGuest = $conn->prepare("INSERT INTO guest_tbl (firstname, lastname, birthdate, fromTua, email, mobileNo) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtGuest->bind_param("ssssss", $firstname, $lastname, $birthdate, $fromTua, $email, $mobileNo );

            $firstname = $data['guestInfo']['firstName'];
            $lastname = $data['guestInfo']['lastName'];
            $birthdate = $data['guestInfo']['birthDate'];
            $fromTua = $data['guestInfo']['fromTua'];
            $email = $data['guestInfo']['email'];
            $mobileNo = $data['guestInfo']['mobileNo'];

            $stmtGuest->execute();

            $response['msgGuest'] = 'New Guests Success';
            $response['guestID'] = $stmtGuest->insert_id;
            $response['transactionCode'] = uniqid() . '-' . $stmtGuest->insert_id;

            $stmtBooking = $conn->prepare("INSERT INTO booking_tbl (transactionCode, guest_id, roomCode, inDate, outDate, nights, children, adult, guests, specialRequests, costFirst, costSecond, costTotal)
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmtBooking->bind_param("siissiiiissss", $transactionCode, $guest_id, $roomCode, $inDate, $outDate, $nights, $children, $adult, $guests, $specialRequests, $costFirst, $costSecond, $costTotal );

            $transactionCode =  $response['transactionCode'];
            $guest_id = $response['guestID'];
            $roomCode = $data['roomDetail']['id'];
            $inDate = $data['inDate'];
            $outDate = $data['outDate'];
            $nights = $data['nights'];
            $children = $data['guests']['children'];
            $adult = $data['guests']['adults'];
            $guests = $data['guests']['total'];
            $specialRequests = $data['guestInfo']['specialRequests'];
            $costFirst = $data['costs']['firstNight'];
            $costSecond = $data['costs']['otherNights'];
            $costTotal = $data['costs']['total'];

            $stmtBooking->execute();

            $response['msgBooking'] = 'New Booking Success';
            $response['bookingID'] = $stmtBooking->insert_id;

            echo json_encode($response);

        } catch(PDOException $e){

            $response['msg'] = 'Submission Failed';
            echo json_encode($response);

        }
    }else{
		header('location:/');
    }

?>