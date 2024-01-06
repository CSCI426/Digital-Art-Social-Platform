<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<style>

  body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(to bottom right, #2a0047 20%, #71aeca, #2a0047 100%);
        }



</style>


<body>
<div class="absolute">
    <div class="absolute inset-0 justify-center">
      <div class="bg-shape1 bg-primary opacity-50 bg-blur"> </div>
      <div class="bg-shape2 bg-primary opacity-50 bg-blur"> </div>
      <div class="bg-shape3 bg-purple opacity-50 bg-blur"> </div>
      <div class="bg-shape4 bg-teal opacity-50 bg-blur"> </div>
    </div>
  </div>
  
  <div class="chat">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area" enctype="multipart/form-data" id="chatForm">
    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
    <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off" style="padding-left: 1.5rem;">

    <button type="submit"><i class="fab fa-telegram-plane"></i></button>
</form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
