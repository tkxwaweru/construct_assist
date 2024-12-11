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
                <p>Your team:</p>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Designation</th>
                            <th>Recruitment Date</th>
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
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <br><br><br>
                <form action="<?php echo base_url('rateSelect')?>" method="post">
                    <div class="content">
                        <h3>Service dismissal and performance review:</h3>
                        <br>
                        <div class="form-content">
                            <div class="input">
                                <label for="">Select the individual you would like to rate and dismiss:</label>
                                <select class="form-input" id="email" name="email">
                                    <?php if (!empty($providerEngagements)) : ?>
                                        <?php foreach ($providerEngagements as $providerEngagement) : ?>
                                            <option value="<?= $providerEngagement['email']; ?>">
                                                <?= $providerEngagement['name']; ?> (Email: <?= $providerEngagement['email']; ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($professionalEngagements)) : ?>
                                        <?php foreach ($professionalEngagements as $professionalEngagement) : ?>
                                            <option value="<?= $professionalEngagement['email']; ?>">
                                                <?= $professionalEngagement['name']; ?> (Email: <?= $professionalEngagement['email']; ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="input">
                                <button type="submit" class="form-button">Rate Service</button> 
                            </div>
                        </div>
                    </div>
                </form>
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
