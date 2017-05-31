<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="handheldfriendly" content="true" />
<meta name="MobileOptimized" content="width" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>
<?php
	global $page, $paged;
	wp_title( '-', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'mytheme' ), max( $paged, $page ) );

?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link href="<?php bloginfo('template_url'); ?>/css/table.css" rel="stylesheet" type="text/css"/>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 

	<!--Favicon-->
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon" />
    <!-- Basic Jquery Slider styles (This is the only essential css file) -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/basic-jquery-slider.css" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/validationEngine.jquery.css" type="text/css"/>

     <script src="<?php bloginfo('template_url'); ?>/js/libs/jquery-1.6.2.min.js" type="text/javascript"></script> 
     <script src="<?php bloginfo('template_url'); ?>/js/basic-jquery-slider.js"  type="text/javascript"></script> 
     <script src="<?php bloginfo('template_url'); ?>/js/jquery.li-scroller.1.0.js"  type="text/javascript"></script> 
     <script src="<?php bloginfo('template_url'); ?>/js/footable.js" type="text/javascript"></script>
     
    <!--  Slider Script --> 
    <script type="text/javascript">
          $(document).ready(function() {
                
            $("#banner").bjqs({
            'width' : "100%",
            'height' : "100%",
            'responsive' : true,
            'showMarkers' : false,
            'showControls' : true,
            'centerMarkers' : false,
            'automatic': true,
            'useCaptions' : true,
            'keyboardNav' : false,
            nextText: '<img src="<?php bloginfo('template_url'); ?>/images/slider_right_arrow.png" alt="&gt;" />',
            prevText: '<img src="<?php bloginfo('template_url'); ?>/images/slider_left_arrow.png" alt="&lt;" />'
            });
          });
   </script> 
     
    <!--  Toogle Menu Script --> 
    <script type="text/javascript">
          $(document).ready(function() {
               		
			$("#toggle").click(function(e){
				e.preventDefault();
				$(".nav").slideToggle();		
			});
          });
		  
		$(function(){
			$("ul#ticker01").liScroll();
		}); 
   </script> 
     
    <!--  Foo Table Script --> 
    <script type="text/javascript">
    $(function () {
        $('table').footable();

        $('.colour-switch a').click(function(e) {
            e.preventDefault();
            $('.colour-switch a').each(function() {
                $('table').removeClass($(this).data('class'));
            });
            $('table').addClass($(this).data('class'));
        });
    });
	</script>
       
    <!--  Testimonial Script --> 
    <script  type="text/javascript">
          $(document).ready(function() {
                
            $("#banner_testimonial").bjqs({
            'width' : '100%',
            'height' : '18px',
            'responsive' : true,
            'showMarkers' : false,
            'showControls' : true,
            'centerMarkers' : false,
            'automatic': false,
            'useCaptions' : true,
            'keyboardNav' : false,
            nextText: '<img src="<?php bloginfo('template_url'); ?>/images/testimonial_right_arrow.png" alt="&gt;" />',
            prevText: '<img src="<?php bloginfo('template_url'); ?>/images/testimonial_left_arrow.png" alt="&lt;" />'
            });
            
          });
   </script> 
   
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_enqueue_script( 'jquery' ); wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="page">
	<div class="wrapper">
    	<div class="header_secion">
        	<div class="wrapper_inner">
                <div class="header_logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="Step2CS Logo" /></a>
                </div>
                <div class="header_right">
                    	<div class="header_contact">
                        	<ul>
                            	<li><a href="tel:<?php echo get_option('contact_no'); ?>"><span><img src="<?php bloginfo('template_url'); ?>/images/cell.png" alt="Cell Logo" /></span>Contact us: <?php echo get_option('contact_no'); ?></a> </li>
                            	<li><a href="mailto:<?php echo get_option('email_id'); ?>?Subject=Hello%20again" target="_top"><span><img src="<?php bloginfo('template_url'); ?>/images/mail.png" alt="MAIl Logo" /></span><?php echo get_option('email_id'); ?></a> </li>
                            </ul>
                        </div>
                    	<div class="header_option">
                        	<ul>
                            	<li><a href="<?php echo get_permalink('23');?>?p=reg_form">Register Online Today</a></li>
                            	<li><a href="<?php echo get_permalink('167');?>">Group Discounts Available</a></li>
                            </ul>
                        </div>
                    </div>
                <div class="header_menu">
                <a href="#" id="toggle"><img src="<?php bloginfo('template_url'); ?>/images/menu_icon.png" alt="MENU" /></a>
                	 <?php wp_nav_menu( array( 'theme_location'  => 'header_menu',                                              
                                      			'container'	   => false,
												'menu_class'      => 'nav', )); ?>
                </div>
            </div>
        </div>
        <div class="middle_section">