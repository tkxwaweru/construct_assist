<h3><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/auth-style.css') ?>">
  <title>Redirect</title>
</head>

<body>
    <a href="<?= site_url('home') ?>">
        <img src="<?= base_url('images/icon.png') ?>" alt="logo">
    </a>
  <div class="container">
    <div class="row" style="margin-top: 45px;">
      <div class="col-md-4 col-md-offset-4 centered-div">
        <h3>Registration successful. A link has been sent to your email for account activation.</h3><br>
        <button type="button" class="btn btn-primary btn-block" onclick="window.location.href='<?= site_url('login') ?>'">
          Proceed
        </button>
      </div>
    </div>
  </div>
</body>

</html></h3>
</body>
</html>