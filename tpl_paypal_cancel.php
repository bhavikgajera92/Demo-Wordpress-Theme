<?php 
/*
Template Name: Paypal-Cancel
*/
get_header();?>

<div class="middle_content_section">
    <div class="wrapper_inner">
        <div class="contact_content_left">  
       
        	<?php if (have_posts()) : while (have_posts()) : the_post(); //If you have any posts then post here. ?>
            
            	<h2 class="title">Payment has been Failed !</h2> 
			
			
			
                 <?php endwhile; else: ?>    

                    <div class="error"><?php _e('Not found.'); ?></div> 

                <?php endif; ?>
            
        </div>
        <div class="contact_content_right">	
			<?php if ( is_active_sidebar( 'sidebar_video' ) ) { dynamic_sidebar( 'sidebar_video' ); } ?>
           
            <div class="shedule_section">
           		<?php include("shedule_data.php");?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div><!-- EOF : content ID -->

<?php get_footer(); ?>