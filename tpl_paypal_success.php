<?php 
/*
Template Name: Paypal-Success
*/
$tx = $_REQUEST['tx'];	
?>
<?php get_header();?>

<script language="javascript" type="text/javascript">
	function printDiv(divID) {
		//Get the HTML of div
		var divElements = document.getElementById(divID).innerHTML;
		//Get the HTML of whole page
		var oldPage = document.body.innerHTML;

		//Reset the page's HTML with div's HTML only
		document.body.innerHTML = 
        "<html><head><title></title></head><body>" + 
        divElements + "</body>";

		//Print Page
		window.print();

		//Restore orignal HTML
		document.body.innerHTML = oldPage;
  }
</script>

<div class="middle_title">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
       
        <h3> <?php the_title(); ?> </h3>
    </div>


    <div class="middle_content_section">
        <div class="wrapper_inner">
            <div class="payment_content_left">  
               <?php the_content(); 
               $args = array( 'post_type' => 'myclass', 'p' => $_REQUEST['cm'] );
               $query = new WP_Query( $args );
               while ( $query->have_posts() ) : $query->the_post();
               $txt_fname = get_post_meta($post->ID, 'txt_fname', true);
               $txt_lname = get_post_meta($post->ID, 'txt_lname', true);
               $student_email = get_post_meta($post->ID, 'student_email', true);
               
               ?>
               <div id="print_table">
                   <table>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?php echo $txt_fname." ".$txt_lname; ?></td>                            
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $student_email; ?></td>                            
                    </tr>
                    <tr>
                        <td>Registration ID</td>
                        <td>:</td>
                        <td><?php echo $_REQUEST['cm']; ?></td>                            
                    </tr>   
                    <tr>
                        <td>Transaction ID</td>
                        <td>:</td>
                        <td><?php echo $_REQUEST['tx']; ?></td>                            
                    </tr>
                    <tr>
                        <td>Payment Amount</td>
                        <td>:</td>
                        <td><?php echo $_REQUEST['amt']; ?> <?php echo $_REQUEST['cc']; ?></td>                            
                    </tr>                        
                    <tr>
                        <td>Payment Status</td>
                        <td>:</td>
                        <td><?php echo $_REQUEST['st']; ?></td>                            
                    </tr>                                           
                </table>
            </div>
            <input type="button" value="Print" onclick="javascript:printDiv('print_table')" />
        <?php endwhile; endwhile; else: ?>    

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