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
    <title>Change Email</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .changeEmail-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .changeEmail-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-transform: uppercase;
        }

        .changeEmail-form form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .changeEmail-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .changeEmail-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .changeEmail-form button {
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

        .changeEmail-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
$unique_id = $_SESSION['unique_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = mysqli_real_escape_string($conn, $_POST['current_password']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['new_email']);

    if (!empty($currentPassword) && !empty($newEmail)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");

        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($currentPassword);
            $enc_pass = $row['password'];

            if ($user_pass === $enc_pass) {
                $sql2 = mysqli_query($conn, "UPDATE users SET email = '{$newEmail}' WHERE unique_id = '{$row['unique_id']}'");

                if ($sql2) {
                    echo "success";
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Current Password is incorrect!";
            }
        }
    } else {
        echo "All input fields are required!";
    }
}
?>

<div class="changeEmail-form">
    <h2>Change Email</h2>
    <form method="POST">
        <label>Current Password:</label>
        <input type="password" name="current_password" required><br>

        <label>New Email:</label>
        <input type="email" name="new_email" required><br>

        <button>Save</button>
    </form>
</div>

</body>
</html>