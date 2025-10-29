<?php require_once("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<style>
body{font-family:Arial;background:#f4f4f4;padding:20px;}
.card{background:white;padding:20px;margin:15px;box-shadow:0 0 10px rgba(0,0,0,0.1);}
button{background:#002b5c;color:white;padding:10px 20px;border:none;border-radius:5px;}
</style>
<script>
function logout(){window.location='logout.php';}
</script>
</head>
<body>
<h2>Welcome to Your Dashboard</h2>
<div class="card">
<h3>Upcoming Trips</h3>
<p>No trips booked yet.</p>
</div>
<button onclick="logout()">Logout</button>
</body>
</html>
