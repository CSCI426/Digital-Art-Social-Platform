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
    <title>Account Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        /* .account-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        } */

        .profile {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .username {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 0;
        }

        .details {
            margin-top: 20px;
        }

        .details span {
            font-size: 18px;
            font-weight: bold;
        }

        .details p {
            font-size: 14px;
            margin-top: 5px;
            color: #666;
        }

        button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="account-page">
        <div class="profile">
        <?php 
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }
        ?>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
        <button><a href="editAccount.php">edit</a></button>
      </div>
      <div class="posts">
            <?php 
              $user_id = $_SESSION['unique_id'];
              $posts_query = mysqli_query($conn, "SELECT * FROM posts WHERE user_id = '{$user_id}' ORDER BY created_at DESC");
              if(mysqli_num_rows($posts_query) > 0){
                while($post_row = mysqli_fetch_assoc($posts_query)){
                  $post_id = $post_row['id'];
                  $post_content = $post_row['content'];
                  $post_description = $post_row['description'];
                  $post_created_at = $post_row['created_at'];
            ?>
            <div class="post">
                <img src="images/<?php echo $post_content; ?>" alt="Post Image">
            </div>
            <?php
                }
              } else {
                echo "No posts to display.";
              }
            ?>
        </div>
    </div>
</body>
</html>