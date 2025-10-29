<?php require_once("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Hilton Hostel | Home</title>
<style>
body{margin:0;font-family:Arial;background:#f4f4f4;}
header{background:#002b5c;color:#fff;padding:20px;text-align:center;}
nav a{color:white;margin:0 15px;text-decoration:none;}
.container{padding:20px;}
.destination{background:white;padding:20px;margin:15px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1);}
button{background:#002b5c;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;}
button:hover{background:#0056b3;}
</style>
<script>
function redirect(p){window.location.href=p;}
</script>
</head>
<body>
<header>
  <h1>Welcome to Hilton Hostel</h1>
  <nav>
    <a href="index.php">Home</a>
    <a href="search.php">Search Trips</a>
    <a href="blog.php">Travel Blog</a>
    <a href="login.php">Login</a>
    <a href="signup.php">Signup</a>
  </nav>
</header>

<div class="container">
  <h2>Popular Destinations</h2>
  <div class="destination">
    <h3>Paris, France</h3>
    <p>The city of lights awaits you with stunning architecture and cuisine.</p>
    <button onclick="redirect('book.php')">Book Now</button>
  </div>
  <div class="destination">
    <h3>Tokyo, Japan</h3>
    <p>Experience modern marvels and ancient traditions in one trip.</p>
    <button onclick="redirect('book.php')">Book Now</button>
  </div>
</div>
</body>
</html>
