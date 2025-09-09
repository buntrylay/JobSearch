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

<form action="searchjobprocess.php" method="GET">
  <!-- Job Title -->
  <label for="jobtitle">Job Title:</label>
  <input type="text" id="jobtitle" name="jobtitle" required />
  <input type="submit" value="Search" />
</form>

<!-- Link back to Home -->
<p><a href="index.php">Return to Home</a></p>

</body>
</html>
