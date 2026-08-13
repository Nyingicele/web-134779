<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $fname      = mysqli_real_escape_string($conn, trim($_POST['fname']));
    $lname      = mysqli_real_escape_string($conn, trim($_POST['lname']));
    $email      = mysqli_real_escape_string($conn, trim($_POST['email']));
    $student_id = mysqli_real_escape_string($conn, trim($_POST['student_id']));
    $university = mysqli_real_escape_string($conn, trim($_POST['university']));
    $faculty    = mysqli_real_escape_string($conn, trim($_POST['faculty']));
    $year       = mysqli_real_escape_string($conn, trim($_POST['year']));
    $phone      = mysqli_real_escape_string($conn, trim($_POST['phone'] ?? ''));
    $bio        = mysqli_real_escape_string($conn, trim($_POST['bio'] ?? ''));

    
    if (empty($fname) || empty($lname) || empty($email) || empty($student_id) || empty($university) || empty($faculty) || empty($year)) {
        die("Error: All required fields must be filled in.");
    }

    $sql = "INSERT INTO users (fname, lname, email, student_id, university, faculty, year, phone, bio)
            VALUES ('$fname', '$lname', '$email', '$student_id', '$university', '$faculty', '$year', '$phone', '$bio')";

    if (mysqli_query($conn, $sql)) {
        $new_id = mysqli_insert_id($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registration Successful — UniTrade</title>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>

  <nav class="navbar">
    <a href="index.html" class="logo">Uni<span>Trade</span></a>
    <ul class="nav-links">
      <li><a href="index.html">Home</a></li>
      <li><a href="listings.html">Browse</a></li>
      <li><a href="gallery.html">Gallery</a></li>
      <li><a href="register.html">Register</a></li>
      <li><a href="contact.html">Contact</a></li>
    </ul>
  </nav>

  <div class="page-banner">
    <h1>🎉 Registration Successful!</h1>
    <p>Welcome to UniTrade, <?php echo htmlspecialchars($fname); ?>!</p>
  </div>

  <div class="container" style="padding: 3rem 2rem; text-align:center;">
    <div class="form-card" style="max-width:500px; margin:0 auto;">
      <h2>You're in!</h2>
      <p class="subtitle">Your account has been created successfully. Here's a summary of what was saved:</p>

      <table class="contact-table" style="margin: 1.5rem 0; text-align:left;">
        <tr><th>Field</th><th>Value</th></tr>
        <tr><td>Name</td><td><?php echo htmlspecialchars($fname . ' ' . $lname); ?></td></tr>
        <tr><td>Email</td><td><?php echo htmlspecialchars($email); ?></td></tr>
        <tr><td>Student ID</td><td><?php echo htmlspecialchars($student_id); ?></td></tr>
        <tr><td>University</td><td><?php echo htmlspecialchars($university); ?></td></tr>
        <tr><td>Faculty</td><td><?php echo htmlspecialchars($faculty); ?></td></tr>
        <tr><td>Year</td><td><?php echo htmlspecialchars($year); ?></td></tr>
        <tr><td>Record ID</td><td>#<?php echo $new_id; ?></td></tr>
      </table>

      <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
        <a href="listings.html" class="btn btn-primary">Browse Listings</a>
        <a href="records.php" class="btn btn-outline">View All Records</a>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="footer-bottom">&copy; 2025 UniTrade &mdash; Web Development Assignment</div>
  </footer>

</body>
</html>
<?php
    } else {
        echo "Error saving registration: " . mysqli_error($conn);
    }

} else {
    header("Location: register.html");
    exit();
}

mysqli_close($conn);
?>