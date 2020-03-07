<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

$title = '';
$content = '';

if ( isset($page) && !empty($page) ) {
	$title = $page->title;
	$content = $page->content;
}

?>
<section class="page-container">
	<div class="container">
		<div class="bricamp">
			<nav>
		        <ol class="breadcrumb">
		            <li class="breadcrumb-item"><a href="#">Home</a></li>
		            <li class="breadcrumb-item active"><?= $title ?></li>
		        </ol>
		    </nav>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h1 class="page-title"><?= $title ?></h1>
				<!-- <div class="page-title"><h1><?= $title ?></h1></div> -->
				<div class="page-content"><?= $content ?></div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="sidebar-title">Need Assistance</div>
					<div class="sidebar-content">
						<ul>
							<li>Contact Person: Mr. Anurag Tiwari</li>
							<li>Call Us :
								<br />India +91 780-304-0404
								<br />Global +1 646-755-7667
							</li>
							<li>Mail Us : info@omrglobal.com</li>
						</ul>
					</div>
				</div>

				<div class="sidebar">
					<div class="sidebar-title green">Help</div>
					<div class="sidebar-content">
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
		</div>
	</div>
</section>