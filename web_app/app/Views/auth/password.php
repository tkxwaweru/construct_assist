<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('css/auth-style.css')?>">
    <title>Password Reset</title>
    <style>
        #password-guidelines {
            display: none;
            position: absolute;
            top: 55%;
            left: calc(100% + 10px);
            transform: translateY(-50%);
            padding: 5px;
            width: 250px; 
            background-color: #ffcc5c;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
    <script>
        function showPasswordGuidelines() {
            const passwordField = document.getElementById('password');
            const passwordValue = passwordField.value;
            const passwordGuidelines = document.getElementById('password-guidelines');

            if (passwordValue.length > 0) {
                let guidelines = "";

                guidelines += "<div>Password must have at least 6 characters.</div>";
                guidelines += "<div>Password must include an uppercase character.</div>";
                guidelines += "<div>Password must include a number.</div>";

                passwordGuidelines.innerHTML = guidelines;
                passwordGuidelines.style.display = 'block';
            } else {
                passwordGuidelines.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <img src="<?= base_url('images/icon.png')?>" alt="logo">
    <div class="container">
        <div class="row" style="margin-top: 45px;">
     
            <div class="col-md-4 col-md-offset-4 centered-div">
                <h3>Password reset for: <?php echo $email; ?></h3><br>
                <h4>Reset your password</h4><br>

                <form action="<?php echo base_url('processPassword')?>" method="post">

                <?php csrf_field(); ?>
                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php endif ?>

                    <div class="form-group">
                        <label for="password">Enter New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" value="<?= set_value('password'); ?>" onkeyup="showPasswordGuidelines()">
                        <div id="password-guidelines"></div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    </div>

                    <div class="form-group">
                        <label for="confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmation" name="confirmation" placeholder="Confirm your password" value="<?= set_value('confirmation'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'confirmation') : '' ?></span>
                    </div>
               
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>  
                    </div>

                </form>
            </div>
            
        </div>
        </div>
    </div>
</body>
</html>