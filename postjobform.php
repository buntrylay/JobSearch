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
  <header><h1>Posting Job Application</h1></header>

  <form action="postjobprocess.php" method="POST">
    <p>Please fill in the form below to post a job vacancy:</p>

    <fieldset>
      <legend>Job Details:</legend>
      <p>
      <label for="Position">Position ID:</label>
      <input type="text" id="Position" name="positionid" 
            pattern="^ID[0-9]{3}$" 
            title="Format: ID followed by 3 digits (e.g. ID001)" 
            required />
      </p>
      <p>
      <label for="title">Job Title:</label>
      <input type="text" id="title" name="title" 
            maxlength="20" 
            pattern="[A-Za-z0-9 ,.!\s]{1,20}" 
            title="Only letters, numbers, space, comma, period, and exclamation allowed." 
            required /><br>
      </p>
      <p>
      <label for="description">Job Description:</label>
      <textarea id="description" name="description" maxlength="100" required></textarea>
      </p>
      <p>
      <label for="closingdate">Closing Date:</label>
      <input type="text" id="closingdate" name="closingdate" 
            pattern="^\d{1,2}/\d{1,2}/\d{4}$"
            value="<?php echo date('d/m/Y'); ?>" 
            title="Format: dd/mm/yyyy"  
            required /><br>
      </p>
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
      
      <p>
        <button type="submit" value="Post Job Application">Post Job Application</button>
        <button type="reset" value="Reset Form">Reset Form</button>
      </p>
    </fieldset>
  </form>

  <div class="pages">
      <a href="index.php">Return to Home pages</a>
  </div>

</body>
</html>
