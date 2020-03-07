<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--Banner_slider-->
 <section class="hero_slider">
 	<div id="carousel" class="owl-carousel">
 		<div class="item">
 			<div class="slider_banner">
 				<img src="<?= base_url('assets/images/orion-market-research.jpg') ?>">
 			</div>
 			<div class="banner_content">
 				<div class="container">
 					<div class="content_wrap">
		 				<h1>Welcome to Orion Market Research!</h1>
		                 <p></p>
		                 <!-- <a href="#"></a> -->
		            </div>
	 			</div>
 			</div>
 		</div>
 		<!-- <div class="item">
 			<div class="slider_banner">
 				<img src="<?= base_url('assets/images/slider/healthcare-market-reports.jpg') ?>">
 			</div>
 			<div class="banner_content">
 				<div class="container">
 					<div class="content_wrap">
		 				<h1>Healthcare Market Research Reports & Industry Analysis</h1>
		                 <p>Healthcare industry report covers in-depth knowledge of market insights (market determinants, pipeline analysis, patent analysis, competitive landscape) to discover new investment opportunities and market strategies for life science, pharmaceutical, and medical device sectors.</p>
		                 <a href="#">Learn more</a>
		            </div>
	 			</div>
 			</div>
 		</div>
 		<div class="item">
 			<div class="slider_banner">
 				<img src="<?= base_url('assets/images/slider/ict-market-reports.jpg') ?>">
 			</div>
 			<div class="banner_content">
 				<div class="container">
 					<div class="content_wrap">
		 				<h1>ICT Market Research Reports & Industry Analysis</h1>
		                 <p>ICT industry covers in-depth analysis of different categories (networking components, applications, software, and hardware) that allow organizations to optimize their businesses through digital technology.</p>
		                 <a href="#">Learn more</a>
		            </div>
	 			</div>
 			</div>
 		</div>
 		<div class="item">
 			<div class="slider_banner">
 				<img src="<?= base_url('assets/images/slider/energy-market-reports.jpg') ?>">
 			</div>
 			<div class="banner_content">
 				<div class="container">
 					<div class="content_wrap">
		 				<h1>Energy Market Research Reports & Industry Analysis</h1>
		                 <p>Energy industry reports provide detailed market research and analysis such as demand-supply analysis, historical analysis, pricing analysis, and regulations to help the client maximize their revenue by providing them insights into the current market trends.</p>
		                 <a href="#">Learn more</a>
		            </div>
	 			</div>
 			</div>
 		</div> -->

 	</div>
 </section>
<!--Banner_Slider-->
<!--Service_section-->
<section class="service">
	<div class="container">
		<div class="heading">
			<h2>Services</h2>
		</div>
	<div class="service_sections">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-xs-12">
				<div class="service_box">
					<img src="<?= base_url('assets/images/Industry-Reports.png') ?>" alt="Industry Reports">
					<h3>Industry Insights</h3>
					<p>Our syndicate reports cover sixteen
					industrial/technical categories across the globe. These
					reports are designed to provide market insights</p>
					<a href="https://www.omrglobal.com/services/industry-reports">Continue Reading</a>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-xs-12">
				<div class="service_box">
					<img src="<?= base_url('assets/images/Consulting-Services.png') ?>" alt="Consulting Services">
					<h3>Consulting Services</h3>
					<p>We are committed to provide quality 
					consulting services at attractive prices. We provide 360
					degree market research and analysis in each </p>
					<a href="https://www.omrglobal.com/services/consulting">Continue Reading</a>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-xs-12">
				<div class="service_box">
					<img src="<?= base_url('assets/images/Corporate-Profiling.png') ?>" alt=" Corporate Profiling">
					<h3>Corporate Profiling</h3>
					<p>Orion Market Research publishes company profiles for a variety of clients. We provide a detailed analysis of companies</p>
					<a href="https://www.omrglobal.com/services/corporate-profiling">Continue Reading</a>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-xs-12">
				<div class="service_box">
					<img src="<?= base_url('assets/images/Custom-Research.png') ?>" alt="Custom Research">
					<h3>Field Research</h3>
					<p>We are committed to provide quality 
					consulting services at attractive prices. We provide 360
					degree market research and analysis in each </p>
					<a href="https://www.omrglobal.com/services/custom-reports">Continue Reading</a>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
<!--Service_section-->
<!--Reports-->
<section class="reports">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="heading">
			      <h3>Latest Reports</h3>
		       </div>
		       <?php if ( isset($reports) && !empty($reports) ) {
		       		foreach ($reports as $item) {
		       			echo '<div class="row"><div class="report_box col-md-7 report_content_half_size"><h4><a href="'.base_url('industry-reports/'.$item->url).'">'.$item->title.'</a></h4><p>'.($item->short_description ? strip_tags($item->short_description) : 'No Description Available.').'</p><a href="'.base_url('industry-reports/'.$item->url).'">Continue Reading ></a></div><div class="latest_report_image col-md-5"><img src="C:\xampp\htdocs\CodeIgniter\assets\images\logo.png"/></div>'.'<hr></div>';
		       		}
		       } ?>
		    </div>
		</div>
	</div>
</section>
<!--Reports-->
<!--Industry-->
<div class="industry">
	<div class="container">
		<div class="heading">
		 <h2>Industry we cover</h2>
		</div>
		<div class="industry_points">
			<ul>
				<li>Agro Chemicals</li>
				<li>Biotechnology</li>
				<li>Cloud and Big Data</li>
				<li>Advanced Materials</li>
				<li>Chemicals</li>
				<li>Medical Device</li>
				<li>Healthcare IT</li>
				<li>Automobiles</li>
				<li>Green Chemicals</li>
				<li>Pharmaceutical</li>
				<li>ICT Market</li>
				<li>Energy</li>
				<li>Plastic and Polymers</li>
				<li>Food and Beverages</li>
				<li>Semiconductor</li>
				<li>Transportation and Logistics</li>
			</ul>
		</div>
	</div>
</div>
<!--Industry-->
<!--Market_Research-->
<section class="market_research">
	<div class="container">
		<h3>Key stats about Orion Market Research </h3>
		<div class="row">
			<div class="col-md-4">
				<div class="market_box">
					<img src="<?= base_url('assets/images/M1.png') ?>" alt="">
					<h5>400+ Reports Published Per Year</h5>
				</div>
			</div>
			<div class="col-md-4">
				<div class="market_box">
					<img src="<?= base_url('assets/images/M2.png') ?>" alt="">
					<h5>600+ Consulting Projects Till Date</h5>
				</div>
			</div>
			<div class="col-md-4">
				<div class="market_box">
					<img src="<?= base_url('assets/images/M3.png') ?>" alt="">
					<h5>300+ Clients Worldwide</h5>
				</div>
			</div>
		</div>
	</div>
</section>
<!--Market_Research-->
<!--Testimonials-->
<section class="testimonials">
	<div class="container">
		<div class="heading">
		 	<h2>Testimonials</h2>
		</div>
		 <div class="slider-for">
			<div class="item">
				<div class="testimoinal_wrap">
					<p>We'd like to express our sincere thanks to Orion Market Research that has been an exceptional, ideal, long-term research partner. The team has always risen to our high-end demand and worked hard towards the same. From the very beginning the team offered great service with a thoroughly professional attitude.</p>
					
					<h5>CTO, North American Automobile Company</h5>
				</div>
			</div>
			<div class="item">
				<div class="testimoinal_wrap">
					<p>We value the commitment of Orion Market Research towards keeping us updated, adhering to committed timelines, flexibility, exceptional attention to detail, quality of methods used and accuracy of data. I would without as much as a second thought certainly recommend them to anyone looking for a research partner.</p>
					
					<h5>Vice President, Leading Healthcare Company</h5>
				</div>
			</div>
			<div class="item">
				<div class="testimoinal_wrap">
					<p>Our experience with Orion Market Research has been a truly delightful experience and we are thankful for their accurate research data and insights support. The professionals were very responsive to our needs-constantly updating us on the status of project. The team has a unique blend of professional capabilities.</p>
					
					<h5>Sales Manager, Leading Global Healthcare IT Firm</h5>
				</div>
			</div>
		</div>

		
	</div>
</section>
<!--Testimonials-->
<!--Our Client-->
<section class="our_client">
	<div class="container">
		<div class="heading">
		 <h2>Our Clients</h2>
		</div>
		<div class="client_logo">
			<div id="clinet" class="owl-carousel">
				<div class="item"><img src="<?= base_url('assets/images/logos/1024px-Baxter.svg.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/1024px-Rheem_logo.svg.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/1200px-Nikon_Logo.svg.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/1280px-Toshiba_logo.svg.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/320px-Intel-logo.svg.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/6114885_orig.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/Alere_Logo.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/BASF-Logo_bw.svg1_.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/bayer-logo.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/Konica_Minolta.svg.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/logo.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/logo1.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/logo_main.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/Lunaphore-Technologies-Logotype-2.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/pkf-logo-png-transparent.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/sacl_amzn_amazon_6.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/samsung_logo_PNG14.png') ?>" alt=""></div>
				<div class="item"><img src="<?= base_url('assets/images/logos/Teva_logo.svg.png') ?>" alt=""></div>
			</div>
		</div>
	</div>
</section>
<!--Our Client-->