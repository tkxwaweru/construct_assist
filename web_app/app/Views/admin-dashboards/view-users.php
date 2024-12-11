<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard.Users</title>
  <link rel="stylesheet" href="<?= base_url('css/admin-dashboard.css') ?>">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <script>
    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
        window.location.href = "<?php echo site_url('logout'); ?>";
      }
    }
    
    function searchTable() {
      var input = document.getElementById("searchInput");
      var filter = input.value.toUpperCase();
      var table = document.getElementsByClassName("user-table")[0];
      var rows = table.getElementsByTagName("tr");

      for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var found = false;

        for (var j = 0; j < cells.length; j++) {
          var cell = cells[j];
          if (cell) {
            var cellText = cell.textContent || cell.innerText;
            if (cellText.toUpperCase().indexOf(filter) > -1) {
              found = true;
              break;
            }
          }
        }

        if (found || i === 0) {
          rows[i].style.display = "";
        } else {
          rows[i].style.display = "none";
        }
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
        <a class="active" href="#">View User Records</a>
        <a href="<?php echo site_url('viewProfessionalRatings'); ?>">View Professional Ratings</a>
        <a href="<?php echo site_url('viewProviderRatings'); ?>">View Provider Ratings</a>
        <a class="log-out-button" href="#" onclick="confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>User Records</h2>
      <div class="promo_card-table">
          <h2>Profile: <?= session('name'); ?></h2>
          <p>User Records:</p>
          <br>
          <div class="input-field">
            <label for="searchInput">Search by user's name:</label>
            <input class="form-input" type="text" id="searchInput" placeholder="Enter user's name">
            <button onclick="searchTable()" class="search-button">Search</button>
          </div>
          <br>
          <table class="user-table">
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Password</th>
              <th>Role</th>
              <th>Registered on</th>
              <th>Updated at</th>
              <th>Account status</th>
            </tr>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $user['user_id']; ?></td>
                <td><?= $user['name']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['phone_number']; ?></td>
                <td><?= $user['password']; ?></td>
                <td><?= $user['role_id']; ?></td>
                <td><?= $user['registered_on']; ?></td>
                <td><?= $user['updated_at']; ?></td>
                <td><?= $user['account_status']; ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
          <br><br>
          <form action="<?php echo base_url('userAccountModification')?>" method="post">
            <br>
            <div class="content">
            <h2>User account status modification:</h2><br>
              <div class="input-field">
                <label for="name">Name:</label>
                <input class="form-input" type="text" id="name" name="name">
              </div>
              <div class="input-field">
                <label for="email">Email:</label>
                <input class="form-input" type="text" id="email" name="email">
              </div>
              <div>
              <label for="account_status">Account Status:</label>
                <select class="form-select" name="account_status" id="account_status">
                  <option value=" ">"Select one"</option>
                  <option value="1">Active</option>
                  <option value="0">Disabled</option>
                </select>
              </div>
            </div>
            <br>
            <button type="submit" class="search">Update account</button>  
          </form>
      </div>
    </div>
  </div>
</body>
</html>
