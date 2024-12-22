<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard.Team</title>
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
                <a href="<?php echo site_url('enlistServices'); ?>">Enlist Services</a>
                <a class="active" href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
                <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>View Team</h2>
            <div class="promo_card">
                <h2>Profile: <?= session('name'); ?></h2>
                <br>
                <h3>Your team:</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Designation</th>
                            <th>Recruitment Date</th>
                            <th>Action</th> <!-- Added Action column for rating -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($providerEngagements)) : ?>
                            <?php foreach ($providerEngagements as $providerEngagement) : ?>
                                <tr>
                                    <td><?= $providerEngagement['name']; ?></td>
                                    <td><?= $providerEngagement['email']; ?></td>
                                    <td><?= $providerEngagement['phone_number']; ?></td>
                                    <td><?= ($providerEngagement['role_id'] == 3) ? 'Professional' : 'Service provider'; ?></td>
                                    <td><?= $providerEngagement['recruitment_date']; ?></td>
                                    <td>
                                        <!-- Rating button for provider -->
                                        <button type="button" class="enlist-button" onclick="rateService('<?= $providerEngagement['email']; ?>')">Dismiss</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($professionalEngagements)) : ?>
                            <?php foreach ($professionalEngagements as $professionalEngagement) : ?>
                                <tr>
                                    <td><?= $professionalEngagement['name']; ?></td>
                                    <td><?= $professionalEngagement['email']; ?></td>
                                    <td><?= $professionalEngagement['phone_number']; ?></td>
                                    <td><?= ($professionalEngagement['role_id'] == 3) ? 'Professional' : 'Service provider'; ?></td>
                                    <td><?= $professionalEngagement['recruitment_date']; ?></td>
                                    <td>
                                        <!-- Rating button for professional -->
                                        <button type="button" class="enlist-button" onclick="rateService('<?= $professionalEngagement['email']; ?>')">Dismiss</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <br><br><br>
                <!-- Removed the form that was previously used for rating -->
            </div>
        </div>
    </div>

    <!-- Hidden Form to Handle Rating -->
    <form id="rateForm" action="<?php echo base_url('rateSelect') ?>" method="post" style="display:none;">
        <input type="hidden" name="email" id="emailToRate" value="">
    </form>

    <script>
        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }

        // Function to set the email and submit the rate form
        function rateService(email) {
            // Set the email to the hidden input field
            document.getElementById('emailToRate').value = email;

            // Submit the form
            document.getElementById('rateForm').submit();
        }
    </script>
</body>

</html>