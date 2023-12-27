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
    <title>Edit Account</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .edit-account-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .edit-account-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-transform: uppercase;
        }

        .edit-account-form form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .edit-account-form img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .edit-account-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .edit-account-form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .edit-account-form button {
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

        .edit-account-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $unique_id = $_SESSION['unique_id'];

    $sql = "UPDATE users SET fname = '$fname', lname = '$lname' WHERE unique_id = '$unique_id'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        header("location: account.php");
        exit;
    } else {
        echo "Failed to update the account information.";
    }
}

$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
?>

<div class="edit-account-form">
    <h2>Edit Account</h2>
    <form method="POST">
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <input type="file" name="photo" id="photo" accept="image/*"><br>

        <label>First Name:</label>
        <input type="text" name="fname" id="fname" value="<?php echo $row['fname']; ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="lname" id="lname" value="<?php echo $row['lname']; ?>" required><br>

        <button>Save</button>
    </form>
</div>
<?php  
} 
?>
</body>
</html>