<?php require_once("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body{font-family:Arial;background:#f0f0f0;}
form{background:white;padding:20px;margin:100px auto;width:300px;box-shadow:0 0 10px rgba(0,0,0,0.2);}
input{width:100%;padding:10px;margin:10px 0;border:1px solid #ccc;border-radius:5px;}
button{width:100%;padding:10px;background:#002b5c;color:white;border:none;border-radius:5px;}
</style>
</head>
<body>
<form method="POST">
<h2>Login</h2>
<input type="text" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
<p><a href="signup.php">Create account</a></p>
</form>

<?php
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
  if($res->num_rows>0){
    echo "<script>window.location='dashboard.php';</script>";
  } else {
    echo "<script>alert('Invalid login credentials');</script>";
  }
}
?>
</body>
</html>
