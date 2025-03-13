<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'config.php'; // Database connection
    require 'mailer.php'; // PHPMailer for email sending

    $email = trim($_POST["email"]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $otp = rand(100000, 999999);
        $expires_at = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        $stmt = $pdo->prepare("INSERT INTO password_resets (email, otp, expires_at)
                               VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE otp=?, expires_at=?");
        $stmt->execute([$email, $otp, $expires_at, $otp, $expires_at]);

        sendEmail($email, "Your OTP Code", "Your OTP is: $otp. It expires in 10 minutes.");

        echo "OTP sent to your email!";
    } else {
        echo "Email not found!";
    }
}
?>

<form method="POST">
    <input type="email" name="email" required placeholder="Enter your email">
    <button type="submit">Send OTP</button>
</form>
