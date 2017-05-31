<?php
/*
Template Name: Class Calender
*/

get_header();?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#popuplink').fancybox();
});
</script>

<?php
if(isset($_POST['btn_submit_form']))
{	
	$student_email = $_POST['student_email'];
	
		$txt_fname = $_POST['txt_fname'];
		$txt_lname = $_POST['txt_lname'];
		$txt_street = $_POST['txt_street'];
		$apt = $_POST['apt'];
		$student_city = $_POST['student_city'];
		$student_state = $_POST['student_state'];
		$zip = $_POST['zip'];	
		$student_country = $_POST['student_country'];
		$student_email = $_POST['student_email'];
		$student_telephone = $_POST['student_telephone'];
		$student_gender = $_POST['student_gender'];
		$test_time = $_POST['test_time'];
		$test_attempts = $_POST['test_attempts'];
		$student_telephone1 = $_POST['student_telephone1'];
		$attempts_detail = $_POST['attempts_detail'];
		$how_connected = $_POST['how_connected'];
		$other_connected = $_POST['other_connected'];
		$payment_status = "Unpaid";
		$trans_id = "Not Avaiilable";
		
		
		$category_name = $_POST['category_title'];
		
			$sel_id = "myclass_categories_".$category_name;
		$program_fee = get_field( "program_fee", $sel_id );
			
		$my_post = array(
			'post_title'    => $txt_fname." ".$txt_lname ,
			'post_status'   => 'publish',
			'post_author'   => '1',
			'post_type'     => 'myclass',
			'tax_input'     => array( 'myclass_categories' => array( $category_name ) )
		);
		
		$insert_post = wp_insert_post( $my_post );
		
		update_post_meta($insert_post, 'txt_fname', $txt_fname);
		update_post_meta($insert_post, 'txt_lname', $txt_lname);
		update_post_meta($insert_post, 'txt_street', $txt_street);
		update_post_meta($insert_post, 'apt', $apt);
		update_post_meta($insert_post, 'student_city', $student_city);			
		update_post_meta($insert_post, 'student_state', $student_state);
		update_post_meta($insert_post, 'zip', $zip);
		update_post_meta($insert_post, 'student_country', $student_country);
		update_post_meta($insert_post, 'student_email', $student_email);
		update_post_meta($insert_post, 'student_telephone', $student_telephone);
		update_post_meta($insert_post, 'student_gender', $student_gender);
		update_post_meta($insert_post, 'test_time', $test_time);
		update_post_meta($insert_post, 'test_attempts', $test_attempts);
		update_post_meta($insert_post, 'student_telephone1', $student_telephone1);
		update_post_meta($insert_post, 'attempts_detail', $attempts_detail);
		update_post_meta($insert_post, 'how_connected', $how_connected);
		update_post_meta($insert_post, 'other_connected', $other_connected);
		update_post_meta($insert_post, 'program_fee', $program_fee);
		update_post_meta($insert_post, 'payment_status', $payment_status);
		update_post_meta($insert_post, 'trans_id', $trans_id);
		
		$my_post = array(
			'ID'           => $insert_post,
			'tax_input'    => array( 'myclass_categories' => array( $category_name ) )
		);
		wp_update_post( $my_post );	
	
		$cat_id= $_POST['category_title'];
		$post_id = "myclass_categories_".$cat_id;
		$program_fee = get_field( "program_fee", $post_id );
		$ipn_url=get_bloginfo( 'template_url' )."/ipn.php";
				
			header("location:https://www.sandbox.paypal.com/cgi-bin/webscr?business=sandeep_biz@gmail123.com&cmd=_xclick&first_name=".$txt_fname."&email=".$student_email."&item_name=Order Placed&item_number=".$category_name."&amount=".$program_fee."&currency_code=USD&tax=0&custom=".$insert_post."&notify_url=".$ipn_url."&cancel_return=http://project-demo-server.info/Step2cs/paypal-cancel&return=http://project-demo-server.info/Step2cs/paypal-success");
			die();
}
?>
    
	<!--Page Title-->
    <div class="middle_title">
    	<?php $p=$_REQUEST['p'];
		if($p=='registration'):?>
        	<h3> Registration</h3>
		<?php elseif($p=='reg_form'):?>
        	<h3> Registration Form </h3>
		<?php else: ?>        
        	<h3>class dates / Calender</h3>
        <?php endif; ?>
    </div>
    
    <div class="wrapper_inner">
        <div class="middle_content_section">
        	 <?php
			/*----------   Shedule Table ---------------*/
			if($p!='reg_form'):
				wp_reset_query();
				$args=array(
							'post_type' => 'hotels',
							'posts_per_page'=>'1'
							);
				$query = new WP_Query( $args  );
				
				while ( $query->have_posts() ) : $query->the_post();	
					
					$hotel_name=get_field( "hotel_name");
					$hotel_address=get_field( "hotel_address");
					$hotel_phone=get_field( "hotel_phone");
					$hotel_fax=get_field( "hotel_fax");	
					$hotel_map=get_field( "hotel_map");	
					?>
						<ul class="reg_address">
							<li><span>Address:</span><p><?php echo $hotel_name;?><br /><?php echo $hotel_address;?></p></li>
							<li><span>Phone:</span><a href="tel:<?php echo $hotel_phone;?>"><?php echo $hotel_phone;?></a> </li>
							<li><span>Fax:</span><p><?php echo $hotel_fax;?><p></li>
							<a id="popuplink" href="#popupdiv">Google Map</a>
						</ul>
						
						<div id="popupdiv" style="display: none;"> <?php echo $hotel_map;?> </div>
						
						<div class="address_image">
							<h4>View Walking place</h4>
							<?php				
								if ( has_post_thumbnail() ) :
									the_post_thumbnail(); 
								else : ?>
									<img src="<?php bloginfo('template_url'); ?>/images/address.jpg" alt="Location Image" />
								<?php endif; ?> 
						</div>
						
							  <?php  endwhile;
							 wp_reset_query();
							 endif; 
							 
							 
			/*----------   Shedule Table ---------------*/
			if($p==''): ?>   
            <style type="text/css">
						.tooltip {
							width:250px; position:absolute; top:-122px; left:0; display:none; background:#2FC0DA; border:1px solid #313131;
							padding:10px; color:#ffffff;
							 -moz-border-radius: 5px;
							-webkit-border-radius: 5px;
							-khtml-border-radius: 5px;
							border-radius: 5px;
						}
						</style>
            <table class="footable" data-page-size="5" >
                <thead>
                    <tr>
                        <th> 2014 Schedule DATE </th>
                        <th data-hide="phone"> LOCATION </th>
                        <th data-hide="phone"> CITY/STATE </th>
                        <th> # </th>
                    </tr>
                </thead>
                <tbody>
                	<?php 	
							$cat_starting_date = get_field( "starting_date");
							wp_reset_query();
							$args = array(
										'type'                     => 'myclass',
										'orderby'                  => $cat_starting_date,
										'order'                    => 'ASC',
										'taxonomy'                 => 'myclass_categories',
										'hide_empty'               => 0,
										'pad_counts'               => false,
										'suppress_filters' => true );
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
									
									$class_name = get_field( "class_name", $post_id );
									$cat_location = get_field( "location", $post_id );
									$cat_city = get_field( "city", $post_id );
									$cat_state = get_field( "state", $post_id );
									$program_fee = get_field( "program_fee", $post_id );
								?>
                    <tr class="tooltipover" id="<?php echo $i; ?>">
					
                        <td ><?php echo $date; ?>
						<div style="position:relative; float:left;">
						<div class="tooltip" id="tooltip<?php echo $i; ?>" ><?php echo "<b>Class</b> : ".$class_name."<br /> "."<b>Date</b> : ".$date."<br /> "."<b>Location</b> : ".$cat_location." ".$cat_city." ".$cat_state."<br /> "."<b>Program Fee</b> : ".$program_fee."<br /> "; ?> </div></div>
						</td>
                        <td><?php echo $cat_location; ?> </td>
                        <td><?php echo $cat_city.", ".$cat_state ?> </td>
                        <td><a href="<?php the_permalink(); ?>?p=registration&cat_id=<?php echo $cat_id;?>">Register for workshop</a></td>
                    </tr>
                     <?php $i++; }}
					 		wp_reset_query(); ?>
							
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="pagination pagination-centered"></div>
                        </td>
                    </tr>
                </tfoot>
         </table>
         <script>
$(document).ready(function(){
  $(".tooltipover").hover(function(){
	  	var hoverid = $(this).attr('id');
		$('#tooltip'+hoverid).show();
		
    },function(){
   		$('.tooltip').hide();
  });
});
</script>
         	<?php endif; ?>
            
             <?php
			/*----------Registration Condition Page-----------*/
			if($p=='registration'):
				$cat_id=$_REQUEST['cat_id'];
				$post_id = "myclass_categories_".$cat_id;
				$program_fee = get_field( "program_fee", $post_id );?>
                
                <div class="program_title">
                    <h1>Program Fee: $<?php echo $program_fee;?></h1>
                    <a href="#">PRINT TERMS</a>
                </div>
                <h4>The following terms and conditions apply to all registrants. By submiting the registration form on the following page, you are agreeing to these terms.</h4>
                <p>All registrants are required to agree to the following before registering for Step2CSReviewWorkshop.</p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                <div class="terms_section">
                    <div class="terms_box">
                        <p>By clicking below and submitting the registration form you are 
    agreeing to the above terms as written. </p>
                        <a href="<?php the_permalink(); ?>?p=reg_form&cat_id=<?php echo $cat_id;?>">i agree with the terms</a>
                        <a href="#">Cancel</a>
                    </div>
                </div>
         	<?php endif; ?>
            
            <?php
			/*----------Registration Form Page---------------*/
			if($p=='reg_form'): 
				$selected_cat_id=$_REQUEST['cat_id'];
				$selected_post_id = "myclass_categories_".$selected_cat_id;
				$program_fee = get_field( "program_fee", $selected_post_id );?>
            	
                <script src="<?php bloginfo('template_url'); ?>/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
                </script>
				<script src="<?php bloginfo('template_url'); ?>/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
				</script>
				<script>
					jQuery(document).ready( function() {
						// binds form submission and fields to the validation engine
						jQuery("#formID").validationEngine( {promptPosition : "inline", scroll: false});
					});
				</script>
                
                <h4> please enter the following information very carefully. Items with <span class="red">*</span> are required. </h4>
                <form method="post" action="" onsubmit="" id="formID">
                    <div class="date_selection">
                        <h5>Select date you wish to register for*:</h5>
                        
                        <select name="category_title" class="validate[required] text-input">
                            <option value="">--Select Date-----</option>
                        	<?php wp_reset_query();
							$args = array(
										'type'                     => 'myclass',
										'orderby'                  => 'name',
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
									$start_date=date('M d',strtotime($cat_starting_date));
									
									$cat_ending_date = get_field( "ending_date", $post_id );
									$end_date=date('M d',strtotime($cat_ending_date));
									
									$cat_location = get_field( "location", $post_id );
									$cat_city = get_field( "city", $post_id );
									$cat_state = get_field( "state", $post_id );
								?>
                            <option value="<?php echo $cat_id;?>" <?php if ($cat_id==$_REQUEST['cat_id']) { ?> selected="selected" <?php } ?> >
								<?php echo $start_date." - ".$end_date."  ".$cat_city." ".$cat_state; ?>
                            </option>
                            <?php $i++; }}
					 		?>
                        </select>
                        <p>We meet at the Holiday Inn in Hasbrouck Heights, NJ</p>
                    </div>
                    
                    <p><label>First name</label> <span class="red">*</span><input class="validate[required] text-input" type="text" name="txt_fname" value="" /></p>                                
                    
                    <p><label> Last name </label> <span class="red">*</span><input class="validate[required] text-input" type="text" name="txt_lname" value="" /></p>                              
                    
                    <p><label> Street </label> <span class="red">*</span><input type="text" class="validate[required] text-input" name="txt_street" value="" /></p>                              
                    
                    <p><label> Apt </label><input type="text" name="apt" value="" /></p>                          
                    
                    <p><label> City </label> <span class="red">*</span><input type="text" class="validate[required] text-input" name="student_city" value="" /></p>                             
                    
                    <p><label> State </label> <span class="red">*</span>
                    	<input type="text" name="student_state" value="" class="validate[required]" /></p>                             
                    
                    <p><label> Zip </label> <input type="text" name="zip" value="" /></p>                             
                    
                    <p><label> Country </label> <span class="red">*</span>
                    	<input type="text" name="student_country" value="" class="validate[required]" /></p>                             
                    
                    <p><label> E-Mail </label> <span class="red">*</span><input type="text" class="validate[required,custom[email]] text-input" name="student_email" value="" /></p>                             
                    
                    <p><label> Telephone </label> <span class="red">*</span><input type="text" class="validate[required]" name="student_telephone" value="" /></p> 
                     
                    <p><span class="form_gender">Gender</span>
                            <input type="radio" checked="checked" value="Male" id="gender_male" name="student_gender"><label for="gender_male">Male</label>
                            <input type="radio" checked="checked" value="Female" id="gender_female" name="student_gender"><label for="gender_female">Female</label></p>   
                     
                    <p><label> When are you taking the USMLE Step2CS test?</label><input type="text" name="test_time" value="" /></p>   
                     
                    <p><label> Number of USMLE Step2CS test attempts (previous): </label><input type="text" name="test_attempts" value="" /></p>   
                     
                    <p><label>Another Telephone </label> <span class="red">*</span><input type="text" name="student_telephone1"  class="validate[required]" value="" /></p>   
                     
                    <h6>Number of USMLE Step2CS test attempts (previous):<textarea name="attempts_detail" cols="50" rows="6"></textarea></h6>  
                     
                    <p> <label> How did you hear about Step2CS.com? </label>
                        <select name="how_connected">
                            <option value="">--Select -----</option>
                            <option value="Walk in/Drive by">Walk in/Drive by</option>
                            <option value="Internet">Internet?</option>
                            <option value="Advertisement">Advertisement</option>
                            <option value="Word of mouth">Word of mouth</option>
                            <option value="Phonebook">Phonebook</option>
                            <option value="Yellow pages">Yellow pages</option>
                            <option value="Referrals(PreviousCustomer)">Referrals (previous Customer)</option>
                            <option value="All Other(please state)">All other (please state)</option>
                        </select> </p> 
                    <p > <label> If other please indicate:</label><input type="text" name="other_connected" value="" /> </p>
                    
                    <div class="form_btn_submit">
                        <input type="reset" value="Clear Form" />
                        <input type="submit" value="Submit to Final Checkout" name="btn_submit_form" />
                    </div>
                    
                </form>
            
         	<?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>