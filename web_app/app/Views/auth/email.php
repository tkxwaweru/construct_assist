<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('css/auth-style.css')?>">
    <title>Password Reset</title>
</head>
<body>
    <img src="<?= base_url('images/icon.png')?>" alt="logo">
    <div class="container">
        <div class="row" style="margin-top: 45px;">
           
                <div class="col-md-4 col-md-offset-4 centered-div">
                    <h4>Password Reset</h4><br>
                    <form action="<?php echo base_url('processEmail')?>" method="post">

                    <?php csrf_field(); ?>
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>

                        <div class="form-group">
                            <label for="email">Email your email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= set_value('email'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>  
                        </div>
                    </form>
                </div>
            
        </div>
    </div>
</body>
</html>