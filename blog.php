<?php require_once("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Travel Blog</title>
<style>
body{font-family:Arial;background:#fff;padding:20px;}
.post{margin:15px 0;padding:15px;border-bottom:1px solid #ddd;}
h2{color:#002b5c;}
</style>
</head>
<body>
<h1>Travel Blog</h1>
<?php
$res=$conn->query("SELECT * FROM blog ORDER BY id DESC");
while($row=$res->fetch_assoc()){
  echo "<div class='post'><h2>".$row['title']."</h2><p>".$row['content']."</p></div>";
}
?>
</body>
</html>
