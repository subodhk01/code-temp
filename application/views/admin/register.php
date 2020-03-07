<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Login page
* Author : DEarTh
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="<?=base_url()?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?=base_url()?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?=base_url()?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?=base_url()?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?=base_url()?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?=base_url()?>vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?=base_url()?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?=base_url()?>assets/css/theme.css" rel="stylesheet" media="all">
    <link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet" media="all">
    <style type="text/css">
        body{
            background: url('<?= base_url('assets/images/bokeh-43.jpg') ?>' ) no-repeat fixed center;
            background-size: cover;
        }
    </style>

</head>

<body class="animsition">
    <div class="">
        <div class="page-content--bge7">
            <div class="container">
                <div class="register-wrap">
                    <div class="register-content">
                        <div class="login-logo">
                            <a href="#">
                                <!-- <img src="<?=base_url()?>assets/images/logo.png" alt="CoolAdmin" width="220"> -->
                                <h1>Reporter</h1>
                            </a>
                        </div>
                        <?php if ( isset($error) ) { ?>
                        	<div class="alert alert-danger" role="alert">
                            	<?= $error ?>
                        	</div>
                        <?php } ?>
                        <div class="register-form">
                            <div class="page-header">
                                <h3>Register</h3>
                            </div>
                            <?= form_open() ?>
                                <div class="form-group">
                                    <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                                    <input type="text" class="au-input au-input--full" id="username" name="username" placeholder="Enter a username" value="<?php echo set_value('username'); ?>">
                                    <p class="help-block">At least 4 characters, letters or numbers only</p>
                                </div>
                                <div class="form-group">
                                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                                    <input type="email" class="au-input au-input--full" id="email" name="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>">
                                    <p class="help-block">A valid email address</p>
                                </div>
                                <div class="form-group">
                                    <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                                    <input type="password" class="au-input au-input--full" id="password" name="password" placeholder="Enter a password">
                                    <p class="help-block">At least 6 characters</p>
                                </div>
                                <div class="form-group">
                                    <?php echo form_error('password_confirm', '<div class="error">', '</div>'); ?>
                                    <input type="password" class="au-input au-input--full" id="password_confirm" name="password_confirm" placeholder="Confirm your password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-custom" value="Register">
                                </div>
                            </form>
                        </div>
                        <div class="register-link">
                                <p>
                                    Already a user ?
                                    <a href="<?= base_url('admin/login') ?>">Sign In</a>
                                </p>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?=base_url()?>vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?=base_url()?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?=base_url()?>vendor/wow/wow.min.js"></script>
    <script src="<?=base_url()?>vendor/animsition/animsition.min.js"></script>

    <!-- Main JS-->
    <script src="<?=base_url()?>assets/js/main.js"></script>

</body>

</html>
<!-- end document-->