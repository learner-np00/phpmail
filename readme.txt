===================================
Email Sending in PHP
===================================

You can send emails in PHP using either the built-in mail() function or a more robust solution like PHPMailer. Below are the prerequisites and steps for both methods.

===================================
Using PHP's mail() Function
===================================

Prerequisites:
--------------
1. Configured Mail Server:
   Ensure your web server is configured to send mail. This typically involves setting up an SMTP server.

2. PHP Configuration:
   Make sure your php.ini file is correctly configured with the appropriate settings for sending mail.

Example:
--------
<?php
$to = 'recipient@example.com';
$subject = 'Test Mail';
$message = 'This is a test mail.';
$headers = 'From: sender@example.com' . "\r\n" .
           'Reply-To: sender@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Mail sent successfully.';
} else {
    echo 'Mail sending failed.';
}
?>

===================================
Using PHPMailer
===================================

Prerequisites:
--------------
1. Composer:
   PHPMailer is best installed via Composer, a PHP dependency manager.

2. PHPMailer Library:
   You need to include the PHPMailer library in your project.

Installation:
-------------
Run the following command to install PHPMailer using Composer:


Example:
--------
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your_email@example.com';
    $mail->Password   = 'your_email_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('your_email@example.com', 'Mailer');
    $mail->addAddress('recipient@example.com', 'Recipient Name');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Mail';
    $mail->Body    = 'This is a test mail.';
    $mail->AltBody = 'This is a test mail.';

    $mail->send();
    echo 'Mail sent successfully.';
} catch (Exception $e) {
    echo "Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

===================================
Key Differences
===================================

Configuration:
--------------
mail(): 
- Requires server-side configuration to be able to send emails.
- You need to ensure that your server has a working mail transfer agent (MTA) like Sendmail or Postfix.

PHPMailer:
- Can work with external SMTP servers, making it more versatile and reliable.
- Especially useful for shared hosting environments where you might not have control over server configurations.

Features:
---------
mail(): 
- Basic functionality.
- Limited error handling and customization.

PHPMailer:
- Advanced features like HTML emails, attachments, SMTP authentication, and better error handling.

Security:
---------
mail(): 
- Potentially less secure as it relies on the server's mail function.
- Does not include built-in protection against mail header injection.

PHPMailer:
- More secure as it allows you to use secure SMTP connections (TLS/SSL).
- Allows authentication with your email provider.

===================================
