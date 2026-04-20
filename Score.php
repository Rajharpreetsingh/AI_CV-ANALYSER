<?php
session_start();

if (!isset($_SESSION['analysis'])) {
    header("Location: index.php");
    exit();
}

$analysis = $_SESSION['analysis'] ?? "";

// ✅ Extract score using REGEX
$score = null;

// ✅ Handle formats like: **Score:** 60
if (preg_match('/\*\*Score:\*\*\s*([0-9]{1,3})/i', $analysis, $m)) {
    $score = (int)$m[1];
}
// ✅ Handle: Score: 60/100
elseif (preg_match('/Score[:\s\-]*([0-9]{1,3})\s*\/\s*100/i', $analysis, $m)) {
    $score = (int)$m[1];
}
// ✅ Handle: Score: 60
elseif (preg_match('/Score[:\s\-]*([0-9]{1,3})/i', $analysis, $m)) {
    $score = (int)$m[1];
}
// ✅ Handle: 60 out of 100
elseif (preg_match('/([0-9]{1,3})\s*out\s*of\s*100/i', $analysis, $m)) {
    $score = (int)$m[1];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>CV Score</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>

<body style="background:linear-gradient(135deg,#4C8CE4,#6dd5ed);">

<div class="container mt-5">

<div class="card shadow p-4">

<h2 class="text-center mb-4">🤖 AI CV Analysis</h2>

<!-- ✅ SCORE SECTION -->
<?php  if($score >= 0): ?>
<div class="mb-4">
    <h4>ATS Score: <?php echo $score; ?>/100</h4>
    
    <div class="progress" style="height:25px;">
        <div class="progress-bar 
            <?php 
                if($score > 75) echo 'bg-success';
                elseif($score > 50) echo 'bg-warning';
                else echo 'bg-danger';
            ?>"
            style="width: <?php echo $score; ?>%;">
            <?php echo $score; ?>%
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ✅ ANALYSIS TEXT -->
<div class="alert alert-info" style="white-space: pre-line; font-size:16px;">

<?php echo htmlspecialchars($analysis); ?>
  
</div>

<!-- ✅ BUTTONS -->
<div class="text-center mt-3">
    <a href="Dashboard.php" class="btn btn-primary">🔁 Analyze Another CV</a>
    <a href="index.php" class="btn btn-danger">🚪 Logout  <?php   exit();?></a>
</div>

</div>

</div>

</body>
</html>