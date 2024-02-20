<?php
require 'includes/connection.php';


$token = $_GET['token'] ?? '';
$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

   
    if (empty($newPassword) || $newPassword !== $confirmPassword) {
        $error = 'Passwords do not match or are empty.';
    } else {
       
        $stmt = $connection_database->prepare("SELECT email FROM password_reset_requests WHERE token = ?");
        if (!$stmt) {
            die("Prepare failed: " . $connection_database->error);
        }
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
           
            $updateStmt = $connection_database->prepare("UPDATE register_table SET register_password = ? WHERE email = ?");
            if (!$updateStmt) {
                die("Prepare failed: " . $connection_database->error);
            }
            $updateStmt->bind_param("ss", $newPassword, $user['email']);
            if ($updateStmt->execute()) {
                $success = true;

               
                $deleteStmt = $connection_database->prepare("DELETE FROM password_reset_requests WHERE token = ?");
                $deleteStmt->bind_param("s", $token);
                $deleteStmt->execute();
            } else {
                $error = 'Failed to update password.';
            }
        } else {
            $error = 'Invalid or expired token.';
        }
    }
}


if (!$success):
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type=password] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            cursor: pointer;
            padding: 10px 20px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background-color: #003d82;
        }
        .error {
            color: #d9534f;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reset Password</h2>
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form action="reset_password.php?token=<?= htmlspecialchars($token) ?>" method="post">
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <button type="submit">Reset Password</button>
    </form>
</div>
</body>
</html>

<?php
else:
    echo "<div class='container'><p>Your password has been updated successfully.</p>";
    echo "<a href='login.php'>Login</a></div>";
endif;
?>
