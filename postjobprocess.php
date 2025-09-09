<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Buntry" />
    <title>Job Posting Save</title>
</head>
<body>
<h1>Job Posting Submission</h1>
<?php
if (
    isset($_POST["positionid"]) &&
    isset($_POST["title"]) &&
    isset($_POST["description"]) &&
    isset($_POST["closingdate"]) &&
    isset($_POST["position"]) &&
    isset($_POST["contract"]) &&
    isset($_POST["location"]) &&
    isset($_POST["accept"]) 
) {
    $positionid  = trim($_POST["positionid"]);
    $title       = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $closingdate = trim($_POST["closingdate"]);
    $position    = trim($_POST["position"]);
    $contract    = trim($_POST["contract"]);
    $location    = trim($_POST["location"]);
    $accept      = trim($_POST["accept"]); 
    $errors = [];
    
    if (!preg_match("/^ID[0-9]{3}$/", $positionid)) {
        $errors[] = "Position ID must be in the format ID followed by 3 digits (e.g., ID001).";
    }
    if (!preg_match("/^[A-Za-z0-9 ,.!\s]{1,20}$/", $title)) {
        $errors[] = "Title can only contain letters, numbers, spaces, commas, periods, and exclamation points (max 20 chars).";
    }
    if (strlen($description) == 0 || strlen($description) > 100) {
        $errors[] = "Description is required and cannot exceed 100 characters.";
    }
    if (preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/", $closingdate)) {
        // Convert string (dd/mm/yyyy) into DateTime
        $dateObj = DateTime::createFromFormat('d/m/Y', $closingdate);
        $today   = new DateTime();
        $today->setTime(0, 0, 0);
        if ($dateObj < $today) {
            $errors[] = "Closing date cannot be in the past.";
        }
    } else {
        $errors[] = "Invalid closing date format. Use dd/mm/yyyy.";
    }

    if (!empty($errors)) {
        echo "<p>The following errors occurred:</p><ul>";
        foreach ($errors as $err) {
            echo "<li>" . htmlspecialchars($err) . "</li>";
        }
        echo "</ul>";
        echo "<p><a href='postjobform.php'>Post Another Job</a></p>";
        echo "<p><a href='index.php'>Go to Home Page</a></p>";
        exit;
    }
    
    // --- Create directory if not exists ---
    umask(0007);
    $dir = "../../../data/jobs";  
    if (!file_exists($dir)) {
        mkdir($dir, 02770);
    }

    $filename = $dir . "/positions.txt";
    $handle = fopen($filename, "a");

    // Corrected the record string, $accept is now a single value
    $record = $positionid . "\t" .
              $title . "\t" .
              $description . "\t" .
              $closingdate . "\t" .
              $position . "\t" .
              $contract . "\t" .
              $location . "\t" .
              $accept;

    if ($handle) {
        if (fwrite($handle, $record . PHP_EOL)) {
            echo "<p>✅ Thank you for posting your job application!</p>";
            echo "<p><a href='index.php'>Go to Home Page</a></p>";
        } else {
            echo "<p>❌ Cannot save your job application.</p>";
        }
        fclose($handle);
    } else {
        echo "<p>❌ Unable to open job application file.</p>";
    }
} else {
    echo "<p style='color:red'>❌ Invalid access. Please submit the form.</p>";
    echo "<p><a href='postjobform.php'>Post a Job</a></p>";
    echo "<p><a href='index.php'>Go to Home Page</a></p>";
}
?>
</body>
</html>