
            <div class="testimonial_section">
                	<div class="testimonial">
            			<h4>testmonial : </h4>
                        <div class="testimonial_text">
                            <!--  Outer wrapper for presentation only, this can be anything you like -->
                            <div id="banner_testimonial"> 
                              <!-- start Basic Jquery Slider -->
                              <ul class="bjqs">
                              	<?php
							 wp_reset_query();
							 $query = new WP_Query( 'post_type=testomonial' );
								while ( $query->have_posts() ) : $query->the_post();?>
                                <li>
                                        <?php the_content();?>
                                </li>
                            <?php endwhile;
							 wp_reset_query(); ?>
                              </ul> <!-- end Basic jQuery Slider --> 
                            </div><!-- End outer wrapper --> 
                        </div>
                    </div>
            </div>
        </div>
        <div class="footer_section">
        	<div class="footer_top">
            	<div class="wrapper_inner">
                    <div class="contact_detail">
                        <h3>contact detail</h3>
                        
                        <div class="contact_box">
                            <span class="contact_symbol"><img src="<?php bloginfo('template_url'); ?>/images/landmark_symbol.png" alt="Landmark Symbol" /></span>
                            <p><?php echo nl2br(get_option('address')); ?></p>
                        </div>
                        <div class="contact_box">
                            <span class="contact_symbol"><img src="<?php bloginfo('template_url'); ?>/images/cell_symbol.png" alt="Cell Symbol" /></span>
                            <a href="tel:<?php echo get_option('contact_no'); ?>"><?php echo get_option('contact_no'); ?></a>
                        </div>
                        <div class="contact_box">
                            <span class="mail_symbol"><img src="<?php bloginfo('template_url'); ?>/images/mail_symbol.png" alt="Mail Symbol" /></span>
                            <a href="mailto:<?php echo get_option('email_id'); ?>?Subject=Hello%20again" target="_top"><?php echo get_option('email_id'); ?></a>
                        </div>
                    </div>
                    <div class="footer_menu">
                        <h3>step two cs</h3>
                        <?php wp_nav_menu( array( 'theme_location'  => 'header_menu',                                              
                                      			'container'	   => false,
												)); ?>
                    </div>
                    <div class="timing_section">
                        <h3>Upcoming Schedule</h3>
                        <ul>
						<?php 	wp_reset_query();
							$cat_starting_date = get_field( "starting_date");
							$args = array(
										'type'                     => 'myclass',
										'orderby'                  => $cat_starting_date,
										'order'                    => 'ASC',
										'taxonomy'                 => 'myclass_categories',
										'hide_empty'               => 0,
										'pad_counts'               => false );
							$categories = get_categories( $args );
							$i=0;
							foreach ($categories as $category) 
							{
								$cat_title = $category->name; 
								$cat_id = $category->term_id;
								$post_id = "myclass_categories_".$cat_id;
								
								$current_date = date("Y-m-d",time() + 864000);
								$newDate = strtotime($current_date);
								
								$cat_starting_date1 = get_field( "starting_date", $post_id );
								$start_date1=strtotime($cat_starting_date1);
								
								if($newDate <= $start_date1){				
									
									$cat_starting_date = get_field( "starting_date", $post_id );
									$cat_ending_date = get_field( "ending_date", $post_id );
									
									$start_month=date('M',strtotime($cat_starting_date));
									$end_month=date('M',strtotime($cat_ending_date));
									$start_day=date('d',strtotime($cat_starting_date));
									$end_day=date('d',strtotime($cat_ending_date));
									
									if($start_month==$end_month){
										$date=$start_month." ".$start_day." - ".$end_day;
										}
									else{
										$date=$start_month." ".$start_day." - ".$end_month." ".$end_day;
										}
									$cat_location = get_field( "location", $post_id );
									$cat_city = get_field( "city", $post_id );
									$cat_state = get_field( "state", $post_id );
								?>
                             <li><a href="<?php echo get_permalink('23');?>?p=reg_form&cat_id=<?php echo $cat_id;?>"><span><?php echo $date;?></span><?php echo $cat_city; ?></a></li>
                            <?php $i++; }}
							wp_reset_query(); ?>
                        </ul>
                    </div>
                    
               		<?php if ( is_active_sidebar( 'quick_contact' ) ) { dynamic_sidebar( 'quick_contact' ); } ?>
                </div>
             </div>
            <div class="copyright">
            	<div class="wrapper_inner">
                    <p>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo( $show ); ?> </a> All rights reserved.</p>
                    <?php wp_nav_menu( array( 'theme_location'  => 'footer_menu',                                              
                                      			'container'	   => false, )); ?>
                </div>
            </div>       	
        </div>
    	
    </div>
</div>
<?php wp_footer(); ?>

</body>
</html>
