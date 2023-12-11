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
}
.form {
  padding: 25px 30px;
   background: linear-gradient(to top left, #e4dede 30%, #89cff0bd 20%); 
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.form{
  padding: 25px 30px;
   background: linear-gradient(to top left, #e4dede 30%, #89cff0bd 20%); 
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.form header{
  text-align: center;
  font-size: 25px;
  font-weight: 600;
  padding-bottom: 10px;
  border-bottom: 1px solid #000;
}
.form form{
  margin: 20px 0;
}
.form form .error-text{
  color: #721c24;
  padding: 8px 10px;
  text-align: center;
  border-radius: 5px;
  background: #f8d7da;
  border: 1px solid #f5c6cb;
  margin-bottom: 10px;
  display: none;
}
.form form .name-details{
  display: flex;
}
.form .name-details .field:first-child{
  margin-right: 10px;
}
.form .name-details .field:last-child{
  margin-left: 10px;
}
.form form .field{
  display: flex;
  margin-bottom: 10px;
  flex-direction: column;
  position: relative;
}
.form form .field label{
  margin-bottom: 2px;
}
.form form .input input {
  height: 40px;
  width: 100%;
  font-size: 16px;
  padding: 0 10px;
  border-radius: 5px;
  border: 1px solid #e4dede;
  transition: border-color 0.3s ease; 

 
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


.form form .input input:hover {
  border-color: #e4dede; 
}


.form form .input input:focus {
  outline: none; 
  border-color:5px #8ea2b7; 
  box-shadow: 0 0 8px #f4f6f7bd,
  0 0 16px #9fb1babd,
  0 0 50px #5f747ebd;
}

.form form .field input{
  outline: none;
}
.form form .image input{
  font-size: 17px;
}
.form form .button input{
  height: 45px;
  border: none;
  color: #fff;
  font-size: 17px;
  background:rgb(70, 67, 67);
  border-radius: 5px;
  cursor: pointer;
  margin-top: 13px;
}
.form form .field i{
  position: absolute;
  right: 15px;
  top: 70%;
  color: #ccc;
  cursor: pointer;
  transform: translateY(-50%);
}
.form form .field i.active::before{
  color: #333;
  content: "\f070";
}
.form .link{
  text-align: center;
  margin: 10px 0;
  font-size: 17px;
}
.form .link a{
  color: #333;
}
.form .link a:hover{
  text-decoration: underline;
}
  </style>
<body>

  <div class="wrapper">
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
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
