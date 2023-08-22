<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Form data
$name = $_POST['name'];
$email = $_POST['email'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$package = $_POST['package'];
$countrycode = $_POST['countrycode'];

// Create a new PHPMailer instance
$mail = new PHPMailer;

// SMTP configuration (change these values with your own)
$mail->isSMTP();
$mail->Host = 'mail.gtron.io';
$mail->SMTPAuth = true;
$mail->Username = 'no-reply@gtron.io';
$mail->Password = 'gTron@12@';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

// Sender and recipient
$mail->setFrom('no-reply@gtron.io', 'GTron');
$mail->addAddress('lavkushtari78@gmail.com', 'GTron');

// Email content
$mail->isHTML(true);
$mail->Subject = 'Form Submission';
$mail->Body = "Name: $name<br>Email: $email<br>Country: $country<br>Phone: $phone<br>Package: $package<br>Plan: $plan";

// Send email
if ($mail->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}
?>
