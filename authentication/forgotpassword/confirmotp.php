<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'config.php';

    $email = $_POST["email"];
    $otp = $_POST["otp"];

    $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE email=? AND otp=? AND expires_at > NOW()");
    $stmt->execute([$email, $otp]);

    if ($stmt->rowCount() > 0) {
        echo "OTP Verified. Reset your password below.";
        echo '<form method="POST" action="reset_password.php">
                <input type="hidden" name="email" value="' . $email . '">
                <input type="password" name="new_password" required placeholder="Enter new password">
                <button type="submit">Reset Password</button>
              </form>';
    } else {
        echo "Invalid or expired OTP!";
    }
}
?>

<form method="POST">
    <input type="email" name="email" required placeholder="Enter your email">
    <input type="text" name="otp" required placeholder="Enter OTP">
    <button type="submit">Verify OTP</button>
</form>
