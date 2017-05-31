<?php
/*
Template Name: Contact Us
*/
get_header();?>
 <div class="middle_title">
    <h3>Contact us</h3>
</div>
<div class="middle_content_section">
    <div class="wrapper_inner">
        <div class="contact_content_left">
                <div class="google_map_div">
                    <!--  Outer wrapper for presentation only, this can be anything you like -->
                    <div id="googleMap" style="width:100%;height:100%;">
                    	<?php echo get_option('google_map'); ?>
                    </div>
                    <!-- end Basic jQuery Slider -->
                </div>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         
    			<?php the_content(); 
                          
            	 endwhile; endif; ?>
        </div>
      
        <div class="contact_content_right">
            
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
            
               <?php if ( is_active_sidebar( 'sidebar_video' ) ) { dynamic_sidebar( 'sidebar_video' ); } ?>
           
            <div class="shedule_section">
           		<?php include("shedule_data.php");?>
            </div>
    </div>
    </div>
</div>
<?php get_footer(); ?>