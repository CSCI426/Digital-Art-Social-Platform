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

  header.header {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    background: #d3d3d3;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 9%;
    font-weight: bolder;
}


  .wrapper {
    max-width: 350px;
    height: 100vh;
    margin: 0;
    padding: 0;
    position: fixed;
    background:#fff;
    top: 0;
    right: -350px;  
    transition: right 0.5s ease;  
    z-index: 12;
  }

  .users {
    border-left: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
  }

  .header {
    background-color: #333;
    color: #fff;
    padding: 15px;
    text-align: right;
  }

  .content {
    display: flex;
    align-items: center;
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

    #toggleChatBtn,#backChatBtn,#settings {
    cursor: pointer;
    border: none;
    background: none;
    font-size: 24px;
    color: #333;
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
  document.addEventListener('DOMContentLoaded', function() {
    var wrapper = document.querySelector('.wrapper');
    var toggleChatBtn = document.getElementById('toggleChatBtn');
    var backChatBtn = document.getElementById('backChatBtn');
    var isWrapperVisible = false;

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
</script>
</body>
</html>