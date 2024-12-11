<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard.Provider</title>
    <link rel="stylesheet" href="<?= base_url('css/provider-dashboard.css') ?>">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
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
                <a class="active" href="<?php echo site_url('providerProfile'); ?>">Manage Profile</a>
                <a href="<?php echo site_url('providerRatings'); ?>">View Ratings</a>
                <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Manage Profile</h2>
            <div class="promo_card">
                <h2>Profile: <?= session('name'); ?></h2>
                <p>Click on an option:</p>
                <ol>
                    <li>Reset Password: <a href="<?php echo site_url('providerPasswordRequest'); ?>">Click here</a></li>
                    <li>Delete Account: <a href="<?php echo site_url('providerAccountDelete'); ?>" onclick="return confirmDelete()">Click here</a></li>
                </ol>
                <br>
                <div class="form-container">
                    <div class="content">
                        <form action="<?php echo base_url('providerUpdate')?>" method="post" enctype="multipart/form-data">
                            <?php csrf_field(); ?>
                            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                            <?php endif ?>

                            <?php if(!empty(session()->getFlashdata('success'))) : ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                            <?php endif ?>
                            <br>
                            <h2>Update your service details and upload your certification document:</h2>
                            <div class="input-field">
                                <label for="certification_file">Certification:</label>
                                <input class="form-input" type="file" id="certification_file" name="certification_file">
                            </div>
                            <div class="input-field">
                                <label for="service_id">What kind of service do you provide?</label>
                                <div class="content">
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
                            </div>
                            <br>
                            <div class="input-field">
                                <label for="company">What company do you represent:</label>
                                <input class="form-input" type="text" id="company" name="company">
                            </div>
                            <br>
                            <button type="submit" class="search">Register</button>
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

        function confirmDelete() {
            return confirm('Are you sure you want to delete your account?');
        }
    </script>
</body>
</html>
