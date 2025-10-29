<?php
// wishlist_add.php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$uid = (int)$_SESSION['user_id'];
$did = (int)($_GET['destination_id'] ?? 0);
if ($did && $conn) {
    $ins = $conn->prepare("INSERT IGNORE INTO wishlist (user_id, destination_id, created_at) VALUES (?, ?, NOW())");
    $ins->bind_param("ii", $uid, $did);
    $ins->execute();
}
header("Location: dashboard.php");
exit;
