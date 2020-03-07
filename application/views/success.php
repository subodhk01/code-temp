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
            <div>
                <h2 style="font-family: 'quicksandbold'; font-size:16px; color:#313131; padding-bottom:8px;">Dear <?= isset($first_name) ? $first_name : '' ?></h2>
                <span style="color: #646464;">Your payment was successful, thank you for purchase.</span><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="success">Thank you! Your payment was successful.</h4>
                <?php if( isset($razorpay_payment_id) ) { ?>
                    <p>Payment ID : <span><?= $razorpay_payment_id ?></span></p>
                    <p>Item Name : <span><?= isset($product_info) ? $product_info : 'N/A' ?></span></p>
                    <p>Amount Paid : <span>$<?= isset($amount) ? $amount : 'N/A' ?></span></p>

                <?php } else { ?>
                    <p>Item Name : <span><?= isset($item_name) ? $item_name : 'N/A' ?></span></p>
                    <p>Item Number : <span><?= isset($item_number) ? $item_number : 'N/A' ?></span></p>
                    <p>TXN ID : <span><?= isset($txn_id) ? $txn_id : 'N/A' ?></span></p>
                    <p>Amount Paid : <span>$<?= (isset($payment_gross) ? $payment_gross : '') . 'N/A' . (isset($mc_currency) ? $mc_currency : '') ?></span></p>
                    <p>Payment Status : <span><?= (isset($payment_status) ? $payment_status : 'N/A') ?></span></p>
                <?php } ?>

                
                <a href="<?php echo base_url('industry-reports'); ?>">Back to Reports</a>
            </div>
        </div>

</section>


