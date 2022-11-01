<?php
    // ALL Reservations All Room
	include 'dbConnection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $roomCode = $_POST['roomCode'];

        header('Content-Type: application/json; charset=utf-8');

        $guests = [];
        $bookings = [];

        // ALL GUESTS
        $sql = "SELECT * FROM guest_tbl";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_assoc()) {
                $guests[$i++] = $row;
            }
        }

        // ALL PENDING, CONFIRMED, RESCHEDULED
        $sql = "SELECT * FROM booking_tbl WHERE roomCode='". $roomCode ."' && (bookingStatus='Confirmed' || bookingStatus='Pending' || bookingStatus='Rescheduled')  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_assoc()) {
                $bookings[$i++] = $row;
            }
        }

        $response['guests'] = $guests;
        $response['bookings'] = $bookings;
        echo json_encode($response);

    } else {
		header('location:/');
    }
?>