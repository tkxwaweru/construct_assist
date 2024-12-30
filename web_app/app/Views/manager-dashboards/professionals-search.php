<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard.Services</title>
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
                <a class="active" href="<?php echo site_url('enlistProfessionals'); ?>">Enlist Professionals</a>
                <a href="<?php echo site_url('enlistServices'); ?>">Enlist Services</a>
                <a href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
                <a href="<?php echo site_url('pastReviews'); ?>">Past Reviews</a>
                <a href="<?php echo site_url('professionalReviews'); ?>">Past Professional Reviews</a>
                <a href="<?php echo site_url('providerReviews'); ?>">Past Provider Reviews</a>
                <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout();">Logout</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Enlist Professionals</h2>
            <br>
            <!-- Display Results Table -->
            <div class="promo_card">
                <?php if (isset($professionalsData) && !empty($professionalsData)): ?>
                    <h3>Search Results for "<?= esc($profession_name); ?>" in "<?= esc($county); ?>"</h3>
                    <br>
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>County</th>
                                <th>Profession</th>
                                <th>Company</th>
                                <th>Reliability</th>
                                <th>Action</th> <!-- Add Action Column for Enlist Button -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($professionalsData as $professional): ?>
                                <tr>
                                    <td><?= esc($professional['name']) ?></td>
                                    <td><?= esc($professional['email']) ?></td>
                                    <td><?= esc($professional['phone_number']) ?></td>
                                    <td><?= esc($professional['county']) ?></td>
                                    <td><?= esc($professional['profession_name']) ?></td>
                                    <td><?= esc($professional['company']) ?></td>
                                    <td><?= $professional['reliable'] == 1 ? 'Reliable' : 'Not Reliable' ?></td>
                                    <td>
                                        <!-- Enlist button for each row -->
                                        <button type="button" class="enlist-button" onclick="enlistProfessional('<?= $professional['email'] ?>')">Enlist</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Unfortunately a professional could be found based on the following criteria (reliability, availability & county).</p>
                <?php endif; ?>
            </div>

            <!-- Hidden Form to Handle Enlisting -->
            <form id="enlistForm" action="<?php echo base_url('selectProfessionalEngagement') ?>" method="post" style="display:none;">
                <input type="hidden" name="professional" id="professionalEmail" value="">
            </form>
        </div>
    </div>

    <script>
        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }

        // Function to set the professional email and submit the form
        function enlistProfessional(email) {
            // Set the professional email to the hidden input field
            document.getElementById('professionalEmail').value = email;

            // Submit the form
            document.getElementById('enlistForm').submit();
        }
    </script>
</body>

</html>