<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard.Services</title>
  <link rel="stylesheet" href="<?= base_url('css/manager-dashboard.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <style>
    .response-message {
      font-size: 16px;
      font-weight: bold;
      margin: 10px;
      font-size: 20px;
    }
    .positive {
      color: green;
    }
    .negative {
      color: red;
    }
    .action-buttons {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }
    .action-buttons button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }
    .proceed-button {
      background-color: green;
      color: white;
    }
    .appeal-button {
      background-color: red;
      color: white;
    }
  </style>
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
        <a href="<?= site_url('managerHome'); ?>">Home</a>
        <a href="<?= site_url('managerProfile'); ?>">Manage Profile</a>
        <a href="<?= site_url('enlistProfessionals'); ?>">Enlist Professionals</a>
        <a href="<?= site_url('enlistServices'); ?>">Enlist Services</a>
        <a class="active" href="<?= site_url('managerEngagements'); ?>">View Team</a>
        <a class="log-out-button" href="<?= site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Rate Services</h2>
      <div class="promo_card">
        <h2>Profile: <?= session('name'); ?></h2>
        <p>Service review and dismissal:</p>

        <!-- Response Message with Buttons -->
        <?php if (session()->getFlashdata('apiResponseMessage')): ?>
          <div class="response-message <?= session()->getFlashdata('apiResponseSentiment') === 'positive' ? 'positive' : 'negative'; ?>">
            <?= session()->getFlashdata('apiResponseMessage'); ?>
          </div>
          <br>
          <div class="action-buttons">
            <form action="<?= base_url('rateProceed') ?>" method="post">
              <button type="submit" class="proceed-button">Proceed</button>
            </form>
            <form action="<?= base_url('rateAppeal') ?>" method="post">
              <button type="submit" class="appeal-button">Appeal</button>
            </form>
          </div>
          <br><br>
        <?php endif; ?>
            
        <div class="form-container">
          <form action="<?= base_url('rateService') ?>" method="post">
            <div class="content">
              <h3>Please provide a review for our AI to analyze:</h3>
              <div class="input-field">
                <label for="name">Name:</label>
                <input class="form-input" type="text" id="name" name="name" value="<?= esc(session()->getFlashdata('name') ?? $name) ?>" readonly>
              </div>
              <div class="input-field">
                <label for="email">Email:</label>
                <input class="form-input" type="text" id="email" name="email" value="<?= esc(session()->getFlashdata('email') ?? $email) ?>" readonly>
              </div>
              <div>
                <label for="comment">Review:</label>
                <textarea id="comment" name="comment" rows="10" cols="50" style="resize: none;" placeholder="Feel free to use English, Swahili or a mix of both languages."><?= esc(old('comment')) ?></textarea>
              </div>
            </div>
            <button type="submit" class="search">Dismiss</button>
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
