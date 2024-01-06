<?php
session_start();
include_once "php/config.php";

// Redirect to login page if user is not logged in
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


$posts_query = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");

?>
<?php include_once "header.php"; ?>
<html>
<style>
body {
    background-color: #1c2331;
    color: #fff;
    font-family: 'Courier New', monospace;
    text-decoration: none;
        }

        header.header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #2c3e50;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            font-weight: bold;
            color: #ecf0f1;
        }

        header.header h1 {
            margin: 0;
        }

        .wrapper,
        .wrapper2 {
            max-width: 350px;
            height: 100vh;
            margin: 0;
            padding: 0;
            position: fixed;
            background:  #fff;
            top: 0;
            right: -350px;
            transition: right 1s ease;
            z-index: 12;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .users {
            border-left: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .header .content,
        .content {
            display: flex;
            align-items: center;
        }

        .header img,
        .details img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

  .settings-content a {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .settings-content a i {
    margin-right: 10px;
  }

  .details {
    margin-left: 10px;
  }

  .search {
    padding: 15px;
    border-bottom: 1px solid #ccc;
  }

  .users-list{
    padding: 15px;
  }

    #toggleChatBtn,#backChatBtn,#settings,#backBtn {
    cursor: pointer;
    border: none;
    background: none;
    font-size: 24px;
    color: #fff;
    transition: transform 1s;
  }
  #backBtn,#backChatBtn{
    color: #333;
  }
  .wrapper2 {
    left: -350px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: left 1s ease;  
    
  }

  .settings-content {
    width: 100%;
    background-color: #f8f8f8;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
    padding: 10px;
  }

  .settings-content a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
    font-size: 16px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .settings-content a i {
    margin-right: 8px;
  }

  .settings-content a:hover {
    background-color: #ddd;
    color: #000;
  }

  #backBtn {
  position: absolute; 
  bottom: 10px;
  right: 10px;
  cursor: pointer;
    border: none;
    background: none;
    font-size: 24px;
    color: #333;
  border: none;
  border-radius: 50%;
  font-size: 24px;
  padding: 10px;
  cursor: pointer;
  transition: transform 1s;
}

  #backBtn:hover ,
  #backChatBtn:hover{
    transform: rotate(360deg);
  }

  h2 {
      margin-top: 20px;
      font-size: 24px;
      color: #333;
    }

  .posts {
    margin-top: 5rem;
            gap: 20px;
         padding: 20px;
          justify-content: center;  
    display: flex;
    flex-wrap: wrap;
        }

        .post {
            width: 290px;
            font-size: 13px;
            overflow: hidden;
            border: 1px #42a3c3 solid;
            background: linear-gradient(rgb(17, 68, 96), rgba(17, 68, 96, 0.5));
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            padding: 15px;
        }

        .post:hover {
    transform: scale(1.01);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 1);
  }

        .post img {
          width: 100%;
        height: 200px; 
        object-fit: cover; 
        border-radius: 10px;
        margin-bottom: 0.3em;
        }

        .post p {
    text-align: center;
    margin-bottom: 0.5em;
        }

        
</style>
<body>

<header class="header">
  <div>
<button id="settings"><i class="fa-solid fa-gear"></i></button>
</div>
        <div class="content">
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <img src="php/images/<?php echo $row['img']; ?>" alt="">
            <div class="details">
                <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                <p><?php echo $row['status']; ?></p>
            </div>
        </div>
        
        <div>
        <button id="toggleChatBtn"><i class="fa-brands fa-rocketchat"></i></button>
        </div>
    </header>

    <div class="posts">
    <?php
    // Fetch posts along with designer information
    $posts_query = mysqli_query($conn, "SELECT posts.*, users.fname AS designer_fname, users.lname AS designer_lname FROM posts JOIN users ON posts.user_id = users.user_id ORDER BY posts.post_id DESC");

    // Display posts
    $post_counter = 0; // Counter variable
    if ($posts_query) {
        while ($post_row = mysqli_fetch_assoc($posts_query)) {
            $post_content = htmlspecialchars($post_row['image']);
            $designer_name = htmlspecialchars($post_row['designer_fname']);
            $designer_last_name = htmlspecialchars($post_row['designer_lname']);
            $price_in_eth = htmlspecialchars($post_row['price']); 

            $created_at = new DateTime($post_row['created_at']);
            $formatted_created_at = $created_at->format('Y-m-d h:i:s a');
            
            if ($post_counter < 20) {
                ?>
                <div class="post">
                    <img src="php/Pimages/<?php echo $post_content; ?>" alt="Post Image">
                    <p>Design by: <?php echo $designer_name . ' ' . $designer_last_name; ?></p>
                    <p>Price in ETH: <?php echo $price_in_eth; ?></p>
                    <p>Created at: <?php echo $formatted_created_at; ?></p> 
                    <p><?php echo htmlspecialchars($post_row['description']); ?></p>
                </div>
                <?php
                $post_counter++;
            }
        }
    } else {
        echo "Error fetching posts: " . mysqli_error($conn);
    }
    ?>
</div>

<div class="wrapper2">
  <section class="settings-content">
    <?php 
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql) > 0){ 
      $row = mysqli_fetch_assoc($sql);
    }
    ?>
    <a href="account.php"><i class="fa-solid fa-user"></i> My Account</a>
    <a href="changeEmail.php"><i class="fa-solid fa-envelope"></i> Change Email</a>
    <a href="changePassword.php"><i class="fa-solid fa-key"></i> Change Password</a>
    <a href="add.php"><i class="fa-solid fa-plus"></i> Add Post</a>
    <a href="#" class="delete" onclick="confirmDelete('<?php echo $row['unique_id']; ?>')">Delete Account</a>
    <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
  </section>
  <button id="backBtn"><i class="fa-solid fa-circle-left"></i></button>
</div>

<div class="wrapper">
  <section class="users">
    <header>
      <div class="content">
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
      </div>
    </header>
    <div class="search">
      <span class="text">Select a user to start chat</span>
      <input type="text" placeholder="Enter name to search...">
      <button><i class="fas fa-search"></i></button>
    </div>
    <div class="users-list">
    </div>
  </section>
  <button id="backChatBtn"><i class="fa-solid fa-circle-right"></i></button>
</div>

<script src="javascript/users.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var wrapper = document.querySelector('.wrapper');
  var wrapper2 = document.querySelector('.wrapper2');
  var toggleChatBtn = document.getElementById('toggleChatBtn');
  var backChatBtn = document.getElementById('backChatBtn');
  var toggleSettingsBtn = document.getElementById('settings');
  var backBtn = document.getElementById('backBtn');
  var isChatVisible = false;
  var isSettingsVisible = false;

  function toggleChatWrapper() {
    wrapper.style.right = isChatVisible ? '-350px' : '0';
    isChatVisible = !isChatVisible;
  }

  function toggleSettingsWrapper() {
    wrapper2.style.left = isSettingsVisible ? '-350px' : '0';
    isSettingsVisible = !isSettingsVisible;
  }

  toggleChatBtn.addEventListener('click', function() {
    toggleChatWrapper();
   
    if (isSettingsVisible) {
      toggleSettingsWrapper();
    }
  });

  backChatBtn.addEventListener('click', function() {
    toggleChatWrapper();
  });

  toggleSettingsBtn.addEventListener('click', function() {
    toggleSettingsWrapper();
  
    if (isChatVisible) {
      toggleChatWrapper();
    }
  });

  backBtn.addEventListener('click', function() {
    toggleSettingsWrapper();
  });
});

    function confirmDelete(userId) {
        const userConfirmed = confirm("Are you sure you want to delete your account?");
        if (userConfirmed) {
            window.location.href = "index.php";
        } else {
            console.log("Deletion canceled by user.");
        }
    }
</script>
</body>
</html>
