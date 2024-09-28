<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    
    // Collect questionnaire responses
    $responses = [
        'q1' => htmlspecialchars($_POST['q1']),
        'q2' => htmlspecialchars($_POST['q2']),
        'q3' => htmlspecialchars($_POST['q3']),
        'q4' => htmlspecialchars($_POST['q4']),
        'q5' => htmlspecialchars($_POST['q5']),
        'q6' => htmlspecialchars($_POST['q6']),
        'q7' => htmlspecialchars($_POST['q7']),
        'q8' => htmlspecialchars($_POST['q8']),
        'q9' => htmlspecialchars($_POST['q9']),
        'q10' => htmlspecialchars($_POST['q10']),
    ];

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = '4380112@myuwc.ac.za'; // Your email
        $mail->Password = 'euop zwqy spwf ewlw'; // Your email password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('4380112@myuwc.ac.za', 'Tabile Dlamini'); // Your email and name
        $mail->addAddress('tabiledlamini7@gmail.com', 'Tabile Dlamini'); // Recipient's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Cybersecurity Questionnaire Submission';
        $mail->Body = "Name: $name<br>Email: $email<br>
            <strong>Responses:</strong><br>
            1. Do you know about cybersecurity? {$responses['q1']}<br>
            2. Rate your knowledge of the concept of cybersecurity: {$responses['q2']}<br>
            3. Have you ever been a victim of a cyberattack? {$responses['q3']}<br>
            4. Do you regularly update your passwords? {$responses['q4']}<br>
            5. Have you heard of two-factor authentication? {$responses['q5']}<br>
            6. Rate your confidence in identifying phishing emails: {$responses['q6']}<br>
            7. Do you use antivirus software? {$responses['q7']}<br>
            8. Have you ever taken a cybersecurity course? {$responses['q8']}<br>
            9. Do you understand what a VPN is? {$responses['q9']}<br>
            10. Rate your concern about online privacy: {$responses['q10']}<br>";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header("Location: index.html");
    exit();
}
?>
