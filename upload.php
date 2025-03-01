<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';


if (isset($_POST['submit']) && isset($_FILES['image'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['image']['name']);
    $filePath = $uploadDir . $fileName;

    // Validate the uploaded file
    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        die('Error: Only JPG, JPEG, PNG, and GIF files are allowed.');
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
        if (sendEmailWithAttachment($filePath, $fileName)) {
            echo 'Email sent successfully!';
        } else {
            echo 'Failed to send email.';
        }
        // Optionally, delete the uploaded file after sending the email
        // unlink($filePath);
    } else {
        echo 'Failed to upload file.';
    }
}

function sendEmailWithAttachment($filePath, $fileName) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ahmedelhassan2234@gmail.com'; // Replace with your Gmail address
        $mail->Password = '55646620Az';    // Replace with your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'Your Name');
        $mail->addAddress('ahmedelhassan2234@gmail.com'); // Recipient's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Image Uploaded';
        $mail->Body    = 'An image has been uploaded. Please find the attachment below.';

        // Attach the uploaded file
        $mail->addAttachment($filePath, $fileName);

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

echo "hello";
?>
