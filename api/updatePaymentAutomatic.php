<?php
	include 'dbConnection.php';

    $EMAIL = 'maryalstonhall@gmail.com';
    $KEY = 'rzabxllhtqcupauf';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once dirname(__DIR__).'/vendor/autoload.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id = $_POST['id'];
		$hasReservation = $_POST['hasReservation'];
		$resID = $_POST['resID'];
		$paid = $_POST['paid'];
		$name = $_POST['name'];
		$email = $_POST['email'];

        // QUERY
		$sql = "UPDATE payment_list_tbl SET status='Accepted' WHERE id='". $id ."'";
        $conn->query($sql);

		if($hasReservation === 'true'){
			$sql = "UPDATE booking_tbl SET amountPaid='". $paid ."'  WHERE id='". $resID ."'";
			$conn->query($sql);
		}

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
		$mail->AddAddress($email, $name);
		$mail->SetFrom("maryalson.hotel@gmail.com", "Mary Alson Hotel");
		$mail->Subject = "Mary Alston Hotel - Payment Acknowledged";
		// CHANGE
		$dateToday =  date("M") . " " . date('d') . ", " . date('Y') ;

		$content = "
			<p>
				Date:
				<strong>
					". $dateToday ."
				</strong>
			</p>
			<p>
				&nbsp;
				<br />
				Hello,
				<strong>
					". $name ."
				</strong>
				!
				<br />
				<br />
				This email is to acknowledge the payment for your reservation!.&nbsp;
			</p>
			<p>
				Make sure to check-in in the reserved time and date. See you on our hotel!
			</p>
			<p>
				<br />
				Mary Alston Hotel Management
			</p>
		";
		$mail->MsgHTML($content);
		$mail->Send();

    }else{
		header('location:/');
    }

?>