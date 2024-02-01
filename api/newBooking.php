<?php
	include 'dbConnection.php';

    $EMAIL = 'maryalstonhall@gmail.com';
    $KEY = 'rzabxllhtqcupauf';
    $LINK = 'http://localhost/payment.php';

    $response['message'] = '';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once dirname(__DIR__).'/vendor/autoload.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST['formData'];
        $channel1 = $_POST['channel1'];
        $channel2 = $_POST['channel2'];
        $channel3 = $_POST['channel3'];
        $email = $data['guestInfo']['email'];

        header('Content-Type: application/json; charset=utf-8');

        try {
            $sql = "SELECT * FROM `blocklist_tbl` WHERE `email` = '". $email ."'";
            $result = $conn->query($sql);

            if(mysqli_num_rows($result) > 0){
                $response['isExisting'] = true;
            } else {
                $response['isExisting'] = false;
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

                $stmtBooking = $conn->prepare("INSERT INTO booking_tbl (transactionCode, guest_id, roomCode, inDate, outDate, nights, guests, specialRequests, costFirst, costSecond, costTotal, isDiscounted, discount, discountImage, costDiscounted)
                                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmtBooking->bind_param("siissiissssssss", $transactionCode, $guest_id, $roomCode, $inDate, $outDate, $nights, $guests, $specialRequests, $costFirst, $costSecond, $costTotal, $isDiscounted, $discountJSON, $discountImage, $costDiscounted );

                $transactionCode =  $response['transactionCode'];
                $guest_id = $response['guestID'];
                $roomCode = $data['roomDetail']['id'];
                $inDate = $data['inDate'];
                $outDate = $data['outDate'];
                $nights = $data['nights'];
                $guests = $data['guests'];
                $specialRequests = $data['guestInfo']['specialRequests'];
                $costFirst = $data['costs']['firstNight'];
                $costSecond = $data['costs']['otherNights'];
                $costTotal = $data['costs']['total'];

                $isDiscounted = $data['discount']['isDiscounted'];
                $discount = $data['discount']['discountDetails'];
                $discountJSON = json_encode($discount);
                $discountImage = $data['discount']['image'];
                $costDiscounted = round($data['discount']['costDiscounted']);

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
                $mail->Username   = $EMAIL;
                $mail->Password   = $KEY;

                $mail->IsHTML(true);
                // CHANGE
                $mail->AddAddress($data['guestInfo']['email'], $data['guestInfo']['firstName']. ' ' .$data['guestInfo']['lastName']);
                $mail->SetFrom("maryalson.hotel@gmail.com", "Mary Alson Hotel");
                $mail->Subject = "Mary Alston Hotel Reservation - Transaction # ". $response['transactionCode'];
                // CHANGE
                $dateToday =  date("M") . " " . date('d') . ", " . date('Y') ;

                $discountContent = '';
                if ($isDiscounted === 'true') {
                    $down = round(((int)$costDiscounted) / 2);
                    $discountContent = "
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
                        <tr style='height: 27px;'>
                            <td style='width: 145.812px; height: 27px; background-color: #d2ecf7; text-align: center;'>
                                <strong>
                                    Discounted Total Cost
                                </strong>
                            </td>
                            <td style='width: 276.188px; text-align: center; height: 27px;'>
                                ". number_format($costDiscounted).'.00' ."
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
                    ";
                } else {
                    $parseTotal = str_replace(',', '', $data['costs']['total']);
                    $down = ((int)$parseTotal) / 2;
                    $discountContent = "
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
                    ";
                }

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
                            ". number_format($down).'.00, a' ."
                        </strong>
                        <strong>
                            50%
                        </strong>
                        of the total amount of the booking as down payment to the reservation. Failure to pay within alloted time allows the system to automatically remove your reservation from the official list.
                    </p>
                    <p>
                        The down payment must be paid via the official payment channels provided below.
                        After a successful payment, you must submit the proof of payment in our form. The management will review the payment information in order to officialy accept your reservation.
                        <br />
                        <br />
                        Use the following link to open the payment submission form:
                        <br />
                        <strong> ". $LINK ."</strong>
                        <br />
                        <br />
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

                    <table style='width: 739px;' border='0'>
                        <tbody>
                            <tr>
                                <td style='text-align: center; width: 105px;'>&nbsp;</td>
                                <td style='width: 174px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>". $channel1['type'] ."</strong></span></p>
                                </td>
                                <td style='width: 95px;'>
                                    <p style='text-align: center;'>&nbsp;</p>
                                </td>
                                <td style='width: 245.406px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>". $channel2['type'] ."</strong></span></p>
                                </td>
                                <td style='width: 140.594px;'>&nbsp;</td>
                                <td style='width: 293px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>". $channel3['type'] ."</strong></span></p>
                                </td>
                            </tr>
                            <tr>
                                <td style='width: 105px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>Name</strong></span></p>
                                </td>
                                <td style='width: 174px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'>". $channel1['name'] ."</span></p>
                                </td>
                                <td style='width: 95px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>Name</strong></span></p>
                                </td>
                                <td style='width: 245.406px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'>&nbsp;". $channel2['name'] ."</span></p>
                                </td>
                                <td style='width: 140.594px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>Name</strong></span></p>
                                </td>
                                <td style='width: 293px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'>". $channel3['name'] ."</span></p>
                                </td>
                            </tr>
                            <tr>
                                <td style='width: 105px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>Number</strong></span></p>
                                </td>
                                <td style='width: 174px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'>". $channel1['number'] ."</span></p>
                                </td>
                                <td style='width: 95px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>Number</strong></span></p>
                                </td>
                                <td style='width: 245.406px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'>". $channel2['number'] ."</span></p>
                                </td>
                                <td style='width: 140.594px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'><strong>Number</strong></span></p>
                                </td>
                                <td style='width: 293px;'>
                                    <p style='text-align: center;'><span style='font-size: 12px;'>". $channel3['number'] ."</span></p>
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
                                    ". $data['guests'] ."
                                </td>
                            </tr>
                            ". $discountContent ."
                        </tbody>
                    </table>
                ";
                $mail->MsgHTML($content);
                if(!$mail->Send()) {
                    $response['message'] = "Failed: Email not sent";
                    var_dump($mail);
                } else {
                    $response['message'] = "Email sent successfully";
                }
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