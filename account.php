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
<link rel="stylesheet" href="css/account.css">
<head>
    <title>Account Page</title>
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
                <button><a href="editAccount.php">edit profile</a></button>
            </div>
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
                        <span>Price: <?php echo $post_price; ?>ETH</span>
                        <span>Created at: <?php echo $post_created_at; ?></span>
                        <button class="delete-btn"><a href="deletePost.php?post_id=<?php echo $post_id; ?>">Delete</a></button>
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
