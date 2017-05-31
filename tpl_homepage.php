<?php
/*
Template Name: Home Page
*/
get_header();?>
        	<div class="wrapper_inner">
            	<div class="slider_section">
                        <!--  Outer wrapper for presentation only, this can be anything you like -->
                        <div id="banner"> 
                          <!-- start Basic Jquery Slider -->
                          <ul class="bjqs">
                          	<?php
							 wp_reset_query();
							 $query = new WP_Query( 'post_type=slider' );
								while ( $query->have_posts() ) : $query->the_post();?>
                                <li>
                                    <div class="slider_image">
                                    	<?php if ( has_post_thumbnail() ) {
												  the_post_thumbnail('full'); }
											  else { ?>
                                        <img src="<?php bloginfo('template_url'); ?>/images/slider_image1.jpg" alt="Slider Image 1"/>
                                        <?php } ?>
                                    </div>
                                    <div class="slider_box">
                                        <h2><?php the_title();?></h2>
                                        <?php the_content();?>
                                    </div>
                                </li>
                            <?php endwhile;
							 wp_reset_query(); ?>
                          </ul>
                          <!-- end Basic jQuery Slider --> 
                        </div>
                        <!-- End outer wrapper --> 
                        <!-- Load jQuery and the plug-in --> 
                        
                </div>
                <div class="latest_news">
                	<h2>latest news : </h2>
                    
                    <ul id="ticker01">
					<?php wp_reset_query();
						$catquery = new WP_Query( 'cat=8' );
						while($catquery->have_posts()) : $catquery->the_post();
						?>
								 <li><a href="<?php the_permalink(); ?>"><?php echo get_the_excerpt(); ?></a></li>
						 <?php endwhile;
		 				 wp_reset_query(); ?>
                        <!-- eccetera -->
                    </ul>
                    
                </div>
                <div class="content_section">
                	<div class="content_left">
                    	<h3>about us</h3>
                        <?php wp_reset_query();
							$args=array("p"=>"12");
							$query = new WP_Query("page_id=12");//write your post id and get result.
							while ( $query->have_posts() ) : $query->the_post();
                           
								the_post_thumbnail('full');
								the_content();
							endwhile;
							wp_reset_query(); ?>                        
                    </div>
                	<div class="content_right">
                    	<?php if ( is_active_sidebar( 'sidebar_video' ) ) { dynamic_sidebar( 'sidebar_video' ); } ?>
                        <div class="shedule_section">
                        	<?php include("shedule_data.php");?>
                        </div>
                    </div>
                </div>
            </div>
<?php get_footer(); ?>