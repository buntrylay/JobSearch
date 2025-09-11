<!DOCTYPE html>
<html lang="en">
<head>
    <title>My First PHP webpage</title>
    <meta charset="utf-8">
    <meta name="description" content="Assignment1 homepage">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Buntry">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header><h1>Searching Job Application</h1></header>
    <?php
        // Collect search criteria, safely handling empty/missing values.
        $jobtitle      = isset($_GET["jobtitle"]) ? trim($_GET["jobtitle"]) : '';
        $positiontype  = isset($_GET["positiontype"]) ? trim($_GET["positiontype"]) : '';
        $contracttype  = isset($_GET["contracttype"]) ? trim($_GET["contracttype"]) : '';
        // Corrected to handle an array from the form.
        $joblocation   = isset($_GET["joblocation"]) ? $_GET["joblocation"] : [];
        // Corrected to handle an array from the form.
        $accept        = isset($_GET["accept"]) ? $_GET["accept"] : [];

        $dir = "../../data/jobs";
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
            if (!empty($joblocation) && !in_array($location, $joblocation)) {
                $match = false;
            }

            // Condition 5: Check for application type (Post/Email)
            if (!empty($accept)) {
                $jobAcceptMethods = explode(", ", $acceptMethod);

                $intersection = array_intersect($accept, $jobAcceptMethods);

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
            echo "<div class='results'>";
            echo "<h2>Found " . count($matches) . " job(s)</h2><hr>";
            foreach ($matches as $job) {
                echo "<div class='job-card'>";
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
            echo "</div>";
        } else {
            echo "<p>No job listings match your search criteria.</p>";
        }
    ?>
    <div class="pages">
        <p><a href='searchjobform.php'>Search Again</a></p>
        <p><a href='index.php'>Go to Home</a></p>
    </div>
</body>
</html>