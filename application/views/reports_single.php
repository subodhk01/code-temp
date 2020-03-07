<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

$report = new stdClass();

$report->title 				= '';
$report->heading 			= '';
$report->url 				= '';
$report->canonical_tag 		= '';
$report->short_description 	= '';
$report->full_description 	= '';
$report->table_of_content 	= '';
$report->list_of_table 		= '';
$report->list_of_charts 	= '';
$report->adjacent_reports 	= '';
$report->report_type 		= '';
$report->report_code 		= '';
$report->status 			= '';
$report->no_of_pages 		= '';
$report->delivery_format 	= '';
$report->licence_single_user = '';
$report->licence_multi_user = '';
$report->licence_corporate 	= '';
$report->date_published 	= '';
$report->meta_title 		= '';
$report->meta_description 	= '';
$report->meta_keywords 		= '';

if ( isset($report_single) && !empty($report_single) ) {
	$report = $report_single;
}
if ( empty($report->category) || !isset($report->category->title) ) {
	$report->category 			= new stdClass();
	$report->category->title = 'N/A';
	$report->category->url = '';
}
?>
<!--Report-->
<section class="report_full">
	<div class="container">
		<div class="bricamp">
			<nav>
		        <ol class="breadcrumb">
		            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
		            <li class="breadcrumb-item"><a href="<?= base_url('industry-reports') ?>">Industry reports</a></li>
		            <li class="breadcrumb-item"><a href="<?= base_url('reports-category/'.$report->category->url) ?>"><?= $report->category->title ?></a></li>
		            <li class="breadcrumb-item active"><a href="<?= base_url('industry-reports/'.$report->url) ?>"><h1><?= $report->heading ?></h1></a></li>
		        </ol>
		    </nav>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="report_left">
					<div class="report-title"><h2><?= $report->title ?></h2></div>
			        <div class="publishd">
			        	<span>Published: <?= Date('d M Y',strtotime($report->date_published)); ?> | Category : <?= $report->category->title ?> | Delivery Format: <i class="fa fa-file-pdf-o" title="PDF"></i> / <i class="fa fa-file-powerpoint-o" title="Powerpoint"></i></span>
			        </div>  
			        <div class="buttons_group">
			        	<ul>
			        		<li class="request"><a href="<?= base_url('request-sample/'.$report->url) ?>" target="_blank">Request Sample</a></li>
			        		<li class="speak"><a href="<?= base_url('speak-to-analyst/'.$report->url) ?>" target="_blank">Speak To Analyst</a></li>
			        		<li class="report"><a href="<?= base_url('report-customization/'.$report->url) ?>" target="_blank">Report Customization</a></li>
			        		<li class="inquiry"><a href="<?= base_url('inquiry-before-buying/'.$report->url) ?>" target="_blank">Inquiry Before Buying</a></li>
			        	</ul>
			        </div>
			        <div class="collaps_tabs">
	                    <!-- Nav tabs -->
						  <ul id="myTab" class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#report_description" aria-controls="report_description" role="tab" data-toggle="tab">Report Description</a></li>
						    <?php if ( $report->report_type == '1' ) { ?>
						    <li role=""><a href="<?= base_url('research-methodology') ?>" role="link" target="_blank">Research Methodology</a></li>
					    	<?php } else { ?>
					    		<li role=""><a href="<?= base_url('request-toc/'.$report->url) ?>" role="link" target="_blank">Request TOC</a></li>
					    	<?php } ?>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="report_description">
						    	<div class="tab_content">
						    		<?= $report->full_description ?>
						    	</div>
						    </div>
						    <?php if ( $report->report_type == '1' ) { ?>
							    <div role="tabpanel" class="tab-pane" id="table_of_content">
							    	<div class="tab_content">
							    		<?= $report->table_of_content ?>
							    	</div>
							    </div>
							    <div role="tabpanel" class="tab-pane" id="list_of_table">
							    	<div class="tab_content">
							    		<?= $report->list_of_table ?>
							    	</div>
							    </div>
							    <div role="tabpanel" class="tab-pane" id="list_of_charts">
							    	<div class="tab_content">
							    		<?= $report->list_of_charts ?>
							    	</div>
							    </div>
						    <?php } else { ?>
							    <div role="tabpanel" class="tab-pane" id="research_toc">
							    	<div class="tab_content">
							    		There will be a form
							    	</div>
							    </div>
						    <?php } ?>
						  </div>
			        </div>
			        <div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="report_right sidebar">
				<div class="share_on sidebar">
					<p>SHARE ON:</p>
					<ul>
						<li>
							<a href="<?= 'http://www.linkedin.com/shareArticle?mini=true&url='.urlencode( base_url('industry-reports/'.$report->url) ) ?>" target="_blank"><img src="<?= base_url('assets/images/linkdin.png') ?>" alt=""></a>
						</li>
						<li>
							<a href="<?= 'https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to&su=I+wanted+you+to+see+this&body=Check+out+this+report+'.urlencode( base_url('industry-reports/'.$report->url) ).'&ui=2&tf=1' ?>" target="_blank"><img src="<?= base_url('assets/images/email.png') ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?= base_url('assets/images/pdf.png') ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?= base_url('assets/images/print.png') ?>" alt=""></a>
						</li>
					</ul>
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

				<div class="sidebar ">
					<div class="sidebar-title green">Related Reports</div>
					<div class="sidebar-content">
						<ul>
							<?php
		                    	if ( isset($related_reports) && !empty($related_reports) ) {
		                    		foreach ($related_reports as $item) {
		                    			echo '<li><a href="'.base_url('industry-reports/'.$item->url).'">'.$item->heading.'</a></li>';
		                    		}
		                    	}
		                    ?>
						</ul>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--Report-->