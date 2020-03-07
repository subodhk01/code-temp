<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$blog_type_slug = isset($blog_type_slug) ? $blog_type_slug : 'blog';
$blog_type_name = isset($blog_type_name) ? $blog_type_name : 'Blog';
?>
<!--Catogory-->
 <section class="catogory report_full">
 	<div class="container">
 		<div class="bricamp">

		<nav>
           <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $blog_type_name ?></li>
            </ol>
         </nav>
      </div>
 		<div class="row">
 			<div class="col-md-3 col-lg-3">
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
                    <div class="sidebar-title green">Benefits of buying from us</div>
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
 			<div class="col-md-9 col-lg-9">
 				<div class="press_release_right category_right">
 					<p>Advancement in technologies enables to create modern day world led by introduction of new smart gadgets 
					that have optimized business operations and eased lives. New technologies and development has significantly
					contributed in shaping modern day businesses and day to day activities through innovation, contentedness
					and R&D. In broader sense it has given people a power to retrieve every important information and 
					communicate in a thousand different ways using a device that fits in your pocket. Recent advance technology 
					in domains such as automotive, healthcare, chemical and ICT have simplified complex business processes and 
					enhanced time and cost efficiency. Technologically advanced industries include numerous recent technology 
					devices and products such as smart sensors, carbon nano tube, AR (Augmented Reality) and VR (Virtual Reality)
					IoT (Internet of Things) and other wireless devices. At OMR, we provide detailed analysis of each segment 
					along with the driver, restraints and opportunities in that segment. Our in-depth analysis of the advanced 
					technology market report includes analysis of government regulation, tax laws, import-export policies and 
					environment laws by major markets. Analyst at OMR, derives number through extensive primary and 
					secondary research. Our reports serve as best decision-making tool for your organization to gain the insights 
					of the market.</p>
          <div class="category-title"><?= ( isset($current_category) && $current_category ? ucfirst($current_category) : '' ) ?></div>
					<div class="post_content">
                    <?php
                    	if ( isset($blogs) && !empty($blogs) ) {
                    		foreach ($blogs as $item) {
                          echo '<div class="category-report-container">';
                    			echo '<a class="report-title" href="'.base_url($blog_type_slug.'/'.$item->url).'">'.$item->title.'</a>';
                          echo '<div class="report-published">Published : '.date('M Y',strtotime($item->date_published)).'</div>';
                          echo '<div class="report-short-description">'.$item->short_description.'</div>';
                          echo '</div>';
                    		}
                    	}
                    ?>
				  </div>
 				</div>
 				
 			</div>
 		</div>
 	</div>
 </section>
<!--Catogory-->