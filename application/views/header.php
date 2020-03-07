<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$meta_title = isset($meta_title) ? $meta_title : '';
$page_title = isset($page_title) ? $page_title : 'OMR Global';
$meta_description = isset($meta_description) ? $meta_description : 'Orion Market Research is a well established Market Research firm with proven records in Consulting solutions turning incubating ideas into reality.';
$meta_keywords = isset($meta_keywords) ? $meta_keywords : '';
$meta_url = isset($meta_url) ? $meta_url : '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $page_title ?></title>
	<meta name="description" content="<?= $meta_description ?>" />
	<meta name="keywords" content="<?= $meta_keywords ?>" />
	<meta property="og:title" content="<?= $meta_title ?>" />
	<meta property="og:description" content="<?= $meta_description ?>" />
	<meta property="og:url" content="<?= $meta_url ?>" />
	<meta property="og:site_name" content="Orion Market Research" />
	<meta property="og:locale" content="en_US" />
	<link rel="icon" href="https://www.omrglobal.com/assets/images/favicon.ico" type="image/gif" sizes="16x16">
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:description" content="<?= $meta_description ?>" />
	<meta name="twitter:title" content="<?= $meta_title ?>" />
	<meta name="copyright" content="Orion Market Research Pvt. Ltd. 2019"/>
    <meta name="author" content="Orion Market Research, https://www.omrglobal.com/"/>
    <meta name="classification" content="Custom Market Research"/>
    <meta name="distribution" content="Global"/>
    <meta name="coverage" content="worldwide">
    <meta name="Page-Topic" content="Market Research"/>
    <meta name="Audience" content="All, Business, Research"/>
    <meta name="language" content="english">
	<meta name="contact" content="info@omrglobal.com, +1 646-755-7667" />
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<?php
		if ( isset($canonical_tag) && $canonical_tag ) {
			echo '<link rel="canonical" href="'.$canonical_tag.'" />';
		}
		if ( isset($noindex) && $noindex ) {
			echo '<META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW">';
		}
	?>

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/pages/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/pages/css/style.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/pages/css/owl.carousel.min.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/pages/css/slick.css') ?>">
</head>
<body>
	<!--Top Header-->
	<div class="image-container">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="left_phone">
						<p>CALL US AT : +91 780-304-0404</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right_social">
						<ul>
							<li><a href="https://www.linkedin.com/company/7928317/?trk=nav_account_sub_nav_company_admin/posts"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="https://twitter.com/omrglobal"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="https://www.facebook.com/omrglobal"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						</ul>
						<div class="search_box">
                     		<form method="get" class="form-horizontal" role="form" action="<?= base_url() ?>reports-category">
								<input type="text" name="search" placeholder="Search" value="<?= filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);?>">
	                     		<button><i class="fa fa-search" aria-hidden="true"></i></button>
	                     	</form>
                     	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Top Header-->
<!--Navigation-->
<nav class="navbar navbar-expand-lg">
	<div class="container">
  <a class="navbar-brand" href="<?= base_url() ?>">
  	<img src="<?= base_url('assets/images/Industry-Insight.png') ?>" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="toggle_icon"></span>
    <span class="toggle_icon"></span>
    <span class="toggle_icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link " href="<?= base_url() ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('about-omr') ?>">About Us</a>
      </li>
      <li class="nav-item show">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Industry Insight</a>
		<div class="services dropdown-menu" aria-labelledby="navbarDropdown">
			<h6><a class="dropdown-item" href="#">Healthcare</a></h6>
			<h6><a class="dropdown-item" href="#">Information and Communication Technology</a></h6>
			<h6><a class="dropdown-item" href="#">Energy and Power</a></h6>
			<h6><a class="dropdown-item" href="#">Advanced Technology</a></h6>
			<h6><a class="dropdown-item" href="#">Electronics & Semiconductors</a></h6>
			<h6><a class="dropdown-item" href="#">Automobile </a></h6>
			<h6><a class="dropdown-item" href="#">Chemical & Material </a></h6>
			<h6><a class="dropdown-item" href="#">Food & Beverages</a></h6>
			<h6><a class="dropdown-item" href="#">Consumer Products</a></h6>
        </div>
        <!-- <div class="dropdown-menu megamenu" aria-labelledby="dropdown01">
        	<div class="container">
				<div class="row">
					<div class="col-sm-6 col-lg-3">
						<h5>Healthcare</h5>
						<a class="dropdown-item" href="<?= base_url('reports-category/biotechnology') ?>">Biotechnology</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/healthcare-information-technology') ?>">Healthcare Information Technology (IT)</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/medical-devices') ?>">Medical Devices</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/pharmaceuticals') ?>">Pharmaceuticals</a>
					</div>
					<div class="col-sm-6 col-lg-6">
						<h5>Information and Communication Technology</h5>
						<div class="row">
							<div class="col-sm-6 col-lg-6">
								<a class="dropdown-item" href="<?= base_url('reports-category/internet-of-things') ?>">Internet of Things</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/analytics') ?>">Analytics</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/cloud-computing') ?>">Cloud Computing</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/software-solutions') ?>">Software & Solutions</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/it-hardware') ?>">IT Hardware</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/security') ?>">Security</a>
							</div>
							<div class="col-sm-6 col-lg-6">
								<a class="dropdown-item" href="<?= base_url('reports-category/surveillance') ?>">Surveillance </a>
								<a class="dropdown-item" href="<?= base_url('reports-category/telecommunication') ?>">Telecommunication</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/artificial-intelligence') ?>">Artificial Intelligence </a>
								<a class="dropdown-item" href="<?= base_url('reports-category/cloud-big-data') ?>">Cloud and Big Data</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/communication-connectivity-technology') ?>">Communication and Connectivity Technology</a>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<h5>Energy and Power</h5>
						<a class="dropdown-item" href="<?= base_url('reports-category/power-solutions') ?>">Power Solutions</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/conventional-energy') ?>">Conventional Energy</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/distribution-utilities') ?>">Distribution & Utilities</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/power-generation-storage') ?>">Power Generation & Storage</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/renewable-energy') ?>">Renewable Energy</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-lg-3">
						<h5>Electronics & Semiconductors</h5>
						<a class="dropdown-item" href="<?= base_url('reports-category/electronic-devices') ?>">Electronic Devices</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/electronics-parts-components') ?>">Electronics Parts and Components</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/semiconductor-materials-components') ?>">Semiconductor Materials and Components</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/battery-wireless-charging') ?>">Battery and Wireless Charging</a>
					</div>
					<div class="col-sm-6 col-lg-6">
						<h5>Advanced Technology</h5>
						<div class="row">
							<div class="col-sm-6 col-lg-6">
								<a class="dropdown-item" href="<?= base_url('reports-category/automotive-transportation') ?>">Automotive and Transportation</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/communications-infrastructure') ?>">Communications Infrastructure</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/industrial-automation') ?>">Industrial Automation</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/communication-services') ?>">Communication Services</a>
							</div>
							<div class="col-sm-6 col-lg-6">
								<a class="dropdown-item" href="<?= base_url('reports-category/digital-media') ?>">Digital Media</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/hvac-construction') ?>">HVAC & Construction</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/network-security') ?>">Network Security</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/next-generation-technologies') ?>">Next Generation Technologies</a>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<h5>Automobile </h5>
						<a class="dropdown-item" href="<?= base_url('reports-category/automotive-parts-materials') ?>">Automotive Parts and Materials</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/advance_technologies') ?>">Advanced Technologies</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/automotive-systems') ?>">Automotive Systems</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/driving-support-system-solutions') ?>">Driving Support System and Solutions</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/electrical-vehicles') ?>">Electric Vehicles</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-lg-6">
						<h5>Chemical & Material </h5>
						<div class="row">
							<div class="col-sm-6 col-lg-6">
								<a class="dropdown-item" href="<?= base_url('reports-category/fertilizers') ?>">Fertilizers</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/agrochemicals') ?>">Agrochemicals</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/disinfectants-preservatives') ?>">Disinfectants & Preservatives</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/organic-chemicals') ?>">Organic Chemicals</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/paints-coatings-printing-inks') ?>">Paints, Coatings & Printing Inks</a>
							</div>
							<div class="col-sm-6 col-lg-6">
								<a class="dropdown-item" href="<?= base_url('reports-category/personal-care-cosmetics') ?>">Personal Care & Cosmetics</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/speciality-chemicals') ?>">Speciality Chemicals</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/plastics-polymers') ?>">Plastics and Polymers</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/green-chemicals') ?>">Green Chemicals</a>
								<a class="dropdown-item" href="<?= base_url('reports-category/petrochemicals') ?>">Petrochemicals</a>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<h5>Food & Beverages</h5>
						<a class="dropdown-item" href="<?= base_url('reports-category/animal-feed-additives') ?>">Animal Feed & Feed Additives</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/food-beverage') ?>">Food Manufacturing & Processing</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/nutraceuticals-functional-foods') ?>">Nutraceuticals & Functional Foods</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/processed-frozen-foods') ?>">Processed & Frozen Foods</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/food-ingredient') ?>">Food Ingredients</a>
					</div>
					<div class="col-sm-6 col-lg-3">
						<h5>Consumer Products</h5>
						<a class="dropdown-item" href="<?= base_url('reports-category/home-appliances') ?>">Home appliances</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/consumer-electronics') ?>">Consumer electronics</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/packaging') ?>">Packaging</a>
						<a class="dropdown-item" href="<?= base_url('reports-category/consumer-goods') ?>">Consumer Goods</a>
					</div>
				</div>
  			</div>
 		</div> -->
     </li>



      <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          	Services
        </a>
        <div class="services dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="<?= base_url('services/consulting') ?>">Consulting</a>
			<a class="dropdown-item" href="<?= base_url('services/custom-reports') ?>">Field Research</a>
			<a class="dropdown-item" href="<?= base_url('services/industry-reports') ?>">Industry Insights</a>
			<a class="dropdown-item" href="<?= base_url('services/corporate-profiling') ?>">Corporate Profiling</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('press-release') ?>">News Room</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('contact-us') ?>">Contact Us</a>
      </li>
    </ul>
  </div>
</div>
</nav>
<!--Navigation-->