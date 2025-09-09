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

    // Collect search criteria, safely handling empty/missing values.
    $jobtitle      = isset($_GET["jobtitle"]) ? trim($_GET["jobtitle"]) : '';
    $positiontype  = isset($_GET["positiontype"]) ? trim($_GET["positiontype"]) : '';
    $contracttype  = isset($_GET["contracttype"]) ? trim($_GET["contracttype"]) : '';
    // Corrected to handle an array from the form.
    $joblocation   = isset($_GET["joblocation"]) ? $_GET["joblocation"] : [];
    // Corrected to handle an array from the form.
    $accept        = isset($_GET["accept"]) ? $_GET["accept"] : [];

    $dir = "../../../data/jobs";
    $filename = $dir . "/positions.txt";

    if (!file_exists($filename)) {
        echo "<p>No job listings available.</p>";
        exit;
    }

    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $matches = [];

    foreach ($lines as $line) {
        $fields = explode("\t", $line);
        // Corrected to match the 8 fields saved in the file.
        if (count($fields) < 8) {
            continue;
        }

        // Corrected to match the 8 fields saved in the file.
        list($id, $title, $desc, $closing, $position, $contract, $location, $acceptMethod) = $fields;

        $match = true;

        // Condition 1: Check for job title
        if (!empty($jobtitle) && stripos($title, $jobtitle) === false) {
            $match = false;
        }

        // Condition 2: Check for position type (Full-time/Part-time)
        if (!empty($positiontype) && strcasecmp($position, $positiontype) !== 0) {
            $match = false;
        }

        // Condition 3: Check for contract type (Ongoing/Fixed Term)
        if (!empty($contracttype) && strcasecmp($contract, $contracttype) !== 0) {
            $match = false;
        }

        // Condition 4: Check for job location.
        // Use in_array() to correctly check if the location is in the search array.
        if (!empty($joblocation) && !in_array($location, $joblocation)) {
            $match = false;
        }

        // Condition 5: Check for application type (Post/Email)
        if (!empty($accept)) {
            // Split the stored string into an array of methods
            $jobAcceptMethods = explode(", ", $acceptMethod);
            // Find the intersection of search methods and job's methods
            $intersection = array_intersect($accept, $jobAcceptMethods);
            // If the intersection is empty, no match was found.
            if (empty($intersection)) {
                $match = false;
            }
        }

        if ($match) {
            $matches[] = [
                'id'       => $id,
                'title'    => $title,
                'desc'     => $desc,
                'closing'  => $closing,
                'position' => $position,
                'contract' => $contract,
                'location' => $location,
                'accept'   => $acceptMethod
            ];
        }
    }

    // Display results
    if (count($matches) > 0) {
        echo "<h2>Found " . count($matches) . " job(s)</h2><hr>";
        foreach ($matches as $job) {
            echo "<div>";
            echo "<p><strong>ID:</strong> " . htmlspecialchars($job['id']) . "</p>";
            echo "<p><strong>Title:</strong> " . htmlspecialchars($job['title']) . "</p>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($job['desc']) . "</p>";
            echo "<p><strong>Closing Date:</strong> " . htmlspecialchars($job['closing']) . "</p>";
            echo "<p><strong>Position:</strong> " . htmlspecialchars($job['position']) . "</p>";
            echo "<p><strong>Contract:</strong> " . htmlspecialchars($job['contract']) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($job['location']) . "</p>";
            // Corrected to display the stored accept methods
            echo "<p><strong>Accept by:</strong> " . htmlspecialchars($job['accept']) . "</p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>No job listings match your search criteria.</p>";
    }

    echo "<p><a href='searchjobform.php'>Search Again</a></p>";
    echo "<p><a href='index.php'>Go to Home</a></p>";
?>
</body>
</html>