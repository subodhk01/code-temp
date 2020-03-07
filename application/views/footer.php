<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--footer-->
<footer>
	<div class="top_footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="footer_col">
						<div class="footer-col-title">About Us:</div>
						<ul>
							<li><a href="<?= base_url('about-omr') ?>">About Us</a></li>
							<li><a href="<?= base_url('research-methodology') ?>">Research Methodology</a></li>
							<li><a href="<?= base_url('services') ?>">Services</a></li>
							<li><a href="<?= base_url('why-us') ?>">Why Us</a></li>
							<li><a href="<?= base_url('career') ?>">Careers</a></li>
							<li><a href="<?= base_url('contact-us') ?>">Contact Us</a></li>
							<!--li><a href="#">Sitemap</a></li-->
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_col">
						<div class="footer-col-title">Media</div>
						<ul>
							<li><a href="<?= base_url('press-release') ?>">Press Release</a></li>
							<li><a href="<?= base_url('articles') ?>">Articles</a></li>
							<li><a href="<?= base_url('news') ?>">News</a></li>
							<li><a href="<?= base_url('blogs') ?>">Blogs</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_col">
						<div class="footer-col-title">Help</div>
						<ul>
							<li><a href="<?= base_url('how-to-order') ?>">How To Order</a></li>
							<li><a href="<?= base_url('delivery-method') ?>">Delivery Method</a></li>
							<li><a href="<?= base_url('faqs') ?>">FAQs</a></li>
							<li><a href="<?= base_url('return-policy') ?>">Return Policy</a></li>
							<li><a href="<?= base_url('terms-conditions') ?>">Terms of uses</a></li>
							<li><a href="<?= base_url('privacy-policy') ?>">Privacy Policy</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_col">
						<div class="footer-col-title">Contact:</div>
						<ul>
							<li class="email"><a href="mailto:info@omrglobal.com">info@omrglobal.com</a></li>
							<li class="phone"><a href="telto:780-304-0404">India +91 780-304-0404</a>
								<a href="telto:646-755-7667">Global +1 646-755-7667</a></li>
						</ul>
						<div class="follow_with">
							<div class="footer-col-title">Follow on Us</div>
							<ul>
								<li><a href="https://www.linkedin.com/company/7928317/?trk=nav_account_sub_nav_company_admin/posts"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="https://twitter.com/omrglobal"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="https://www.facebook.com/omrglobal"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bootm_footer">
		<p>Copyright ©  2015-2019 Orion Market Research Private Limited All rights reserved</p>
	</div>
</footer>
<!--footer-->


<script src="<?= base_url('assets/pages/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/pages/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/pages/js/slick.min.js') ?>"></script>
<script src="<?= base_url('assets/pages/js/custom.js') ?>"></script>
<script src="<?= base_url('assets/pages/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/pages/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/jquery-validation/js/additional-methods.mi') ?>n.js" type="text/javascript"></script>
<script src="<?= base_url('assets/pages/js/form-validation-front.js') ?>" type="text/javascript"></script>


<script type="text/javascript">
	$(document).ready(function(){
		$('li.nav-item').find('a').each(function(){
            if($(this).attr('href') == window.location.href){
                $(this).parent().addClass('active');
                $(this).addClass('active');
                // if($(this).parent().parent().hasClass('sub-menu')){
                //     $(this).parent().parent().parent().addClass("active open");
                // }
            }
        });

        $('#pay_razorpay').on('click',function(){
	        $('#buy_now_form').submit(function(){
	            $('input[name="payment_method"]').val('razorpay');
	        });
	    });
	});


</script>
<!-- Google Analytics start -->
			<script>
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-75931377-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<!-- Google Analytics end -->
		
	
		
	<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?3llR9PgxCTD6M7K8Rt5nuwwXG1Xpk1ba";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>	
</body>
</html>