<?php require_once("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Search Trips</title>
<style>
body{font-family:Arial;background:#fafafa;padding:20px;}
input,button{padding:10px;margin:5px;}
.result{background:white;padding:15px;margin:10px 0;border-radius:8px;box-shadow:0 0 5px rgba(0,0,0,0.1);}
</style>
</head>
<body>
<h2>Search for Trips</h2>
<form method="POST">
<input type="text" name="query" placeholder="Enter destination..." required>
<button name="search">Search</button>
</form>
<?php
if(isset($_POST['search'])){
  $query = $_POST['query'];
  $result = $conn->query("SELECT * FROM trips WHERE destination LIKE '%$query%'");
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      echo "<div class='result'><h3>".$row['destination']."</h3><p>".$row['details']."</p></div>";
    }
  } else {
    echo "<p>No results found.</p>";
  }
}
?>
</body>
</html>
