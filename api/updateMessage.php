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
		$name = $_POST['name'];
		$date = $_POST['date'];
		$emaill = $_POST['email'];
		$message = $_POST['message'];
		$response = $_POST['response'];

        // QUERY
		$sql = "UPDATE message_tbl SET response='". $response ."' WHERE id='". $id ."'";
        $conn->query($sql);

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
		$mail->AddAddress($emaill, $name);
		$mail->SetFrom("maryalson.hotel@gmail.com", "Mary Alson Hotel");
		$mail->Subject = "Mary Alston Hotel - Response";
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
				Thank you for reaching out to us!.&nbsp;
			</p>
			<p>
				We have received your following message:
				<br />
				<i>". $message ."</i>
				<br />
				<i>". $date ."</i>
			</p>
			<p>
				The management sends the following response:
				<br />
				<i>". $response ."</i>
			</p>
			<p>
				<br />
				Mary Alston Hotel Management
			</p>
		";
		$mail->MsgHTML($content);
		if(!$mail->Send()) {
			$response['message'] = "Failed: Email not sent";
		} else {
			$response['message'] = "Email sent successfully";
		}

    }else{
		header('location:/');
    }

?>