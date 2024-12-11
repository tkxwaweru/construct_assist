<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard.Professional.Ratings</title>
  <link rel="stylesheet" href="<?= base_url('css/admin-dashboard.css') ?>">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <script>
    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
        window.location.href = "<?php echo site_url('logout'); ?>";
      }
    }
  </script>
</head>
<body>
  <header class="header">
    <div class="title">
      <span>Administrator Dashboard</span>
    </div>
    <div class="header-icons">
      <div class="account">
        <h4><?= session('email'); ?></h4>
      </div>
    </div>
  </header>

  <div class="container">
    <nav>
      <div class="side_navbar">
        <a href="<?php echo site_url('adminHome'); ?>">Home</a>
        <a href="<?php echo site_url('adminProfile'); ?>">Manage Profile</a>
        <a href="<?php echo site_url('registerAdmin'); ?>">Register new Admin</a>
        <a href="<?php echo site_url('viewUsers'); ?>">View User Records</a>
        <a class="active" href="#">View Professional Ratings</a>
        <a href="<?php echo site_url('viewProviderRatings'); ?>">View Provider Ratings</a>
        <a class="log-out-button" href="#" onclick="confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Professional Ratings</h2>
      <div class="promo_card">
          <h2>Profile: <?= session('name'); ?></h2>
          <p>Professional ratings:</p><br>
          <table>
            <tr>
              <th>Rating ID</th>
              <th>Professional ID</th>
              <th>Score</th>
              <th>Comment</th>
              <th>Rated on</th>
            </tr>
            <tr>
            <?php foreach ($professional_ratings as $professional_rating): ?>
              <tr>
                <td><?= $professional_rating['professional_rating_id']; ?></td>
                <td><?= $professional_rating['professional_id']; ?></td>
                <td><?= $professional_rating['score']; ?></td>
                <td><?= $professional_rating['comment']; ?></td>
                <td><?= $professional_rating['rated_on']; ?></td>
              </tr>
            <?php endforeach; ?>
            </tr>
          </table>
      </div>
    </div>
  </div>
</body>
</html>
