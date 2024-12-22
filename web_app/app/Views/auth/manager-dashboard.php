<?php
if (!isset($userInfo['email']) || !isset($userInfo['name'])) {
  return redirect()->to('login');
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <title>Dasboard.Home</title>
    <link rel="stylesheet" href="<?= base_url('css/manager-dashboard.css') ?>">
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
        <span>Manager Dashboard</span>
      </div>
      <div class="header-icons">
        <div class="account">
          <h4><?= $userInfo['email']; ?></h4>
        </div>
      </div>
    </header>

    <div class="container">
      <nav>
        <div class="side_navbar">
          <a class="active" href="#">Home</a>
          <a href="<?php echo site_url('managerProfile'); ?>">Manage Profile</a>
          <a href="<?php echo site_url('enlistProfessionals'); ?>">Enlist Professionals</a>
          <a href="<?php echo site_url('enlistServices'); ?>">Enlist Services</a>
          <a href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
          <a class="log-out-button" href="#" onclick="confirmLogout()">Logout</a>
        </div>
      </nav>

      <div class="main-body">
        <h2>Home</h2>
        <div class="promo_card">
          <h1>Welcome: <?= $userInfo['name']; ?></h1>
          <p>Use the sidebar to navigate to your desired location.</p>
        </div>
      </div>
    </div>
  </body>

  </html>

<?php
}
?>