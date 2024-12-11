<?php
  if (!isset($userInfo['email']) || !isset($userInfo['name'])){
    return redirect()->to('login');
  } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard.Professional</title>
  <link rel="stylesheet" href="<?= base_url('css/professional-dashboard.css') ?>">
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
      <span>Professional Dashboard</span>
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
        <a class="active" href="<?php echo site_url('professionalHome'); ?>">Home</a>
        <a  href="<?php echo site_url('professionalProfile'); ?>">Manage Profile</a>
        <a  href="<?php echo site_url('professionalRatings'); ?>">View Ratings</a>
        <a class="log-out-button" href="#" onclick="confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Home</h2>
      <div class="promo_card">
          <h1>Welcome: <?= $userInfo['name']; ?></h1>
          <p>This is your dashboard. Use the sidebar to navigate to your desired location.</p>
          <ol>
            <li>Use <b>Manage Profile</b> to:
              <ol>
                <li>Update your password</li>
                <li>Delete your account</li>
                <li>Specify your profession or submit your certification document</li>
              </ol>
            </li>
            <br>
            <li>Use <b>View Ratings</b> to view your ratings history.</li>
            <li>An average rating <b>greater than 4</b> means you have a high likelihood of being recommended to project managers</li>
          </ol>
      </div>
    </div>
  </div>
</body>
</html>

<?php 
  }
?>
