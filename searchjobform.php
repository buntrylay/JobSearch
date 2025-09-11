<!DOCTYPE html>
    <html lang="en">
    <head>
    <title>Search Job Form</title>
    <meta charset="utf-8">
    <meta name="description" content="Job Search Form">
    <meta name="keywords" content="HTML, CSS, PHP">
    <link rel="stylesheet" href="styles.css">
    <meta name="author" content="Buntry">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <header><h1>Search Job Listings</h1></header>

  <form action="searchjobprocess.php" method="get">
        <fieldset>
        <p>Please fill in the form below to search for a job vacancy:</p>
        <p>
            <label for="jobtitle">Job Title:</label>
            <input type="text" name="jobtitle" id="jobtitle">
        </p>
        <p>
            <label for="positiontype">Position:</label>
            <select name="positiontype" id="positiontype">
                <option value="">Any</option>
                <option value="Full Time">Full-Time</option>
                <option value="Part Time">Part-Time</option>
                <option value="Casual">Casual</option>
            </select>
        </p>
        <p>
            <label for="contracttype">Contract:</label>
            <select name="contracttype" id="contracttype">
                <option value="">Any</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Fixed Term">Fixed Term</option>
            </select>
        </p>

        <fieldset>
            <legend>Application Type:</legend>
            <input type="checkbox" name="accept[]" value="Post"> Post
            <input type="checkbox" name="accept[]" value="Email"> Email
        </fieldset>
        <fieldset>
        <legend for="joblocation">Location:</legend>
            <input type="checkbox" name="joblocation[]" id="joblocation" value="On site"> On site
            <input type="checkbox" name="joblocation[]" id="joblocation" value="Remote"> Remote
        </fieldset>
        <p>
            <button type="submit">Search</button>
            <button type="reset">Reset</button>
        </p>

        </fieldset>
  </form>

  <div class="pages">
      <a href="index.php">Return to Home pages</a>
  </div>
</body>
</html>
