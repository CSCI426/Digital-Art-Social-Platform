<?php 
session_start();
include_once "php/config.php";
if(!isset($_SESSION['unique_id'])){
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .changePass-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .changePass-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-transform: uppercase;
        }

        .changePass-form form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .changePass-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .changePass-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .changePass-form button {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .changePass-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
$unique_id = $_SESSION['unique_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = mysqli_real_escape_string($conn, $_POST['current_password']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);

    if (!empty($currentPassword)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
        
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($currentPassword);
            $enc_pass = $row['password'];
            
            if ($user_pass === $enc_pass) {
                if (!empty($newPassword)) {
                    $hashedNewPassword = md5($newPassword);
                    $sql2 = mysqli_query($conn, "UPDATE users SET password = '{$hashedNewPassword}' WHERE unique_id = '{$row['unique_id']}'");
                    if ($sql2) {
                        echo "success";
                    } else {
                        echo "Something went wrong. Please try again!";
                    }
                } else { 
                    echo "New password is required!";
                }
            } else {
                echo "Password is incorrect!";
            }
        }
    } else {
    echo "All input fields are required!";
    }
}
?>

<div class="changePass-form">
    <h2>Change Password</h2>
    <form method="POST">
        <label>Current Password:</label>
        <input type="password" name="current_password" required><br>

        <label>New Password:</label>
        <input type="password" name="new_password" required><br>

        <button>Save</button>
    </form>
</div>

</body>
</html>