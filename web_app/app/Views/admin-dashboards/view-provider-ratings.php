<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard.Provider.Ratings</title>
  <link rel="stylesheet" href="<?= base_url('css/admin-dashboard.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <style>
    /* Hide the professional_rating_id column */
    .hidden-column {
      display: none;
    }
  </style>
  
  <script>
    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
        window.location.href = "<?php echo site_url('logout'); ?>";
      }
    }

    // Function to handle "Correct" button click
    function correctAppeal(providerRatingId, providerUserId) {
      document.getElementById('correctRatingId').value = providerRatingId;
      document.getElementById('correctUserId').value = providerUserId;
      document.getElementById('correctForm').submit();
    }

    // Function to handle "Dismiss" button click
    function dismissAppeal(providerRatingId) {
      document.getElementById('dismissRatingId').value = providerRatingId;
      document.getElementById('dismissForm').submit();
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
        <a href="<?php echo site_url('viewUsers'); ?>">View User Records</a>
        <a href="<?php echo site_url('viewProfessionalRatings'); ?>">Professional Review Appeals</a>
        <a class="active" href="#">Provider Review Appeals</a>
        <a class="log-out-button" href="#" onclick="confirmLogout()">Logout</a>
      </div>
    </nav>

    <div class="main-body">
      <h2>Appealed Provider Reviews</h2>
      <div class="promo_card">
        <h2>Profile: <?= session('name'); ?></h2>
        <p>Provider reviews with active appeals:</p><br>
        <table border="1">
          <thead>
            <tr>
              <th>Index</th>
              <th class="hidden-column">provider_rating_id</th>
              <th>Provider ID</th>
              <th>Review text</th>
              <th>Review sentiment</th>
              <th>Reviewed on</th>
              <th>Correct</th>
              <th>Dismiss</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($provider_ratings)) : ?>
              <?php foreach ($provider_ratings as $index => $provider_rating) : ?>
                <tr>
                  <td><?= $index + 1; ?></td>
                  <td class="hidden-column"><?= esc($provider_rating['provider_rating_id']); ?></td>
                  <td><?= esc($provider_rating['providers_user_id']); ?></td>
                  <td><?= esc($provider_rating['review_text']); ?></td>
                  <td><?= $provider_rating['review_sentiment'] ? 'Positive' : 'Negative'; ?></td>
                  <td><?= esc($provider_rating['reviewed_on']); ?></td>
                  <td>
                    <button type="button" class="correct-button" 
                      onclick="correctAppeal('<?= esc($provider_rating['provider_rating_id']); ?>', '<?= esc($provider_rating['providers_user_id']); ?>')">Correct</button>
                  </td>
                  <td>
                    <button type="button" class="dismiss-button" 
                      onclick="dismissAppeal('<?= esc($provider_rating['provider_rating_id']); ?>')">Dismiss</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5">No active appeals found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

   <!-- Hidden Forms -->
   <form id="correctForm" action="<?= base_url('handleProviderAppeal') ?>" method="post" style="display:none;">
    <input type="hidden" name="provider_rating_id" id="correctRatingId" value="">
    <input type="hidden" name="providers_user_id" id="correctUserId" value="">
  </form>

  <form id="dismissForm" action="<?= base_url('dismissProviderAppeal') ?>" method="post" style="display:none;">
    <input type="hidden" name="provider_rating_id" id="dismissRatingId" value="">
  </form>
</body>
</html>
