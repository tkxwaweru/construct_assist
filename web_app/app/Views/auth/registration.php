<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('css/auth-style.css')?>">
    <title>Registration</title>
    <style>
        #password-guidelines {
            display: none;
            position: absolute;
            top: 70%;
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
                <h4>Register your account</h4><br>
                <form action="<?php echo base_url('processRegistration')?>" method="post">
                    <?php csrf_field(); ?>
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>

                    <?php if(!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" value="<?= set_value('name'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= set_value('email'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" value="<?= set_value('phone_number'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone_number') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Occupation</label>
                        <select class="form-control" id="role_id" name="role_id">
                            <option value=" ">"Select one"</option>
                            <option value="2">Project Manager</option>
                            <option value="3">Professional</option>
                            <option value="4">Service Provider</option>
                        </select>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'role_id') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
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
                        <button type="submit" class="btn btn-primary btn-block">Sign up</button>  
                    </div>
                    <br>
                    <a href="<?php echo site_url('login'); ?>">I already have an account</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
