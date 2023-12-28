<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit(); 
}
?>
<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
        }

        .form-container label,
        .form-container input,
        .form-container textarea,
        .form-container button {
            display: block;
            margin-bottom: 10px;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input[type="file"],
        .form-container input[type="number"],
        .form-container textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <?php
        $check_user_query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($check_user_query) > 0) {
            $row = mysqli_fetch_assoc($check_user_query);
            $user_id = $row['user_id']; 
        } else {
            echo "User not found!";
            exit(); 
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
            <label for="image">Content (Image):</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" min="0" step="0.01" required>

            <button type="submit">Add Post</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);

        if (isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if (in_array($img_ext, $extensions)) {
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if (in_array($img_type, $types)) {
                    $time = time();
                    $new_img_name = $time . $img_name;

                
                    $upload_dir = "php/Pimages/";
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    if (move_uploaded_file($tmp_name, $upload_dir . $new_img_name)) {
                        $created_at = date('Y-m-d H:i:s');

                        $insert_query = mysqli_query($conn, "INSERT INTO posts (user_id, image, description, price, created_at)
                            VALUES ('{$user_id}', '{$new_img_name}', '{$description}', '{$price}', '{$created_at}')");

                        if ($insert_query) {
                            echo "Post added successfully.";
                            header("location: users.php");
                            exit(); 
                        } else {
                            echo "Something went wrong. Please try again!";
                        }
                    } else {
                        echo "Something went wrong while uploading the image. Please try again!";
                    }
                } else {
                    echo "Please upload an image file - JPEG, PNG, JPG.";
                }
            } else {
                echo "Please upload an image file - JPEG, PNG, JPG.";
            }
        }
    }
    ?>
</body>

</html>
