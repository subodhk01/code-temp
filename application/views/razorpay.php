<?php
/*
<form action="https://www.example.com/payment/success/" method="POST">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="rzp_live_H5t2DH31xdpzx2" // Enter the Key ID generated from the Dashboard
    data-amount="<?= $amount ?>"
    data-currency="USD"
    data-order_id="<?= $order_id ?>"//Create an Order using Orders API
    data-buttontext="Pay with Razorpay"
    data-name="Acme Corp"
    data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
    data-image="<?= base_url('assets/images/logo.png') ?>"
    data-prefill.name="Orion Market Research Pvt. Ltd."
    data-prefill.email="mukati@omrglobal.com"
    data-prefill.contact="+91 780-304-0404"
    data-theme.color="#F37254"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>
*/

?>
<?php $this->load->view('header'); ?>

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
                <form name="razorpay-form" id="razorpay-form" action="<?= $return_url ?>" method="POST">
                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                    <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?= $itemInfo['order_id'] ?>"/>
                    <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?= $txnid ?>"/>
                    <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?= $productinfo ?>"/>
                    <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?= $surl ?>"/>
                    <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?= $furl ?>"/>
                    <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?= $card_holder_name ?>"/>
                    <input type="hidden" name="merchant_total" id="merchant_total" value="<?= ($itemInfo['price']*100) ?>"/>
                    <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?= $itemInfo['price'] ?>"/>
                </form>
                <div class="row">   
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                        
                        <table class="table table-bordered table-hover table-striped print-table order-table">
                            <thead class="site-color">
                                <tr>
                                    <th width="70%" class="text-left" style="vertical-align: inherit">Name</th>
                                    <th width="30%" class="text-left" style="vertical-align: inherit">Price</th>
                                </tr>
                            </thead>                        
                            <tbody>                    
                                <tr>
                                    <td class="text-left"><?= $itemInfo['name'] ?></td>
                                    <td class="text-right">$<?= $itemInfo['price'] ?></td>                        
                                </tr>                        
                            </tbody>                        
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 text-right">
                        <a href="<?php print base_url();?>" name="reset_add_emp" id="re-submit-emp" class="btn btn-warning"><i class="fa fa-mail-reply"></i> Back</a>
                        <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary" />
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


<?php
$this->load->view('footer');
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function(){
        $('#submit-pay').click();
    });
  var razorpay_options = {
    key: "<?= RAZOR_KEY_ID; ?>",
    amount: "<?= ($itemInfo['price']*100); ?>",
    name: "<?= $name; ?>",
    description: "Order # <?= $itemInfo['order_id']; ?>",
    netbanking: true,
    currency: "<?= $currency_code; ?>",
    prefill: {
      name:"<?= $card_holder_name; ?>",
      email: "<?= $email; ?>",
      contact: "<?= $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?= $itemInfo['order_id']; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>