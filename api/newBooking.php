<?php
	include 'dbConnection.php';

    $response['message'] = '';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once dirname(__DIR__).'/vendor/autoload.php';

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

            // SEND EMAIL

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Mailer = "smtp";

            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "maryalson.hotel@gmail.com";
            $mail->Password   = "rwylvdyjpurorlgk";

            $mail->IsHTML(true);
            // CHANGE
            $mail->AddAddress($data['guestInfo']['email'], $data['guestInfo']['firstName']. ' ' .$data['guestInfo']['lastName']);
            $mail->SetFrom("maryalson.hotel@gmail.com", "Mary Alson Hotel");
            $mail->Subject = "Mary Alston Hotel Reservation - Transaction # ". $response['transactionCode'];
            // CHANGE
            $dateToday =  date("M") . " " . date('d') . ", " . date('Y') ;
            $parseTotal = str_replace(',', '', $data['costs']['total']);
            $down = ((int)$parseTotal) / 2;

            $content = "
                <p>
                    Date:
                    <strong>
                        ". $dateToday ."
                    </strong>
                </p>
                <p>
                    Transaction Number:
                    <strong>
                        ". $response['transactionCode'] ."
                    </strong>
                </p>
                <p>
                    &nbsp;
                    <br />
                    Good Day,
                    <strong>
                        ". $data['guestInfo']['firstName'] ."
                    </strong>
                    !
                    <br />
                    <br />
                    Thank you for booking with us today! This email contains information about your reservation and how to make it official by paying the required down payment.&nbsp;
                </p>
                <p>
                    You now have
                    <strong>
                        48 hrs (2 days)
                    </strong>
                    to pay atleast
                    <strong>
                        50%
                    </strong>
                    of the total amount of the booking as down payment to the reservation. Failure to pay within alloted time allows the system to automatically remove your reservation from the official list.
                </p>
                <p>
                    The down payment must be paid via the provided official payment channels below.
                    <strong>
                        You must reply to this email by attaching a valid proof of payment such as official receipts inorder to acknowledge your payment and for us to offically confirm your reservation.
                        <br />
                        <br />
                    </strong>
                    Thank you for booking with us, we hope to hear from you again.
                </p>
                <p>
                    <strong>
                        Note:&nbsp;
                    </strong>
                    The standard check-in time starts at&nbsp;
                    <strong>
                        2 PM
                    </strong>
                    , and the guests should already check-out before&nbsp;
                    <strong>
                        12 PM
                    </strong>
                    &nbsp;in the last day.
                </p>
                <p>
                    &nbsp;
                </p>
                <p>
                    <strong>
                        Our Official Payment Channels:
                    </strong>
                </p>
                <table style='width: 527px; border-color: #030303;'>
                    <tbody>
                        <tr style='height: 25px;'>
                            <td style='width: 63px; height: 25px; text-align: center;'>
                                &nbsp;
                            </td>
                            <td style='width: 150px; height: 25px; text-align: center;'>
                                <strong>
                                    GCASH
                                </strong>
                            </td>
                            <td style='width: 70.0938px; height: 25px; text-align: center;'>
                                &nbsp;
                            </td>
                            <td style='width: 115.906px; height: 25px; text-align: center;'>
                                <div class='font-bold text-base lg:text-lg'>
                                    <strong>
                                        BANK ACCOUNT
                                    </strong>
                                </div>
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 63px; height: 27px; text-align: center;'>
                                <strong>
                                    Name
                                </strong>
                            </td>
                            <td style='width: 150px; height: 27px; text-align: center;'>
                                Juan dela Cruz
                            </td>
                            <td style='width: 70.0938px; height: 27px; text-align: center;'>
                                <strong>
                                    Name
                                </strong>
                            </td>
                            <td style='width: 115.906px; height: 27px; text-align: center;'>
                                &nbsp;Juan dela Cruz
                            </td>
                        </tr>
                        <tr style='height: 29px;'>
                            <td style='width: 63px; height: 29px; text-align: center;'>
                                <strong>
                                    Number
                                </strong>
                            </td>
                            <td style='width: 150px; height: 29px; text-align: center;'>
                                09625245816
                            </td>
                            <td style='width: 70.0938px; height: 29px; text-align: center;'>
                                <strong>
                                    Number
                                </strong>
                            </td>
                            <td style='width: 115.906px; height: 29px; text-align: center;'>
                                09625245816
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>
                    <strong>
                        Guest Information:
                    </strong>
                </p>
                <table style='width: 422px; border-color: #0f0f0f;'>
                    <tbody>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Full Name
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['guestInfo']['firstName']. ' ' .$data['guestInfo']['lastName'] ."&nbsp;
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Email
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['guestInfo']['email'] ."
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Contact Number
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['guestInfo']['mobileNo'] ."
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Birth Date
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['guestInfo']['birthDate'] ."
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    From TUA
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['guestInfo']['fromTua'] ."
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Special Requests
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['guestInfo']['specialRequests'] ."&nbsp;
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>
                    <strong>
                        Booking Information:
                    </strong>
                </p>
                <table style='width: 422px; border-color: #0f0f0f;'>
                    <tbody>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Room Name
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['roomDetail']['name'] . ' - ' . $data['roomDetail']['type'] ."&nbsp;
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Check-in Date
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['inDate'] ."
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Check-out Date
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['outDate'] ."
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Number of nights
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['nights'] ."
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Number of&nbsp;guests
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['guests']['total'] ."
                            </td>
                        </tr>
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Total Cost
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". $data['costs']['total'] ."
                            </td>
                        </tr>
                        <tr style='height: 38px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Required Down Payment
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 38px;'>
                                ". number_format($down).'.00' ."
                            </td>
                        </tr>
                    </tbody>
                </table>
            ";
            $mail->MsgHTML($content);
            if(!$mail->Send()) {
                $response['message'] = "Failed: Email not sent";
                // var_dump($mail);
            } else {
                $response['message'] = "Email sent successfully";
            }

            echo json_encode($response);

        } catch(PDOException $e){

            $response['msg'] = 'Submission Failed';
            echo json_encode($response);

        }
    }else{
		header('location:/');
    }

?>