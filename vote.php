<?php
require 'includes/config.php';
if(!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$user_id = $_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $candidate_id = intval($_POST['candidate_id']);
    $stmt = $pdo->prepare("SELECT id FROM votes WHERE user_id = ?");
    $stmt->execute([$user_id]);
    if($stmt->fetch()){
        $msg = "You already voted.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO votes (user_id, candidate_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $candidate_id]);
        $msg = "Vote cast successfully.";
    }
}
$candidates = $pdo->query("SELECT * FROM candidates")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Vote</title></head><body>
<h2>Cast Your Vote</h2>
<?php if(!empty($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
<form method="post">
<?php foreach($candidates as $c): ?>
  <label><input type="radio" name="candidate_id" value="<?php echo $c['id']; ?>"> <?php echo htmlspecialchars($c['name'].' ('.$c['party'].')'); ?></label><br>
<?php endforeach; ?>
<button type="submit">Vote</button>
</form>
<p><a href="dashboard.php">Back</a></p>
</body></html>
