<?php
	include 'dbConnection.php';
    date_default_timezone_set('Asia/Singapore');
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

    $sql = "SELECT * FROM booking_tbl WHERE bookingStatus='Pending' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $bookings[$i++] = $row;
            $dateToday = new DateTime();
            // $dateToday->add(new DateInterval('P2D'));
            $dateToday = $dateToday->format('Y-m-d H:i:s');

            $bookingDate = new DateTime($row['createdAt']);
            $bookingDate->add(new DateInterval('P2D'));
            $expirationDate = $bookingDate->format('Y-m-d H:i:s');

            // echo $dateToday;
            // echo "<br>";
            // echo $expirationDate;
            // echo "<br>";
            // TRUE => EXPIRED
            // FALSE => GOODS
            if(!($expirationDate > $dateToday)){
                $sql = "UPDATE booking_tbl SET bookingStatus='Expired' WHERE id='".$row['id']."'";
                $conn->query($sql);
            }
        }
    }

    // $response['bookings'] = $bookings;
    // echo json_encode($response);
    // echo count($bookings);
    // echo $dateToday;
?>