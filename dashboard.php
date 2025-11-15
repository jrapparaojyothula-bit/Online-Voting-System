<?php
require 'includes/config.php';
if(!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'] ?? 'user';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title></head>
<body>
<h2>User Dashboard</h2>
<p>Role: <?php echo htmlspecialchars($role); ?></p>
<p><a href="vote.php">Cast Vote</a></p>
<?php if($role === 'admin'): ?>
  <p><a href="admin.php">Admin Panel</a></p>
<?php endif; ?>
<p><a href="results.php">View Results</a></p>
<form method="post" action="logout.php"><button type="submit">Logout</button></form>
</body></html>
