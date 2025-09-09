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

<h1>Posting Job Application</h1>

<form action="postjobprocess.php" method="POST">

  <label for="Position">Position ID:</label>
  <input type="text" id="Position" name="positionid" 
        pattern="^ID[0-9]{3}$" 
        title="Format: ID followed by 3 digits (e.g. ID001)" 
        required />
  <label for="title">Job Title:</label>
  <input type="text" id="title" name="title" 
        maxlength="20" 
        pattern="[A-Za-z0-9 ,.!\s]{1,20}" 
        title="Only letters, numbers, space, comma, period, and exclamation allowed." 
        required />
  <label for="description">Job Description:</label>
  <textarea id="description" name="description" maxlength="100" required></textarea>
  <label for="closingdate">Closing Date:</label>
  <input type="text" id="closingdate" name="closingdate" 
        pattern="^\d{1,2}/\d{1,2}/\d{4}$"
        value="<?php echo date('d/m/Y'); ?>" 
        title="Format: dd/mm/yyyy"  
        required />

  <fieldset>
    <legend>Position Type:</legend>
    <label><input type="radio" name="position" value="Full Time" required /> Full-Time</label>
    <label><input type="radio" name="position" value="Part Time" required /> Part-Time</label>
  </fieldset>

  <fieldset>
  <legend>Contract Type:</legend>
    <label><input type="radio" name="contract" value="Ongoing" required /> On-going</label>
    <label><input type="radio" name="contract" value="Fixed Term" required /> Fixed term</label>
  </fieldset>

  <fieldset>
    <legend>Location:</legend>
    <label><input type="radio" name="location" value="On site" required /> On-site</label>
    <label><input type="radio" name="location" value="Remote" required /> Remote</label>
  </fieldset>

  <fieldset>
    <legend>Accept Application By:</legend>
    <label><input type="checkbox" name="accept" value="Post" /> Post</label>
    <label><input type="checkbox" name="accept" value="Email" /> Email</label>
  </fieldset>
  <br>
  <input type="submit" value="Post Job Application" />
</form>

<!-- Link back to Home -->
<p><a href="index.php">Return to Home</a></p>

</body>
</html>
