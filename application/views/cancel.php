<section class="page-container">
    <div class="container">
        <div class="bricamp">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><?= isset($payment_gateway) ? ucfirst($payment_gateway) : '' ?> Payment</li>
                </ol>
            </nav>
        </div>
        <div class="contact-form">
            <p class="lead">Canceld order</p>
            <div>
                <h3 style="font-family: 'quicksandbold'; font-size:16px; color:#313131; padding-bottom:8px;">Dear <?= isset($first_name) ? $first_name : '' ?></h3>
                <span style="color:#D70000; font-size:16px; font-weight:bold;"> Your last transaction was cancelled.</span></br>
                <span style="color:#D50000; font-size:14px; font-weight:bold;"><?php echo isset($error) ? $error : '' ?></span>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo base_url('industry-reports'); ?>">Back to Reports</a>
            </div>
        </div>
</section>