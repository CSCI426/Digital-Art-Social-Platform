<?php 
session_start();
include_once "php/config.php";
if(!isset($_SESSION['unique_id'])){
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>
<html>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    overflow-x: hidden; 
  }
</style>
<body>

<header class="header">
  <div>
<button id="settings"><i class="fa-solid fa-gear"></i></button>
</div>
<div>
<h1>Ink & Insight</h1>
</div>
<div>
<button id="toggleChatBtn"><i class="fa-brands fa-rocketchat"></i></button>
</div>
</header>

<div class="wrapper2">
  <section class="settings-content">
    <button>
      <a href="account.php">Button 1</a></button>
    <button>Button 2</button>
    <button>Button 3</button>
  </section>
  <button id="backBtn"><i class="fa-solid fa-circle-right"></i></button>
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
      <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
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
     var wrapper = document.querySelector('.wrapper');
    var toggleChatBtn = document.getElementById('toggleChatBtn');
    var backChatBtn = document.getElementById('backChatBtn');
    var isWrapperVisible = false;

    var wrapper2 = document.querySelector('.wrapper2');
    var toggleSettingsBtn = document.getElementById('settings');
    var backBtn = document.getElementById('backBtn');
    var isBtnVisible = false;
  document.addEventListener('DOMContentLoaded', function() {
   

    function toggleWrapper(showBtn, hideBtn) {
      showBtn.style.display = 'block';
      hideBtn.style.display = 'none';
      wrapper.style.right = isWrapperVisible ? '-350px' : '0';
      isWrapperVisible = !isWrapperVisible;
    }

    toggleChatBtn.addEventListener('click', function() {
      toggleWrapper(backChatBtn, toggleChatBtn);
    });

    backChatBtn.addEventListener('click', function() {
      toggleWrapper(toggleChatBtn, backChatBtn);
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
   

    function toggleWrapper(showBtn, hideBtn) {
      showBtn.style.display = 'block';
      hideBtn.style.display = 'none';
      wrapper2.style.left = isBtnVisible ? '-350px' : '0';
      isBtnVisible = !isBtnVisible;
    }

    toggleSettingsBtn.addEventListener('click', function() {
      toggleWrapper(backBtn, toggleSettingsBtn);
    });

    backBtn.addEventListener('click', function() {
      toggleWrapper(toggleSettingsBtn, backBtn);
    });
  });
</script>
</body>
</html>