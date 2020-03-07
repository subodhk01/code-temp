<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$blog = new stdClass();

$blog->title 				= '';
$blog->category			= '';
$blog->url					= '';
$blog->short_description	= '';
$blog->full_description 	= '';
$blog->related_report 		= '';
$blog->type  				= '';
$blog->date_published 		= '';
$blog->meta_title 			= '';
$blog->meta_description 	= '';
$blog->meta_keywords 		= '';
$blog->status 				= '';
$blog->pr_status 			= '';

if ( isset($blog_single) && !empty($blog_single) ) {
	$blog = $blog_single;
}
$blog_type_slug = isset($blog_type_slug) ? $blog_type_slug : 'blog';
$blog_type_name = isset($blog_type_name) ? $blog_type_name : 'Blog';
?>
<!--Report-->
<section class="report_full">
	<div class="container">
		<div class="bricamp">
			<nav>
		        <ol class="breadcrumb">
		        	<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
		            <li class="breadcrumb-item"><a href="<?= base_url($blog_type_slug) ?>"><?= $blog_type_name ?></a></li>
		            <li class="breadcrumb-item active"><a href="<?= base_url($blog_type_slug.'/'.$blog->url) ?>"><?= $blog->title ?></a></li>
		        </ol>
		    </nav>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="report_left">
					<div class="report-title"><h1><?= $blog->title ?></h1></div>
			        <div class="publishd">
			        	<span>Published: <?= Date('M Y',strtotime($blog->date_published)); ?></span>
			        </div>  
			        <div class="clearfix"></div>
			        <div class="blog-container">
			        	<?= $blog->full_description ?>
			        </div>
				</div>
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
</section>

<!--Report-->