<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$request_page = new stdClass();
$request_page->title = '';
$request_page->type = '';
$request_page->report_url = '';
$request_page->report_title = 'N/A';
if ( isset($request) ) {
    $request_page = $request;
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
            <div class="col-md-8">
                <div class="report-title"><h2><?= $request_page->report_title ?></h2></div>
                <div class="card">
                    <div class="card-header site-color text-white"><i class="fa fa-envelope fa-lg"></i>&nbsp;&nbsp;&nbsp;<?= $request_page->title ?>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url($request_page->type.'/'.$request_page->report_url) ?>" method="POST" id="request_form">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?= set_value('name') ?>" required>
                                <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" value="<?= set_value('company_name') ?>" required>
                                <?php echo form_error('company_name', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Company Email</label>
                                <input type="email" class="form-control" id="company_email" name="company_email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= set_value('company_email') ?>" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                <?php echo form_error('company_email', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="name">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation" value="<?= set_value('designation') ?>" required>
                                <?php echo form_error('designation', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="name">Contact No.</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter contact number" value="<?= set_value('contact_no') ?>" required>
                                <?php echo form_error('contact_no', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" placeholder="Your message here" rows="6" ><?= set_value('message') ?></textarea>
                                <?php echo form_error('message', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="mx-auto">
                            <button type="submit" class="btn btn-primary text-right">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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