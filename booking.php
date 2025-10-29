<?php
// booking.php
session_start();
require_once 'db.php';

$destination_id = (int)($_GET['destination_id'] ?? 0);
$destination = null;
$errors = [];
$success = '';

if ($destination_id && $conn) {
    $stmt = $conn->prepare("SELECT id, name, description, image, price FROM destinations WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $destination_id);
    $stmt->execute();
    $destination = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

if (!$destination) {
    echo "<p style='padding:20px'>Destination not found. <a href='index.php'>Go back</a></p>";
    exit;
}

// Handle booking POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) $errors[] = "Please login to make a booking.";
    $travelers = max(1, (int)($_POST['travelers'] ?? 1));
    $date = $_POST['booking_date'] ?? '';
    if (!$date) $errors[] = "Select booking date.";
    if (empty($errors) && $conn) {
        $total = $destination['price'] * $travelers;
        $user_id = (int)$_SESSION['user_id'];
        $ins = $conn->prepare("INSERT INTO bookings (user_id, destination_id, booking_date, travelers, total_price, status, created_at) VALUES (?, ?, ?, ?, ?, 'Confirmed', NOW())");
        $ins->bind_param("iisd", $user_id, $destination_id, $date, $travelers, $total);
        if ($ins->execute()) {
            $booking_id = $ins->insert_id;
            header("Location: book_confirm.php?id=" . $booking_id);
            exit;
        } else {
            $errors[] = "Booking failed, try again.";
        }
        $ins->close();
    }
}

function esc_local($s){ return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Book: <?=esc_local($destination['name'])?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
body{font-family:Arial,Helvetica,sans-serif;background:#f7f9fc;margin:0;padding:24px}
.container{max-width:760px;margin:0 auto}
.card{background:white;padding:18px;border-radius:12px;box-shadow:0 8px 28px rgba(13,43,77,0.06)}
.btn{background:#0d6efd;color:white;padding:10px;border-radius:8px;border:none;cursor:pointer}
.err{background:#ffecec;padding:8px;border-radius:6px;color:#a94442}
</style>
</head><body>
<div class="container">
  <div class="card">
    <h2><?=esc_local($destination['name'])?></h2>
    <p><?=esc_local($destination['description'])?></p>
    <p style="font-weight:700">$<?=esc_local($destination['price'])?> per person</p>
    <?php if($errors): ?><div class="err"><?=esc_local(implode(", ", $errors))?></div><?php endif; ?>
    <form method="post">
      <label>Booking date</label><br>
      <input type="date" name="booking_date" required style="padding:8px;border-radius:6px;border:1px solid #e8eef9"/><br><br>
      <label>Travelers</label><br>
      <input type="number" name="travelers" value="1" min="1" style="padding:8px;border-radius:6px;border:1px solid #e8eef9;width:100px"/><br><br>
      <button class="btn" type="submit">Confirm Booking</button>
    </form>
  </div>
</div>
</body></html>
