<?php 
/*
Template Name: SITE MAP
*/
get_header();?>

<div class="middle_title">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
       
        <h3><?php the_title(); ?></h3>
    </div>
    <div class="middle_content_section">
        <div class="wrapper_inner">
            <div class="contact_content_left">  
               <div class="sitemap_section">
                   
                
                <?php wp_nav_menu( array( 'theme_location'  => 'site_map',                                              
                   'container'	   => false,
                   'menu_class'      => 'site_map',
                   'link_before' 		=> '<span>',
                   'link_after' 		=> '</span>' )); ?>	
                <script type="text/javascript">
                   jQuery(document).ready(function() {
                      jQuery("ul.site_map li:last-child").addClass("last-nod");
                  })
              </script>
              
              
          <?php endwhile; endif; ?>
      </div>
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