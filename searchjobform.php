<!DOCTYPE html>
  <html lang="en">
  <head>
  <title>Search Job Form</title>
  <meta charset="utf-8">
</head>
<body>
  <h1>Search Job Listings</h1>  

  <form action="searchjobprocess.php" method="get">
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
      <p>
          <label>Application Type:</label><br>
          <input type="checkbox" name="accept[]" value="Post"> Post
          <input type="checkbox" name="accept[]" value="Email"> Email
      </p>
      <p>
          <label for="joblocation">Location:</label>
          <input type="checkbox" name="joblocation[]" id="joblocation" value="On site"> On site
          <input type="checkbox" name="joblocation[]" id="joblocation" value="Remote"> Remote
      </p>
      <p>
          <button type="submit">Search</button>
          <button type="reset">Reset</button>
      </p>
  </form>

  <p><a href="index.php">Return to Home</a></p>
</body>
</html>
