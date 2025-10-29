<?php
// review_submit.php
session_start();
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { header("Location: index.php"); exit; }
$uid = (int)$_SESSION['user_id'];
$destination_id = (int)($_POST['destination_id'] ?? 0);
$rating = (int)($_POST['rating'] ?? 5);
$title = trim($_POST['title'] ?? '');
$comment = trim($_POST['comment'] ?? '');
if ($rating <1) $rating = 1; if ($rating>5) $rating = 5;
if ($destination_id && $conn) {
    $ins = $conn->prepare("INSERT INTO reviews (user_id, destination_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())");
    $ins->bind_param("iiis", $uid, $destination_id, $rating, $comment);
    $ins->execute();
}
header("Location: dashboard.php");
exit;
