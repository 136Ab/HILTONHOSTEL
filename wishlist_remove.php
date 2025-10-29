<?php
// wishlist_remove.php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$uid = (int)$_SESSION['user_id'];
$did = (int)($_GET['destination_id'] ?? 0);
if ($did && $conn) {
    $del = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND destination_id = ?");
    $del->bind_param("ii", $uid, $did);
    $del->execute();
}
header("Location: dashboard.php");
exit;
