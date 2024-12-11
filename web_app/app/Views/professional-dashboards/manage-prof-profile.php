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
                <a class="active" href="<?php echo site_url('professionalProfile'); ?>">Manage Profile</a>
                <a href="<?php echo site_url('professionalRatings'); ?>">View Ratings</a>
                <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Manage Profile</h2>
            <div class="promo_card">
                <h2>Profile: <?= session('name'); ?></h2>
                <p>Click on an option:</p>
                <ol>
                    <li>Reset Password: <a href="<?php echo site_url('professionalPasswordRequest'); ?>">Click here</a></li>
                    <li>Delete Account: <a href="<?php echo site_url('professionalAccountDelete'); ?>" onclick="return confirmDelete()">Click here</a></li>
                </ol>
                <br>
                <div class="form-container">
                    <div class="content">
                        <form action="<?php echo base_url('professionalUpdate')?>" method="post" enctype="multipart/form-data">
                            <?php csrf_field(); ?>
                            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                            <?php endif ?>

                            <?php if(!empty(session()->getFlashdata('success'))) : ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                            <?php endif ?>
                            <br>
                            <h2>Update your profession and upload your certification document:</h2>
                            <div class="input-field">
                                <label for="certification_file">Certification:</label>
                                <input class="form-input" type="file" id="certification_file" name="certification_file">
                            </div>
                            <div class="input-field">
                                <label for="profession_id">What is your profession?:</label>
                                <div class="content">
                                    <div class="input-field">
                                        <select name="profession_id" id="profession_id">
                                            <option value=" ">"Select one"</option>
                                            <option value="1">Architect</option>
                                            <option value="2">Civil Engineer</option>
                                            <option value="3">Structural Engineer</option>
                                            <option value="4">Quantity Surveyor</option>
                                            <option value="5">Electrician</option>
                                            <option value="6">Plumber</option>
                                            <option value="7">HVAC Technician</option>
                                            <option value="8">Carpenter</option>
                                            <option value="9">Mason</option>
                                            <option value="10">Equipment Operator</option>
                                            <option value="11">Surveyor</option>
                                            <option value="12">Interior Designer</option>
                                            <option value="13">Geotechnical Engineer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <br>
                    <button type="submit" class="search">Register</button>
                </form>
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
