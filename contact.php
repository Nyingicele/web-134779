<?php
// Database connection
require 'db.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name       = mysqli_real_escape_string($conn, trim($_POST['c_name']));
    $email      = mysqli_real_escape_string($conn, trim($_POST['c_email']));
    $university = mysqli_real_escape_string($conn, trim($_POST['c_university'] ?? ''));
    $reason     = mysqli_real_escape_string($conn, trim($_POST['c_reason']));
    $subject    = mysqli_real_escape_string($conn, trim($_POST['c_subject']));
    $message    = mysqli_real_escape_string($conn, trim($_POST['c_message']));

    // Check required fields
    if (empty($name) || empty($email) || empty($reason) || empty($subject) || empty($message)) {
        die("Error: All required fields must be filled in.");
    }

    // Insert into database
    $sql = "INSERT INTO messages (name, email, university, reason, subject, message) 
            VALUES ('$name', '$email', '$university', '$reason', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        $new_id = mysqli_insert_id($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Message Sent — UniTrade</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="index.html" class="logo">Uni<span>Trade</span></a>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="listings.html">Browse</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <a href="register.html" class="nav-cta">Join Free</a>
    </nav>

    <!-- Success Message -->
    <div class="page-banner" style="background: #2d6a4f;">
        <h1 style="color: #fff;">✅ Message Sent!</h1>
        <p style="color: #d8f3dc;">Thanks <?php echo htmlspecialchars($name); ?>, we'll get back to you within 24 hours.</p>
    </div>

    <div class="container" style="padding: 3rem 2rem; text-align: center;">
        <div class="form-card" style="max-width: 600px; margin: 0 auto;">
            <h2>Message Summary</h2>
            <p class="subtitle">Here's what we received from you:</p>

            <table class="contact-table" style="margin: 1.5rem 0; text-align: left;">
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo htmlspecialchars($name); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <td>University</td>
                    <td><?php echo htmlspecialchars($university ?: 'Not provided'); ?></td>
                </tr>
                <tr>
                    <td>Reason</td>
                    <td><?php echo htmlspecialchars($reason); ?></td>
                </tr>
                <tr>
                    <td>Subject</td>
                    <td><?php echo htmlspecialchars($subject); ?></td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td><?php echo htmlspecialchars($message); ?></td>
                </tr>
                <tr>
                    <td>Reference ID</td>
                    <td>#<?php echo $new_id; ?></td>
                </tr>
            </table>

            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="index.html" class="btn btn-primary">Home</a>
                <a href="contact.html" class="btn btn-outline">Send Another</a>
                <a href="records.php" class="btn btn-outline">View Records</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="footer-logo">Uni<span>Trade</span></span>
                <p>The student-to-student exchange platform built for university communities.</p>
            </div>
            <div class="footer-col">
                <h4>Navigate</h4>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="listings.html">Browse Listings</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">&copy; 2026 UniTrade &mdash; Web Development Assignment</div>
    </footer>

</body>
</html>
<?php
    } else {
        echo "Error saving message: " . mysqli_error($conn);
    }

} else {
    // Redirect if someone tries to access this file directly
    header("Location: contact.html");
    exit();
}

mysqli_close($conn);
?>
