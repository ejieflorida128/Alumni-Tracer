<?php
session_start();
include('../connection/conn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $modal = false;
    $mail = new PHPMailer(true);

    $gmailTry = $_POST['unregisteredEmAIL'];

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'slsualumnitracer@gmail.com';
    $mail->Password = 'amll jnuc stte jpub';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('slsualumnitracer@gmail.com');
    $mail->addAddress($_POST['unregisteredEmAIL']);

    $mail->isHTML(true);

    $productName =  $_POST['unregisteredEmAIL'];
    $userName =  $_POST['unregisteredEmAIL'];
    $actionUrl = 'http://localhost/xampp/Alumni-Tracer/auth/auth_acc.php?gmail='.$_POST['unregisteredEmAIL'].'';
    $companyName = "Alumni Tracer Management System";

    $mail->Subject = "Gmail / Email Confirmation for $productName";
    $mail->Body = "
        <p>Hi $userName,</p>

        <p>Thank you for providing your <strong>Alumni Tracer</strong> account. To proceed with approving this Gmail confirmation, please click the link below:</p>

        <p><a href='$actionUrl'>$actionUrl</a></p>

        <p>If you did not make this request, please ignore this email. If you have any questions, feel free to contact our support team.</p>

        <p>Thank you,<br>The $companyName Team</p>

        <hr>
        <p><small>&copy; " . date('Y') . " $companyName. All rights reserved.</small></p>
    ";

    $mail->isHTML(true);

    $mail->send();

    $modal = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php if (isset($modal) && $modal): ?>
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true" style = "margin-top: 10%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Email Sent</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Please check your Gmail for the confirmation link.
                    </div>
                    <div class="modal-footer">
                        
                        <a href="../index.php" class = "btn btn-primary">OK</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        </script>
    <?php endif; ?>
</body>
</html>
