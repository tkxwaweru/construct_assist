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
        <a class="active" href="#">Enlist Professionals</a>
        <a href="<?php echo site_url('enlistServices'); ?>">Enlist Services</a>
        <a href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
        <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout();">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Enlist Professionals</h2>
      <div class="promo_card">
          <h2>Profile: <?= session('name'); ?></h2>
          <p>Enlist Professionals:</p>
          <div class="form-container">
            <form action="<?php echo base_url('searchProfessionals')?>" method="post">
              <div class="content">
                <h3>What kind of construction professional are you looking for?</h3>
                <div class="input-field">
                  <select name="profession_id" id="profession_id">
                    <option value=" ">Select one</option>
                    <option value="1">Architect</option>
                    <option value="2">Civil Engineer</option>
                    <option value="3">Structural Engineer</option>
                    <option value="4">Quantity Surveyor</option>
                    <option value="5">Electrician</option>
                    <option value="6">Plumber</option>
                    <option value="7">HVAC Technician</option>
                    <option value="8">Carpenter</option>
                    <option value="9">Mason</option>
                    <option value="10">Equipment Operator</option>
                    <option value="11">Surveyor</option>
                    <option value="12">Interior Designer</option>
                    <option value="13">Geotechnical Engineer</option>
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
      return confirm('Are you sure you want to logout?');
    }
  </script>
</body>
</html>
