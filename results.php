<?php
require 'includes/config.php';
$sql = "SELECT c.id, c.name, c.party, COUNT(v.id) AS votes
        FROM candidates c
        LEFT JOIN votes v ON v.candidate_id = c.id
        GROUP BY c.id ORDER BY votes DESC";
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Results</title></head><body>
<h2>Results</h2>
<table border="1" cellpadding="6">
  <tr><th>Candidate</th><th>Party</th><th>Votes</th></tr>
  <?php foreach($rows as $r): ?>
    <tr><td><?php echo htmlspecialchars($r['name']); ?></td><td><?php echo htmlspecialchars($r['party']); ?></td><td><?php echo $r['votes']; ?></td></tr>
  <?php endforeach; ?>
</table>
<p><a href="index.php">Login</a></p>
</body></html>
