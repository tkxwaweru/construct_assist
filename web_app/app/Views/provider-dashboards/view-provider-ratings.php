<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard.Professional</title>
    <link rel="stylesheet" href="<?= base_url('css/professional-dashboard.css') ?>">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header class="header">
        <div class="title">
            <span>Provider Dashboard</span>
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
                <a href="<?php echo site_url('providerHome'); ?>">Home</a>
                <a href="<?php echo site_url('providerProfile'); ?>">Manage Profile</a>
                <a class="active" href="<?php echo site_url('providerRatings'); ?>">Review breakdown</a>
                <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Reliability status</h2>
            <div class="promo_card">
                <?php if (is_null($reliability) || (is_null($reliable_reviews) && is_null($unreliable_reviews))) : ?>
                    <p>
                        Kindly proceed to the "Manage profile" section to update your account details and gain verification before you can view your review breakdown.
                    </p>
                <?php else : ?>
                    <h2>Profile: <?= session('name'); ?></h2>

                    <!-- Reliability Status -->
                    <p>Your reliability:
                        <b
                            style="color: <?= $reliability === 'Reliable' ? 'green' : 'red'; ?>;">
                            <?= $reliability ?? 'N/A'; ?>
                        </b>
                    </p>

                    <!-- Conditional Message -->
                    <p
                        style="color: <?= $reliability === 'Reliable' ? 'green' : 'red'; ?>;">
                        <?= $reliability === 'Reliable'
                            ? 'You are more likely to be recommended to project managers.'
                            : 'You are less likely to be recommended to project managers.'; ?>
                    </p>

                    <!-- Reviews Breakdown -->
                    <br>
                    <h2>Reviews Breakdown</h2>
                    <canvas id="reviewsPieChart" width="400" height="400"></canvas>

                    <style>
                        #reviewsPieChart {
                            max-width: 200px;
                            max-height: 200px;
                            margin: 0 auto;
                        }
                    </style>
                    <br>
                    <table class="user-table">
                        <tr>
                            <th>Reliable reviews</th>
                            <th>Unreliable reviews</th>
                        </tr>
                        <tr>
                            <td><?= $reliable_reviews ?? 0; ?></td>
                            <td><?= $unreliable_reviews ?? 0; ?></td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <script>
            function confirmLogout() {
                return confirm('Are you sure you want to logout?');
            }

            const reliableReviews = <?= $reliable_reviews ?? 0; ?>;
            const unreliableReviews = <?= $unreliable_reviews ?? 0; ?>;

            const ctx = document.getElementById('reviewsPieChart').getContext('2d');
            const reviewsPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Reliable Reviews', 'Unreliable Reviews'],
                    datasets: [{
                        label: 'Review Breakdown',
                        data: [reliableReviews, unreliableReviews],
                        backgroundColor: ['#4caf50', '#f44336'],
                        borderColor: ['#388e3c', '#d32f2f'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        </script>
</body>

</html>
