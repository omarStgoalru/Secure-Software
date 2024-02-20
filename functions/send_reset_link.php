<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); 
$dotenv->load();

require __DIR__ . '/../includes/connection.php'; 

$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.<br>";
    echo 'SMTP_USER: ' . getenv('SMTP_USER') . "<br>";
    exit;
}

try {
    $sql = "SELECT * FROM register_table WHERE register_user_name = ? OR email = ?";
    $checkEmailStmt = $connection_database->prepare($sql);

    if (!$checkEmailStmt) {
        echo "Prepare statement failed: " . $connection_database->error;
        exit;
    }
    $checkEmailStmt->bind_param("ss", $email, $email); // Correctly bind the variable twice
    $checkEmailStmt->execute();
    $result = $checkEmailStmt->get_result();
    if ($result->num_rows == 0) {
        echo "Email not registered.<br>";
        exit;
    }
    
    $token = bin2hex(random_bytes(50));
    $stmt = $connection_database->prepare("INSERT INTO password_reset_requests (email, token) VALUES (?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $connection_database->error);
    }
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception("No rows affected.");
    }

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    
    $mail->Username = 'codingprojectweb@gmail.com';
    $mail->Password = 'sqzfepmxhfxotvqk';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    
    $mail->setFrom('khaledahmedhaggagy@gmail.com', 'Mailer'); 
    $mail->addAddress($email);

    $mail->isHTML(true);
    $resetLink = 'http://localhost/Bookstore/reset_password.php?token=' . $token;
    $mail->Subject = 'Your Password Reset Link';
    $mail->Body = "Please click on the following link to reset your password: <a href='{$resetLink}'>Reset Password</a>";
    $mail->AltBody = "Please click on the following link to reset your password: {$resetLink}";

    $mail->send();
    echo 'Password reset link has been sent to your email.';
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($connection_database)) {
        $connection_database->close();
    }
}
