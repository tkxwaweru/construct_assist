<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard.Services - Providers Search</title>
    <link rel="stylesheet" href="<?= base_url('css/manager-dashboard.css') ?>">
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
                <a class="active" href="<?php echo site_url('enlistServices'); ?>">Enlist Services</a>
                <a href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
                <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Service Providers Search Results (Rated out of 5)</h2>
            <br>
            <div class="form-container">
                <div class="content">
                    <div class="search-results">
                        <h3>Results for Service: <?= $service_name; ?></h3>
                        <?php
                        $filteredData = [];
                        if (!empty($providersData)) :
                            $filteredData = array_filter($providersData, function ($provider) {
                                return $provider['average_rating'] > 4;
                            });

                            usort($filteredData, function ($a, $b) {
                                return $b['average_rating'] <=> $a['average_rating'];
                            });
                            ?>
                            <?php if (!empty($filteredData)) : ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Service</th>
                                            <th>Company</th>
                                            <th>Average Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 0;
                                        foreach ($filteredData as $provider) : ?>
                                            <?php if ($counter >= 5) break; ?>
                                            <tr>
                                                <td><?= $provider['name']; ?></td>
                                                <td><?= $provider['email']; ?></td>
                                                <td><?= $provider['phone_number']; ?></td>
                                                <td><?= $provider['service_name']; ?></td>
                                                <td><?= $provider['company']; ?></td>
                                                <td><?= $provider['average_rating']; ?></td>
                                            </tr>
                                            <?php $counter++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <p>No service providers found with an average rating greater than 4.</p>
                            <?php endif; ?>
                        <?php else : ?>
                            <p>No service providers found for the selected service.</p>
                        <?php endif; ?>
                        <br><br><br>
                        <form action="<?php echo base_url('selectProviderEngagement')?>" method="post">
                            <div class="content">
                                <h3>Select a service provider to add to your team: </h3>
                                <br>
                                <div class="form-content">
                                    <div class="input">
                                        <label for="provider">Select a service provider</label>
                                        <select class="form-input" id="provider" name="provider">
                                            <?php foreach ($filteredData as $provider) : ?>
                                                <option value="<?= $provider['email']; ?>">
                                                    <?= $provider['name']; ?> (Email: <?= $provider['email']; ?>, Average Rating: <?= $provider['average_rating']; ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="input">
                                        <button type="submit" class="form-button">Enlist</button> 
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
