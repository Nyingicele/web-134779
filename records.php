<?php
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Database Records — UniTrade</title>
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
    <div class="breadcrumb"><a href="index.html">Home</a> › Database Records</div>
    <h1>Database Records</h1>
    <p>All registered users and contact messages stored in MySQL</p>
  </div>

  <div class="container" style="padding: 3rem 0;">

    <div class="section-label">MySQLi Data Retrieval</div>
    <h2 class="section-title">Registered Users</h2>
    <p class="section-desc">Records retrieved from the <strong>users</strong> table in <strong>unitrade_db</strong>.</p>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
    $count  = mysqli_num_rows($result);
    ?>

    <p style="margin-bottom:1rem; font-size:14px; color:var(--text-muted);">
      Total records: <strong><?php echo $count; ?></strong>
    </p>

    <?php if ($count > 0): ?>
    <div style="overflow-x:auto; margin-bottom:3rem;">
      <table class="contact-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Student ID</th>
            <th>University</th>
            <th>Faculty</th>
            <th>Year</th>
            <th>Registered</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['student_id']); ?></td>
            <td><?php echo htmlspecialchars($row['university']); ?></td>
            <td><?php echo htmlspecialchars($row['faculty']); ?></td>
            <td><?php echo htmlspecialchars($row['year']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="form-card" style="margin-bottom:3rem; text-align:center;">
      <p style="color:var(--text-muted);">No registered users yet. <a href="register.html">Register the first one →</a></p>
    </div>
    <?php endif; ?>

    <div class="section-label">MySQLi Data Retrieval</div>
    <h2 class="section-title">Contact Messages</h2>
    <p class="section-desc">Records retrieved from the <strong>messages</strong> table in <strong>unitrade_db</strong>.</p>

    <?php
    $result2 = mysqli_query($conn, "SELECT * FROM messages ORDER BY sent_at DESC");
    $count2  = mysqli_num_rows($result2);
    ?>

    <p style="margin-bottom:1rem; font-size:14px; color:var(--text-muted);">
      Total records: <strong><?php echo $count2; ?></strong>
    </p>

    <?php if ($count2 > 0): ?>
    <div style="overflow-x:auto; margin-bottom:3rem;">
      <table class="contact-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Reason</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Sent</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result2)): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['reason']); ?></td>
            <td><?php echo htmlspecialchars($row['subject']); ?></td>
            <td><?php echo htmlspecialchars($row['message']); ?></td>
            <td><?php echo $row['sent_at']; ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="form-card" style="text-align:center;">
      <p style="color:var(--text-muted);">No messages yet. <a href="contact.html">Send the first one →</a></p>
    </div>
    <?php endif; ?>

  </div>

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
          <li><a href="register.html">Register</a></li>
          <li><a href="contact.html">Contact Us</a></li>
          <li><a href="records.php">View Records</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">&copy; 2025 UniTrade &mdash; Web Development Assignment</div>
  </footer>

<?php mysqli_close($conn); ?>
</body>
</html>