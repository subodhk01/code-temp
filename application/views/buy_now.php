<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if ( !isset($report_url) || !isset($license_type) ) {
    redirect(base_url());
}

?>
<section class="report_full">
    <div class="container">
        <?php if ( isset($message) ) { ?>
            <div class="alert alert-<?= isset($message->type) ? $message->type : '' ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?= isset($message->content) ? $message->content : '' ?>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col">
                <div class="report-title"><h2><?= $report_title ?></h2></div>
                <div class="card">
                    <div class="card-header site-color text-white"><i class="fa fa-envelope fa-lg"></i>&nbsp;&nbsp;&nbsp;Buy Now
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('buy-now/'.$report_url) ?>" method="POST" id="buy_now_form">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" >
                            </div>
                            <div class="form-group">
                                <label for="name">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact number" >
                            </div>
                            <div class="mx-auto">
                                <input type="hidden" name="license_type" value="<?= $license_type ?>" >
                                <input type="hidden" name="payment_method" value="paypal" >
                                <?php if (1==2) { // disabled temporary ?>
                                <button type="submit" id="pay_paypal" class="btn btn-warning text-right"><img src="<?= base_url('assets/images/PP_logo_h_200x51.png') ?>" /></button>
                            	<?php } ?>
                                <button type="submit" id="pay_razorpay" class="btn btn-primary text-right">Submit<!--<img src="<?= base_url('assets/images/visa-master.png') ?>" /> --></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="sidebar">
                    <div class="sidebar-title">Benefits Of Buying From Us</div>
                    <div class="sidebar-content">
                        <ul>
                            <li>Covers more than 15 major industries, which are further segmented into 90+ sectors</li>
                            <li>65% of our clients are loyal customers</li>
                            <li>120+ countries are covered in analysis</li>
                            <li>currently servicing 1000+ customers globally</li>
                            <li>100+ paid data sources mined to research</li>
                            <li>Our expert team will assist you with all research need and customization</li>
                            <li>Our expert research analyst will resolve your every query before and after purchasing the report</li>
                        </ul>
                    </div>
                    <div class="payment_logo">
                        <div class="sidebar-title green">100% Secured Payment</div>
                        <img src="<?= base_url('assets/images/payment-methods.png') ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <script src="https://www.google.com/recaptcha/api.js?render=6LebKrEUAAAAACRQvis1-KgpCpYkNztm_Xdr3i0j"></script>
  <script>
  grecaptcha.ready(function() {
      grecaptcha.execute('6LebKrEUAAAAACRQvis1-KgpCpYkNztm_Xdr3i0j', {action: 'homepage'}).then(function(token) {
      });
  });
  </script> -->