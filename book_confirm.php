<?php
// book_confirm.php
session_start();
require_once 'db.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id || !$conn) { header("Location: index.php"); exit; }

$stmt = $conn->prepare("SELECT b.*, u.username, d.name as destination_name FROM bookings b JOIN users u ON u.id=b.user_id JOIN destinations d ON d.id=b.destination_id WHERE b.id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$booking) { echo "<p style='padding:20px'>Booking not found.</p>"; exit; }

function esc_local($s){ return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Booking Confirmed</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
body{font-family:Arial,Helvetica,sans-serif;background:#f7f9fc;margin:0;padding:24px}
.card{background:white;padding:18px;border-radius:12px;max-width:760px;margin:0 auto;box-shadow:0 8px 28px rgba(13,43,77,0.06)}
.btn{background:#0d6efd;color:white;padding:10px;border-radius:8px;border:none;cursor:pointer}
</style>
</head><body>
<div class="card">
  <h2>Booking Confirmed</h2>
  <p>Reference ID: <strong><?=esc_local($booking['id'])?></strong></p>
  <p>Trip: <?=esc_local($booking['destination_name'])?></p>
  <p>User: <?=esc_local($booking['username'])?></p>
  <p>Booking Date: <?=esc_local($booking['booking_date'])?></p>
  <p>Travelers: <?=esc_local($booking['travelers'])?></p>
  <p>Total: $<?=esc_local($booking['total_price'])?></p>
  <p>Status: <?=esc_local($booking['status'])?></p>
  <button class="btn" onclick="window.location.href='dashboard.php'">Go to Dashboard</button>
</div>
</body></html>
