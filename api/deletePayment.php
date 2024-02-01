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
		$isSend = $_POST['isSend'];
		$message = $_POST['message'];
		$email = $_POST['email'];
		$name = $_POST['name'];

        // QUERY
		$sql = "DELETE FROM payment_list_tbl WHERE id='". $id ."'";
        $conn->query($sql);

		if($isSend === 'true'){
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
			$mail->Subject = "Mary Alston Hotel - Payment Rejected";
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
					We have received your submission for the payment of the reservation
					<br />
					Unfortunately, there is an issue on your submission and we have to reject your payment submission.
				</p>
				<p>
					The management sends the following message:
					<br />
					<i>". $message ."</i>
				</p>
				<p>
					<br />
					Mary Alston Hotel Management
				</p>
			";
			$mail->MsgHTML($content);
			$mail->Send();
		}

    }else{
		header('location:/');
    }

?>