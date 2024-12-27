<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Construct-Assist</title>
        <link rel="stylesheet" href="<?= base_url('css/homepage.css') ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />   
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <img src="<?= base_url('images/icon.png')?>" alt="logo" class="logo">
                <ul>
                    <li><a href="<?php echo site_url('home'); ?>">Home</a></li>
                    <li><a href="<?php echo site_url('about'); ?>">About</a></li>
                    <li><a href="<?php echo site_url('login'); ?>">Login</a></li>
                </ul>
            </div>

            <div class="content">
                <h1>COLLABORATE AND CREATE</h1>
                <p>Leverage our AI-driven review analysis which ensures quality recommendations for construction <br>  
                    service providers and professionals. With Construct-Assist reliability is always assured.</p>
                <div class="button">
                    <a href="<?php echo site_url('registration'); ?>">GET STARTED</a>
                </div>
            </div>
        </div>
    </body>
</html>

  
