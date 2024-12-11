<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard.Register</title>
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
        <a class="active" href="#">Register new Admin</a>
        <a href="<?php echo site_url('viewUsers'); ?>">View User Records</a>
        <a href="<?php echo site_url('viewProfessionalRatings'); ?>">View Professional Ratings</a>
        <a href="<?php echo site_url('viewProviderRatings'); ?>">View Provider Ratings</a>
        <a class="log-out-button" href="#" onclick="confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Administrator Registration</h2>
      <div class="promo_card">
          <h2>Profile: <?= session('name'); ?></h2>
          <p>Register a new Administrator:</p><br>
          <form action="<?php echo base_url('adminRegister')?>" method="post">
          <?php csrf_field(); ?>
          <?php if(!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
          <?php endif ?>

          <?php if(!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
          <?php endif ?>
            <br>
            <div class="content">
              <div class="input-field">
                <label for="name">Name:</label>
                <input class="form-input" type="text" id="name" name="name">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
              </div>
              <div class="input-field">
                <label for="email">Email:</label>
                <input class="form-input" type="text" id="email" name="email">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
              </div>
              <div class="input-field">
                <label for="email">Phone Number:</label>
                <input class="form-input" type="text" id="phone_number" name="phone_number">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone_number') : '' ?></span>
              </div>
              <div class="input-field">
                <label for="email">Password:</label>
                <input class="form-input" type="password" id="password" name="password">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
              </div>
              <div class="input-field">
                <label for="role_id">Role:</label>
                <input class="form-input" type="text" id="role_id" name="role_id" placeholder="Administrator" value="1" readonly>
              </div>
  
            </div>
            <br>
            <button type="submit" class="search">Register</button>  
          </form>
      </div>
    </div>
  </div>
</body>
</html>
