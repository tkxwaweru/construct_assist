<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dasboard.Services</title>
  <link rel="stylesheet" href="<?= base_url('css/manager-dashboard.css') ?>">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
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
        <a href="<?php echo site_url('managerProfile'); ?>">Manage Profile</a>
        <a href="<?php echo site_url('enlistProfessionals'); ?>">Enlist Professionals</a>
        <a href="<?php echo site_url('enlistServices'); ?>">Enlist Services</a>
        <a class="active" href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
        <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Rate Services</h2>
      <div class="promo_card">
        <h2>Profile: <?= session('name'); ?></h2>
        <p>Service review and dismissal:</p>
        <div class="form-container">
          <form action="<?php echo base_url('rateService')?>" method="post">
            <div class="content">
              <h3>Rate the quality of service you received from the individual:</h3>
              <br>
              <div class="input-field">
                <label for="name">Name:</label>
                <input class="form-input" type="text" id="name" name="name" value="<?= $name ?>" readonly>
              </div>
              <div class="input-field">
                <label for="email">Email:</label>
                <input class="form-input" type="text" id="email" name="email" value="<?= $email ?>" readonly>
              </div>
              <div class="input-field">
                <label for="score">Score (out of 5):</label>
                <input class="form-input-score" type="number" id="score" name="score" placeholder="e.g. 5.00" step="0.01" min="0" max="5" required>
              </div>
              <div>
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="10" cols="50" style="resize: none;"></textarea>
              </div>
            </div>
            <br>
            <button type="submit" class="search">Rate and Dismiss</button>  
          </form>
        </div> 
      </div>
    </div>
  </div>

  <script>
        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }
    </script>

</body>
</html>
