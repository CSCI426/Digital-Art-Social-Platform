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
  background: linear-gradient(to bottom right, #2a0047 20%, #71aeca, #2a0047 100%);
  display: flex;
  overflow: hidden;
  align-items: center;
  justify-content: center;
  width: 100vw;
  min-height: 100vh;
 
}

.form form .button input{
  height: 45px;
  border: none;
  color: #fff;
  font-size: 17px;    
  background: linear-gradient(90deg, rgb(145, 9, 32),  rgb(52, 31, 87) 40%, #5ab9f0 160%);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  border-radius: 15px;
  cursor: pointer;
  margin-top: 13px;
}

.form{
  padding: 25px 30px;
  background: transparent;
  backdrop-filter: blur(150px); 
  border-radius: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.absolute {
  position: absolute;
  top: 50px;
  inset: 0;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
}

.bg-shape1 {
  width: 500px;
  height: 400px;
  border-radius: 50% 50% 0 0;
  position: absolute;
  left: -10px;
  bottom: 40%;
  transform: translateY(80%) translateX(-10%);
}

.bg-shape2 {
  width: 300px;
  height: 300px;
  border-radius: 9999px;
  position: absolute;
  top: 0;
  transform: translateX(0%);
  animation: two 5s infinite; 
}
.bg-shape3 {
  width: 400px;
  height: 500px;
  border-radius: 50% 0 0 50%;
  position: absolute;
  right: -10px;
  top: 40%;
  transform: translateY(-60%);
}

.bg-shape4 {
  width: 300px;
  height: 300px;
  border-radius: 9999px;
  position: relative;
  animation: one 5s infinite;
}

@keyframes one {
  0% { left: 0; top: 0; }
  25% { left: -20px; top: 70px; }
  50% { left: 60px; top: 150px; }
  75% { left: 50px; top: 100px; }
  100% { left: 0px; top: 0px; }
}

@keyframes two {
  0% { right: 380px; top: 0; }
  25% { right: 300px; top: 0; }
  50% { right: 480px; top: 0; }
  75% { right: 300px; top: 0; }
  100% { right: 380px; top: 0; }
}

.opacity-50 {
  opacity: 0.5;
}

.bg-blur {
  filter: blur(40px);
}

.bg-teal {
  background-color: #FF69B4;
}

.bg-primary {
  background-color: rgb(145, 9, 32);
}

.bg-purple {
  background-color: #000033;
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

  <div class="register">
    <section class="form login">
      <header>Accessing Worlds of Art</header>
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
        <input type="submit" name="submit" value="Login">
        </div>
      </form>
      <div class="link">Not signed up yet? <a href="signup.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>