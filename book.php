<?php
require_once "db.php";
session_start();

// Agar user login nahi hai
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to book a trip!'); window.location.href='login.php';</script>";
    exit();
}

// Agar trip id nahi di gayi
if (!isset($_GET['trip_id'])) {
    echo "<script>alert('No trip selected!'); window.location.href='index.php';</script>";
    exit();
}

$trip_id = intval($_GET['trip_id']);
$user_id = $_SESSION['user_id'];

// Trip details fetch karo
$tripQuery = mysqli_query($conn, "SELECT * FROM trips WHERE id = $trip_id");
if (!$tripQuery || mysqli_num_rows($tripQuery) == 0) {
    echo "<script>alert('Trip not found!'); window.location.href='index.php';</script>";
    exit();
}
$trip = mysqli_fetch_assoc($tripQuery);

// Booking insert karo
$insert = mysqli_query($conn, "INSERT INTO bookings (user_id, trip_id, status) VALUES ('$user_id', '$trip_id', 'confirmed')");
if ($insert) {
    echo "<script>alert('✅ Booking Confirmed for {$trip['destination']}!'); window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('❌ Booking Failed. Please try again later.'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking | Hilton Hostel</title>
<style>
body {
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(120deg, #74ABE2, #5563DE);
  color: white;
  text-align: center;
  padding-top: 60px;
}
.container {
  background: rgba(255,255,255,0.1);
  padding: 30px;
  border-radius: 15px;
  width: 60%;
  margin: auto;
  box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}
h1 {
  font-size: 28px;
  margin-bottom: 10px;
}
p {
  font-size: 18px;
  color: #eee;
}
.btn {
  background-color: #fff;
  color: #5563DE;
  border: none;
  padding: 12px 25px;
  border-radius: 25px;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  margin-top: 20px;
}
.btn:hover {
  background-color: #5563DE;
  color: white;
  transform: scale(1.05);
}
</style>
</head>
<body>
  <div class="container">
    <h1>Booking Process</h1>
    <p>Processing your booking for <b><?php echo htmlspecialchars($trip['destination']); ?></b>...</p>
    <button class="btn" onclick="goToDashboard()">Go to Dashboard</button>
  </div>

  <script>
    function goToDashboard(){
      window.location.href = "dashboard.php";
    }
  </script>
</body>
</html>
