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

// Delete post logic
if (isset($_POST['delete_post'])) {
    $post_id_to_delete = mysqli_real_escape_string($conn, $_POST['delete_post']);
    $delete_query = mysqli_query($conn, "DELETE FROM posts WHERE post_id = {$post_id_to_delete}");

    if ($delete_query) {
        // Successfully deleted
        header("Refresh:0");
        exit();
    } else {
        // Error in deletion
        echo "Error deleting post: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Account Page</title>
    <style>
body {
    background-color: #1c2331;
    color: #fff;
    font-family: 'Courier New', monospace;
    text-decoration: none;
  }
  
  .account-page {
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  
   .profile {
    display: flex;
    justify-content: center;
    text-align: center;
    align-items: center;
    flex-direction: row;
    padding: 20px;
    background: linear-gradient(rgb(17, 68, 96), rgba(17, 68, 96, 0.5));
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }
  
   .profile img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3)
  }
  
  .details {
    
    text-align: left;
  }
  
  .details span {
    font-size: 1.5em;
    font-weight: bold;
    
  }
  
  
  button {
    
    background: none;
    border: none;
    padding: 1em 2em;
    border-radius: 10px;
    color: #fff;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
    margin-left: 10px;
    background-color: #42a3c3;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3)
  }
  
  button a {
    text-decoration: none;
    color: #fff;
  }
  
  button:hover {
    background-color: #328da4;
  }
  
   .posts {
    margin-top: 10px;
    display: flex;
    flex-wrap: wrap;
  }
  
   .post {
    border: 1px #42a3c3 solid;
    background: linear-gradient(rgb(17, 68, 96), rgba(17, 68, 96, 0.5));
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    border-radius: 10px;
    width: 250px;
    margin: 10px;
    padding: 15px;
  }
  
  .post:hover {
    transform: scale(1.01);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 1);
  }
  
   .post img {
    width: 100%;
    border-radius: 10px;
    margin-bottom: 0.3em;
  }
  
   .post p {
    text-align: center;
    margin-bottom: 0.5em;
  }
  
  .post-details {
    text-align: center;
  }
  
   .post-details span {
    display: block;
    margin-bottom: 0.5em;
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
                
            </div>
            <button><a href="editAccount.php">Edit</a></button>
            <button type="button" class="back-button"><a href="users.php">Back</a> </button>
          
        </div>
        <div class="posts">
        <?php
        if ($user_id) {
            $posts_query = mysqli_query($conn, "SELECT * FROM posts WHERE user_id = '{$row['user_id']}' ORDER BY created_at DESC");

            if (!$posts_query) {
                die('Error in posts query: ' . mysqli_error($conn));
            }

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
                        <button onclick="confirmDelete(<?php echo $post_id; ?>)">Delete</button>
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
    <script>
        function confirmDelete(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                // Make an asynchronous request to delete the post
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "account.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Reload the page after successful deletion
                        location.reload();
                    }
                };
                xhr.send("delete_post=" + postId);
            }
        }
    </script>

</body>

</html>
