<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--Catogory-->
 <section class="catogory report_full">
 	<div class="container">
 		<div class="bricamp">

		<nav>
           <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= isset($current_category) && $current_category ? ucfirst($current_category->title) : '' ?></li>
            </ol>
         </nav>
      </div>
 		<div class="row">
 			<div class="col-md-3">
 				<div class="category_left">
 					<div class="search_box">
                        <form method="get" class="form-horizontal" role="form" action="">
                            <input type="text" name="search" placeholder="Search" value="<?= filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);?>">
                            <button><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
 					<h3>PRODUCT CATEGORIES</h3>
 					<ul>
 						<?php
 							if ( isset($categories) && !empty($categories) ) {
 								foreach ($categories as $item) {
 									echo '<li><a href="'.base_url('reports-category/'.$item->url).'" class="'.( isset($current_category) && $current_category->url == $item->url ? 'active' : '').'">'.$item->title.'</a></li>';
 								}
 							}
 						?>
 					</ul>
 				</div>
 			</div>
 			<div class="col-md-9">
 				<div class="report_left category_right">
 					<p><!-- category description --></p>
          <div class="category-title"><h1><?= ( isset($current_category) && $current_category ? ucfirst($current_category->title) : '' ) ?> Reports</h1></div>
					<div class="post_content">
                    <?php
                    	if ( isset($reports) && !empty($reports) ) {
                    		foreach ($reports as $item) {
                          echo '<div class="category-report-container">';
                    			echo '<a class="report-title" href="'.base_url('industry-reports/'.$item->url).'">'.$item->title.'</a>';
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