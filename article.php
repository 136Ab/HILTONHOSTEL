<?php
// article.php
session_start();
require_once 'db.php';
$id = (int)($_GET['id'] ?? 0);
if (!$id) { header("Location: blog.php"); exit; }
$stmt = $conn->prepare("SELECT id,title,content,author,created_at FROM blog_posts WHERE id = ? LIMIT 1");
$stmt->bind_param("i",$id);
$stmt->execute();
$art = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$art) { echo "<p style='padding:20px'>Article not found.</p>"; exit; }

if ($conn) $conn->query("UPDATE blog_posts SET views = IFNULL(views,0)+1 WHERE id = " . $id);

function esc_local($s){ return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=esc_local($art['title'])?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
body{font-family:Arial,Helvetica,sans-serif;background:#fbfcfe;margin:0;padding:24px}
.container{max-width:760px;margin:0 auto}
.card{background:white;padding:18px;border-radius:12px;box-shadow:0 6px 22px rgba(13,43,77,0.05)}
.btn{background:#0d6efd;color:white;padding:8px;border-radius:8px;border:none;cursor:pointer}
</style>
</head><body>
<div class="container">
  <div class="card">
    <h1><?=esc_local($art['title'])?></h1>
    <p class="muted">By <?=esc_local($art['author'])?> • <?=esc_local($art['created_at'])?></p>
    <div style="margin-top:16px"><?=nl2br(esc_local($art['content']))?></div>
    <?php if(isset($_SESSION['user_id'])): ?>
      <div style="margin-top:16px"><a class="btn" href="save_article.php?id=<?=esc_local($id)?>">Save this article</a></div>
    <?php endif; ?>
  </div>
</div>
</body></html>
