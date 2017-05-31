<?php get_header();?>

<div class="middle_title">
    <h3>Page Not Found</h3>
</div>

<div class="middle_content_section">
    <div class="wrapper_inner">
        <div class="contact_content_left">  
            	<p>Sorry......</p>
                <p>The Requested Page not Found....</p>
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