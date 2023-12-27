<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<html>
<style>
    body {
    background: linear-gradient(to bottom right, #d3d3d3 10%, #f8f8f8, #89CFF0 50%);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 0 10px;
  }
  </style>
<body>

  <div class="register">
    <section class="form login">
      <header>Accessing Worlds of Words</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
        <input type="submit" name="submit" value="Unlock the Stories">
        </div>
      </form>
      <div class="link">Not signed up yet? <a href="signup.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
