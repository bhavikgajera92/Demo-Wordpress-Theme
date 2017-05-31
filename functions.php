<?php

include("functions/custom-meta-box.php");
include("functions/custom_post_type.php");
 
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
		'name'          => 'Search',
		'id'            => 'search'
    ));
	register_sidebar(array(
        'before_widget' => '',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="title">',
        'after_title'   => '</h2><div class="sidebar">',
		'name'          => 'Sidebar',
		'id'            => 'sidebar'
    ));	
	register_sidebar(array(
        'before_widget' => '<div class="content_video">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="title">',
        'after_title'   => '</h2>',
		'name'          => 'Sidebar Video',
		'id'            => 'sidebar_video'
    ));	
	register_sidebar(array(
        'before_widget' => '<div class="quick_contact">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
		'name'          => 'Quick Contacts',
		'id'            => 'quick_contact'
    ));	
}
	
function new_excerpt_length($length) {
	return 70;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more( $more ) {
 	return '';
}
add_filter('excerpt_more', 'new_excerpt_more'); 

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(array(
								'header_menu' => __( 'Header Menu' ),	
								'site_map' => __( 'Site Map' ) ,	
								'footer_menu' => __( 'Footer Menu' )						
							 ));
}	
function themename_comment($comment, $args, $depth) {
	
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		
?>

<<?php echo $tag ?>
<?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?>
id="comment-
<?php comment_ID() ?>
">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 40 ); ?>
    </div>
    <div class="commentList">
        <div class="authorName"> <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> </div>
        <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation">
        <?php _e('Your comment is awaiting moderation.') ?>
        </em> <br />
        <?php endif; ?>
        <div class="commentText">
            <?php comment_text(); ?>
        </div>
        <div class="reply"> <?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?>
            <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php if ( 'div' != $args['style'] ) : ?>
</div>
<?php endif; }
	

/*My Theme Option*/
add_action('admin_menu', 'site_options_menu');

function site_options_menu() {

	add_menu_page('Site Options', 'Site Options', 'administrator', __FILE__, 'site_options_page');

	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	register_setting( 'my-own-theme-options', 'header_image' );
	register_setting( 'my-own-theme-options', 'footer_text' );
	register_setting( 'my-own-theme-options', 'address' );
	register_setting( 'my-own-theme-options', 'contact_no' );
	register_setting( 'my-own-theme-options', 'email_id' );
	register_setting( 'my-own-theme-options', 'google_map' );
	
}

function site_options_page() {
?>
<div class="wrap">
    <h2>Site Options</h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'my-own-theme-options' ); ?>
        <?php do_settings_sections( 'my-own-theme-options' ); ?>
        <table class="form-table">
            <h3>Contact Detail</h3>
            <tr valign="top">
                <th scope="row">Contact No</th>
                <td><input type="text" name="contact_no" value="<?php echo get_option('contact_no'); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">E-mail Id</th>
                <td><input type="text" name="email_id" value="<?php echo get_option('email_id'); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Address</th>
                <td><textarea style="width:435px" name="address" ><?php echo get_option('address'); ?></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row">Google Map</th>
                <td><textarea style="width:435px" name="google_map" ><?php echo get_option('google_map'); ?></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row">Header Image</th>
                <td><input id="upload_image" style="padding:5px; margin:0px" type="text" size="36" name="header_image" value="<?php echo get_option('header_image'); ?>" />
                    <input id="upload_image_button" type="button" value="Upload Image" class="button button-primary button-large" />
                    <?php if(get_option('header_image')!='') { ?>
                    <br />
                    <a href="<?php echo get_option('header_image'); ?>" target="_new"> <img src="<?php echo get_option('header_image'); ?>" style="width:50px; height:auto; margin-top:10px;" /> </a>
                    <?php } ?></td>
            </tr>
            <script type="text/javascript">
        jQuery(document).ready(function() {

		jQuery('#upload_image_button').click(function() {
		 formfield = jQuery('#upload_image').attr('name');
		 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		 return false;
		});
		
		window.send_to_editor = function(html) {
		 imgurl = jQuery('img',html).attr('src');
		 jQuery('#upload_image').val(imgurl);
		 tb_remove();
		}
		
	});
        </script>
            <!--<tr valign="top">
                <th scope="row">Footer Text</th>
                <td><?php/*
			$content = get_option('footer_text');
			$editor_id = 'footer_text';
			wp_editor( $content, $editor_id );*/
		?></td>
            </tr>-->
        </table>
        <?php submit_button(); ?>
    </form>
</div>
<?php } 
/*My Theme Option*/


function my_pre_save_post( $post_id )
{
    // check if this is to be a new post
    if( $post_id != 'new' )
    {
        return $post_id;
    }
 
    // Create a new post
    $post = array(
        'post_status'  => 'publish' ,
        'post_type'  => 'myclass' 
    );  
 
    // insert the post
    $post_id = wp_insert_post( $post ); 
 
    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );    
 
    // return the new ID
    return $post_id;
}
 
add_filter('acf/pre_save_post' , 'my_pre_save_post' );
 
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
 
function my_deregister_styles() {
	wp_deregister_style( 'wp-admin' );
}
 
add_action('init', 'my_out');
function my_out() 
{
        ob_start();
}
 
 
 
 function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php bloginfo('template_url'); ?>/images/logo.png);
            padding-bottom: 30px;
			background-size: 100% 100%;
			width: 100%;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
?>