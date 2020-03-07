<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
                <div class="card">
                    <div class="card-header site-color text-white"><i class="fa fa-envelope fa-lg"></i>&nbsp;&nbsp;&nbsp;Contact us.
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('contact-us') ?>" method="POST">
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
                                <label for="name">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" >
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                            </div>
                            <div class="mx-auto">
                            <button type="submit" class="btn btn-primary text-right">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
<!--                 <div class="card bg-light mb-2">
                    <div class="card-header green text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                    <div class="card-body">
                        <p>3 rue des Champs Elysées</p>
                        <p>75008 PARIS</p>
                        <p>France</p>
                        <p>Email : email@example.com</p>
                        <p>Tel. +33 12 56 11 51 84</p>

                    </div>

                </div> -->

                <div class="sidebar">
                    <div class="sidebar-title green"><i class="fa fa-building-o"></i>&nbsp;&nbsp;&nbsp;CORPORATE OFFICE</div>
                    <div class="sidebar-content contact-us">
                        <p><strong>Orion Market Research Pvt Ltd</strong></p>
                        <p><span class="LrzXr">305-308, Commerce House, </span></p>
                        <p><span class="LrzXr">Janjeerwala Square,</span></p>
                        <p><span class="LrzXr">Indore, Madhya Pradesh 452001</span></p>
                        <p><strong>Email</strong>: &nbsp; <a href="mailto:info@omrglobal.com">info@omrglobal.com</a></p>
                        <p><strong>India:</strong>&nbsp;&nbsp; +91 780-304-0404</p>
                        <p><strong>Global:</strong> +1&nbsp; 646-755-7667</p>
                    </div>
                </div>
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