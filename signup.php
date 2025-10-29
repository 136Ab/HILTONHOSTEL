<?php require_once("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
<style>
body{font-family:Arial;background:#eaeaea;}
form{background:white;padding:20px;margin:100px auto;width:300px;box-shadow:0 0 10px rgba(0,0,0,0.2);}
input{width:100%;padding:10px;margin:10px 0;border:1px solid #ccc;border-radius:5px;}
button{width:100%;padding:10px;background:#002b5c;color:white;border:none;border-radius:5px;}
</style>
</head>
<body>
<form method="POST">
<h2>Create Account</h2>
<input type="text" name="name" placeholder="Full Name" required>
<input type="text" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="signup">Signup</button>
<p><a href="login.php">Login</a></p>
</form>

<?php
if(isset($_POST['signup'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $conn->query("INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");
  echo "<script>alert('Signup successful!'); window.location='login.php';</script>";
}
?>
</body>
</html>
