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
          <br>
          <h3>Service search:</h3>
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
                  <div class="content">
                    <h3>Which county are you looking in?</h3>
                    <div class="input-field">
                        <!-- Use an input field with datalist for dynamic searching -->
                        <input class="input-field" type="text" name="county" id="county" list="county-list" placeholder="Type to search county..." autocomplete="off">
                        <datalist id="county-list">
                            <option value="Bomet">
                            <option value="Bungoma">
                            <option value="Busia">
                            <option value="Elgeyo Marakwet">
                            <option value="Embu">
                            <option value="Garissa">
                            <option value="Homa Bay">
                            <option value="Isiolo">
                            <option value="Kajiado">
                            <option value="Kakamega">
                            <option value="Kericho">
                            <option value="Kiambu">
                            <option value="Kilifi">
                            <option value="Kirinyaga">
                            <option value="Kisii">
                            <option value="Kisumu">
                            <option value="Kitui">
                            <option value="Kwale">
                            <option value="Laikipia">
                            <option value="Lamu">
                            <option value="Makueni">
                            <option value="Mandera">
                            <option value="Marsabit">
                            <option value="Meru">
                            <option value="Migori">
                            <option value="Mombasa">
                            <option value="Murang'a">
                            <option value="Nairobi">
                            <option value="Nakuru">
                            <option value="Nandi">
                            <option value="Narok">
                            <option value="Nyamira">
                            <option value="Nyandarua">
                            <option value="Nyanza">
                            <option value="Samburu">
                            <option value="Siaya">
                            <option value="Taita Taveta">
                            <option value="Tana River">
                            <option value="Tharaka Nithi">
                            <option value="Trans Nzoia">
                            <option value="Turkana">
                            <option value="Uasin Gishu">
                            <option value="Vihiga">
                            <option value="Wajir">
                            <option value="West Pokot">
                        </datalist>
                    </div>
                </div>

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
