<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dasboard.Profile</title>
  <link rel="stylesheet" href="<?= base_url('css/manager-dashboard.css') ?>">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

  <script>
    function confirmLogout() {
      if (confirm('Are you sure you want to logout?')) {
        window.location.href = "<?php echo site_url('logout'); ?>";
      }
    }

    function confirmAccountDeletion() {
      if (confirm('Are you sure you want to delete your account?')) {
        window.location.href = "<?php echo site_url('managerAccountDelete'); ?>";
      }
    }
  </script>

</head>
<body>
  <header class="header">
    <div class="title">
      <span>Manager Dashboard</span>
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
        <a href="<?php echo site_url('managerHome'); ?>">Home</a>
        <a class="active" href="#">Manage Profile</a>
        <a href="<?php echo site_url('enlistProfessionals'); ?>">Enlist Professionals</a>
        <a href="<?php echo site_url('enlistServices'); ?>">Enlist Services</a>
        <a href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
        <a class="log-out-button" href="#" onclick="confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Manage Profile</h2>
      <div class="promo_card">
          <h2>Profile: <?= session('name'); ?></h2>
          <p>Click on an option:</p>
          <ol>
            <li>Reset Password: <a href="<?php echo site_url('managerPasswordRequest'); ?>">Click here</a></li>
            <li>Delete Account: <a href="#" onclick="confirmAccountDeletion()">Click here</a></li>
          </ol>
      </div>
    </div>
  </div>
</body>
</html>
