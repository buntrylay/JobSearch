<!DOCTYPE html>
<html lang="en">
<head>
<title>My First PHP webpage</title>
<meta charset="utf-8">
<meta name="description" content="Assignment1 homepage">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="author" content="Buntry">
</head>
<body>
<div class="header">
  <h1>Job Search</h1>
</div>

<div class="pages">
    <a href="index.php">Home</a>
    <a href="searchjobform.php">Searching Job List</a>
    <a href="postjobform.php">Posting Job Form</a>
    <a href="about.php">About Us</a>
</div>

<h1>Searching Job Application</h1>
<?php
if (isset($_GET['jobtitle'])) {
} else {
    echo "<p>Error: Job title is required.</p>";
    echo "<p><a href='searchjobform.php'>Return to Search Form</a></p>";
    exit;
}
$jobtitle = trim($_GET["jobtitle"]);

// Path to file (adjust relative path for Mercury environment)
$dir = "../../../data/jobs";
$filename = $dir . "/positions.txt";

if (!file_exists($filename)) {
    echo "<p style='color:red'>❌ No job listings available.</p>";
    echo "<p><a href='searchjobform.php'>Search Again</a></p>";
    echo "<p><a href='index.php'>Go to Home Page</a></p>";
    exit;
}

// ✅ Read file line by line
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$matches = [];
foreach ($lines as $line) {
    $fields = explode("\t", $line);

    // File format (based on your postjobprocess.php):
    // 0: PositionID | 1: Title | 2: Description | 3: ClosingDate | 4: Position | 
    // 5: Contract | 6: Location | 7: AcceptPost | 8: AcceptEmail

    if (count($fields) >= 2) {
        $titleField = $fields[1];
        if (stripos($titleField, $jobtitle) !== false) { // ✅ Req.2 within string match
            $matches[] = $fields;
        }
    }
}

// ✅ Req.3 Display results
if (count($matches) > 0) {
    echo "<p>✅ Found " . count($matches) . " job listing(s) matching '<b>" . htmlspecialchars($jobtitle) . "</b>'.</p>";
    echo "<hr>";

    foreach ($matches as $job) {
        echo "<div style='margin-bottom:20px;'>";
        echo "<p><strong>Position ID:</strong> " . htmlspecialchars($job[0]) . "</p>";
        echo "<p><strong>Title:</strong> " . htmlspecialchars($job[1]) . "</p>";
        echo "<p><strong>Description:</strong> " . htmlspecialchars($job[2]) . "</p>";
        echo "<p><strong>Closing Date:</strong> " . htmlspecialchars($job[3]) . "</p>";
        echo "<p><strong>Position:</strong> " . htmlspecialchars($job[4]) . "</p>";
        echo "<p><strong>Contract:</strong> " . htmlspecialchars($job[5]) . "</p>";
        echo "<p><strong>Location:</strong> " . htmlspecialchars($job[6]) . "</p>";
        echo "<p><strong>Accept by Post:</strong> " . htmlspecialchars($job[7]) . "</p>";
        echo "<p><strong>Accept by Email:</strong> " . htmlspecialchars($job[8]) . "</p>";
        echo "</div><hr>";
    }
} else {
    echo "<p style='color:red'>❌ No job listings matched your search for '<b>" . htmlspecialchars($jobtitle) . "</b>'.</p>";
}

// ✅ Links back (Req.4)
echo "<p><a href='searchjobform.php'>Search Again</a></p>";
echo "<p><a href='index.php'>Go to Home Page</a></p>";
?>

</body>
</html>
