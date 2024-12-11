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
        <a class="active" href="#">Enlist Services</a>
        <a href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
        <a class="log-out-button" href="#" onclick="confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Enlist Services</h2>
      <div class="promo_card">
          <h2>Profile: <?= session('name'); ?></h2>
          <p> Enlist Services:</p>
            <div class="form-container">
                <form action="<?php echo base_url('searchServices')?>" method="post">
                  <div class="content">
                    <h3>What kind of services are you looking for?</h3>
                    <div class="input-field">
                      <select name="service_id" id="service_id">
                        <option value=" ">"Select one"</option>
                        <option value="1">Material Supply</option>
                        <option value="2">Transportation</option>
                        <option value="3">Equipment Rental</option>
                        <option value="4">Waste Management</option>
                        <option value="5">Quality Control and Testing </option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <button type="submit" class="search">Search</button>  
                </form>
            </div> 
      </div>
    </div>
  </div>

  <script>
    function confirmLogout() {
      if (confirm('Are you sure you want to logout?')) {
        window.location.href = "<?php echo site_url('logout'); ?>";
      }
    }
  </script>
</body>
</html>
