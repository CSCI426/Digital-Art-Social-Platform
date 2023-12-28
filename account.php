<?php
session_start();
include_once "php/config.php";


if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit(); 
}


$user_id = isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : null;


if ($user_id === null) {
    die('User ID is not set.');
}


$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");

if ($sql && mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
} else {
    die('Error fetching user data: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Account Page</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            text-decoration: none;
        }

        .account-page {
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

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
        button a{
          text-decoration: none;
        }

        button:hover {
            background-color: #45a049;
        }

        .posts {
            display: flex;
            /* justify-content: space-around; */
            flex-wrap: wrap;
            gap: 1rem;
        }

        .post {
            width: 200px;
            margin: 10px;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .post img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <div class="account-page">
        <div class="profile">
            <img src="php/images/<?php echo htmlspecialchars($row['img']); ?>" alt="">
            <div class="details">
                <span>
                    <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?>
                </span>
                <p>
                    <?php echo htmlspecialchars($row['status']); ?>
                </p>
            </div>
            <button><a href="editAccount.php">edit</a></button>
        </div>
        <div class="posts">
            <?php
            if ($user_id) {
              $posts_query = mysqli_query($conn, "SELECT * FROM posts WHERE user_id = '{$user_id}' ORDER BY created_at DESC");
          
              if (!$posts_query) {
                  die('Error in posts query: ' . mysqli_error($conn));
              }

$posts_query = mysqli_query($conn, "SELECT * FROM posts WHERE user_id = '{$row['user_id']}' ORDER BY created_at DESC");

          
              if (mysqli_num_rows($posts_query) > 0) {
                  while ($post_row = mysqli_fetch_assoc($posts_query)) {
                      $post_id = $post_row['post_id'];
                      $post_content = htmlspecialchars($post_row['image']);
                      $post_description = htmlspecialchars($post_row['description']);
                      $post_price = htmlspecialchars($post_row['price']);
                      $post_created_at = $post_row['created_at'];
          ?>
                      <div class="post">
                          <img src="php/Pimages/<?php echo $post_content; ?>">
                          <p>
                              <?php echo $post_description; ?>
                          </p>
                          <div class="post-details">
                        <span>Price: <?php echo $post_price; ?>ETH</span><br>
                        <span>Created at: <?php echo $post_created_at; ?></span>
                    </div>
                      </div>
          <?php
                  }
              } else {
                  echo "No posts to display.";
              }
          } else {
              echo "User ID is not set.";
          }
          ?>
            
        </div>
    </div>
</body>

</html>
