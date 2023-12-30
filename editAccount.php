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
    <style>
        body {
            background-color: rgb(17,68,96);;
            font-family: Arial, sans-serif;
        }

        .edit-account-form {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 80px;
            padding: 1rem;
            text-align: center;
            background: rgba(127, 127, 127, .25);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255,.18);
            position: relative;
        }

        .edit-account-form h2 {
            margin-bottom: 20px;
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
            text-align: center;
            font-weight: bold;
        }

        .edit-account-form input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
        }

        .edit-account-form button {
            background-color: #42a3c3;
            border: none;
            color: #fff;
            margin: 3px;
            padding: 10px 30px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .edit-account-form button a{
            color: #fff;
        }

        .edit-account-form button:hover {
            background-color: #328da4;
        }

        .success-message {
            color: #4caf50;
            text-align: center;
            margin-top: 80px;
        }
        .error-message {
            color: #721c24;
            text-align: center;
            margin-top: 80px;
        }

        .file-input-container {
            position: relative;
            display: inline-block;
            overflow: hidden;
            margin-bottom: 10px;
        }
        
        .file-input-container input {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }
        
        .file-input-container button {
            background-color: #42a3c3;
            border: none;
            color: #fff;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
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
                            echo '<p class="success-message">Profile updated successfully!</p>';
                            header("location: users.php");
                        } else {
                            echo '<p class="error-message">Error updating profile: </p>' . mysqli_error($conn);;
                        }
                    } else {
                        echo '<p class="error-message">Error uploading image</p>';
                    }
                } else {
                    echo '<p class="error-message">Please upload an image file - JPEG, PNG, JPG.</p>';
                }
            } else {
                echo '<p class="error-message">Please upload an image file - JPEG, PNG, JPG.</p>';
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
        <div class="file-input-container">
            <input type="file" name="image" id="photo" accept="image/*">
            <button>Select Image</button>
        </div>

        <label>First Name:</label>
        <input type="text" name="fname" id="fname" value="<?php echo $row['fname']; ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="lname" id="lname" value="<?php echo $row['lname']; ?>" required><br>

        <button type="submit">Save</button>
        <button type="button"><a href="account.php">Back</a></button>
    </form>
</div>
</body>
</html>
