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
    <section class="form signup">
      <header>Accessing Worlds of Words</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
  <label>Select Image</label>

    <!-- <button>Choose File</button> -->
    <input type="file" name="image" class="btn" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
</div>


        <div class="field button">
        <input type="submit" name="submit" value="Unlock the Stories">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
