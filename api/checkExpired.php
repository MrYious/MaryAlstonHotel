<?php
	include 'dbConnection.php';

    // header('Content-Type: application/json; charset=utf-8');
    $bookings = [];
    $dateToday = getdate()['year'].'-'.getdate()['mon'].'-'.getdate()['mday'];
    // ALL PENDING, CONFIRMED, RESCHEDULED
    $sql = "SELECT * FROM booking_tbl WHERE (inTime IS null AND outDate <= '".$dateToday."' ) AND (bookingStatus='Confirmed' || bookingStatus='Pending' || bookingStatus='Rescheduled')  ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $bookings[$i++] = $row;
            $sql = "UPDATE booking_tbl SET bookingStatus='Expired' WHERE id='".$row['id']."'";
            $conn->query($sql);
        }
    }

    // $response['bookings'] = $bookings;
    // echo json_encode($response);
    // echo count($bookings);
    // echo $dateToday;
?>