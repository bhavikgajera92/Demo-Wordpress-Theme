<?php
/*
Template Name: Near By Hotels
*/

get_header();?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#popuplink').fancybox();
		});
</script>

<div class="wrapper_inner">
    
    
    <?php
	wp_reset_query();
	
	$args=array(
				'post_type' => 'hotels',
				);
	$query = new WP_Query( $args );
	
	while ( $query->have_posts() ) : $query->the_post();	
	  	
		$hotel_name=get_field( "hotel_name");
		$hotel_address=get_field( "hotel_address");
		$hotel_phone=get_field( "hotel_phone");
		$hotel_fax=get_field( "hotel_fax");	
		$hotel_map=get_field( "hotel_map");	
    	?>
        	<div class="middle_content_section">
            <ul class="reg_address">
                <li><span>Address:</span><p><?php echo $hotel_name;?><br /><?php echo $hotel_address;?></p></li>
                	<?php if($hotel_phone != ""){?>
                <li><span>Phone:</span><a href="tel:<?php echo $hotel_phone;?>"><?php echo $hotel_phone;?></a> </li>
                	<?php } if($hotel_fax != ""){?>
                <li><span>Fax:</span><p><?php echo $hotel_fax;?><p></li>
               		<?php } if($hotel_map != ""){?>
                <a id="popuplink" href="#popupdiv_<?php echo get_the_ID(); ?>">Google Map</a>
                	<?php } ?>
            </ul>
            
    		<div id="popupdiv_<?php echo get_the_ID(); ?>" style="display: none;">
            	<?php echo $hotel_map;?>
            </div>
            
            <div class="address_image">
                <h4>View Walking place</h4>
                <?php				
                    if ( has_post_thumbnail() ) :
                        the_post_thumbnail(); 
                    else : ?>
                        <img src="<?php bloginfo('template_url'); ?>/images/address.jpg" align="Location Address" />
                    <?php endif; ?> 
					
            </div>
</div>
                  <?php  endwhile;
                 wp_reset_query(); ?>
</div>
<?php get_footer(); ?>