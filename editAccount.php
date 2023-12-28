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
        .edit-account-form button a{
            color: #fff;
        }

        .edit-account-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);

    if (!empty($fname) && !empty($lname)) {
        if (isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if (in_array($img_ext, $extensions) === true) {
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if (in_array($img_type, $types) === true) {
                    $time = time();
                    $new_img_name = $time . $img_name;
                    if (move_uploaded_file($tmp_name, "php/images/" . $new_img_name)) {
                        $update_query = "UPDATE users SET fname = '$fname', lname = '$lname', img = '$new_img_name' WHERE unique_id = '{$_SESSION['unique_id']}'";
                        $update_result = mysqli_query($conn, $update_query);

                        if ($update_result) {
                            echo "Profile updated successfully!";
                            header("location: users.php");
                        } else {
                            echo "Error updating profile: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Error uploading image.";
                    }
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            } else {
                echo "Please upload an image file - jpeg, png, jpg";
            }
        }
    } else {
        echo "All input fields are required!";
    }
}

$select_query = "SELECT fname, lname, img FROM users WHERE unique_id = '{$_SESSION['unique_id']}'";
$result = mysqli_query($conn, $select_query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching user details: " . mysqli_error($conn);
}
?>


<div class="edit-account-form">
    <h2>Edit Account</h2>
    <form method="POST" enctype="multipart/form-data">
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <input type="file" name="image" id="photo" accept="image/*"><br>

        <label>First Name:</label>
        <input type="text" name="fname" id="fname" value="<?php echo $row['fname']; ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="lname" id="lname" value="<?php echo $row['lname']; ?>" required><br>

        <button type="submit">Save</button>
        <button ><a href="account.php">Back</a></button>
    </form>
</div>
</body>
</html>