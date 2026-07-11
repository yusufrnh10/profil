<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = strip_tags(trim($_POST["name"]));
  $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  $mail = new PHPMailer(true);

  try {
    // Konfigurasi Gmail SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'yusufhidayat10@gmail.com'; // email kamu
    $mail->Password   = 'tfcr drjd xnow azni'; // App Password Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Pengirim & penerima
    $mail->setFrom('yusufhidayat10@gmail.com', 'Website Portfolio');
    $mail->addAddress('yusufhidayat10@gmail.com'); 
    $mail->addReplyTo($email, $name);

    // Konten email
    $mail->isHTML(true);
    $mail->Subject = "Pesan Baru dari Website: $subject";
    $mail->Body    = "
      <h3>Pesan Baru dari Website Portfolio</h3>
      <p><strong>Nama:</strong> $name</p>
      <p><strong>Email:</strong> $email</p>
      <p><strong>Subjek:</strong> $subject</p>
      <p><strong>Pesan:</strong><br>$message</p>
    ";

    $mail->send();
    echo 'OK';
  } catch (Exception $e) {
    echo "Pesan tidak dapat dikirim. Error: {$mail->ErrorInfo}";
  }
}
?>