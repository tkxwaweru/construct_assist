<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard.Professional</title>
    <link rel="stylesheet" href="<?= base_url('css/professional-dashboard.css') ?>">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
    <header class="header">
        <div class="title">
            <span>Professional Dashboard</span>
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
                <a href="<?php echo site_url('professionalHome'); ?>">Home</a>
                <a href="<?php echo site_url('professionalProfile'); ?>">Manage Profile</a>
                <a class="active" href="<?php echo site_url('professionalRatings'); ?>">View Ratings</a>
                <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Your Ratings</h2>
            <div class="promo_card">
                <h2>Profile: <?= session('name'); ?></h2>

                <p>Your average rating (out of 5): <b><?= $averageRating ?? 'N/A'; ?></b></p>
                <p>Your ratings history:</p>
                <br>
                <table class="user-table">
                    <tr>
                        <th>Rating No.</th>
                        <th>Score</th>
                        <th>Comment</th>
                        <th>Date rated</th>
                    </tr>
                    <?php $ratingNo = 1; ?>
                    <?php foreach ($ratings as $rating) : ?>
                        <tr>
                            <td><?= $ratingNo++; ?></td>
                            <td><?= $rating['score']; ?></td>
                            <td><?= $rating['comment']; ?></td>
                            <td><?= $rating['rated_on']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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
