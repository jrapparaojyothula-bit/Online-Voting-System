<?php
require 'includes/config.php';
if(!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin'){ header('Location: index.php'); exit; }

if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])){
    $stmt = $pdo->prepare("INSERT INTO candidates (name, party, manifesto) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['party'], $_POST['manifesto']]);
    $msg = "Candidate added.";
}

$candidates = $pdo->query("SELECT * FROM candidates ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin</title></head><body>
<h2>Admin - Manage Candidates</h2>
<?php if(!empty($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
<form method="post">
  <label>Name: <input name="name"></label><br>
  <label>Party: <input name="party"></label><br>
  <label>Manifesto: <textarea name="manifesto"></textarea></label><br>
  <button type="submit">Add Candidate</button>
</form>
<h3>Existing</h3>
<ul>
<?php foreach($candidates as $c): ?>
  <li><?php echo htmlspecialchars($c['name'].' ('.$c['party'].')'); ?></li>
<?php endforeach; ?>
</ul>
<p><a href="dashboard.php">Back</a></p>
</body></html>
