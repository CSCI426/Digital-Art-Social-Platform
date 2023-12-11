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
   background: linear-gradient(to bottom right, #d3d3d3 10%, #f8f8f8, #89CFF0 50%);
        }

        .wrapper {
            width: 100%;
            max-width: 600px; 
        }

        .chat-area {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        header {
            background: #f1f1f1;
            padding: 10px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
        }

        .details {
            margin-left: 10px;
        }

        .chat-box {
            height: 300px; 
            overflow-y: auto;
        }

        .typing-area{
  padding: 18px 30px;
  display: flex;
  justify-content: space-between;
}

        .input-field {
            flex: 1;
            padding-left: 1.5rem;
        }

        .typing-area button{
  color: #fff;
  width: 55px;
  border: none;
  outline: none;
  background: #333;
  font-size: 19px;
  cursor: pointer;
  opacity: 0.7;
  pointer-events: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.3s ease;
}
.typing-area button.active{
  opacity: 1;
  pointer-events: auto;
}
</style>
<body>
  <div class="wrapper">
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
