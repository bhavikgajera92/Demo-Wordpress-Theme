<?php
/*banner Meta Box*/
add_action("admin_init", "student_detail");

function student_detail(){
 	add_meta_box("student_detail_id", "Student Detail", "student_detail_out", "myclass", "side", "high");	
} 

function student_detail_out(){
 	global $post,$wpdb;
	
	$txt_fname = get_post_meta($post->ID, 'txt_fname', true);
	$txt_lname = get_post_meta($post->ID, 'txt_lname', true);
	$txt_street = get_post_meta($post->ID, 'txt_street', true);
	$apt = get_post_meta($post->ID, 'apt', true);
	$student_city = get_post_meta($post->ID, 'student_city', true);
	$student_state = get_post_meta($post->ID, 'student_state', true);
	$zip = get_post_meta($post->ID, 'zip', true);
	$student_country = get_post_meta($post->ID, 'student_country', true);
	$student_email = get_post_meta($post->ID, 'student_email', true);
	$student_telephone = get_post_meta($post->ID, 'student_telephone', true);
	$student_gender = get_post_meta($post->ID, 'student_gender', true);
	$test_time = get_post_meta($post->ID, 'test_time', true);
	$test_attempts = get_post_meta($post->ID, 'test_attempts', true);
	$student_telephone1 = get_post_meta($post->ID, 'student_telephone1', true);
	$attempts_detail = get_post_meta($post->ID, 'attempts_detail', true);
	$how_connected = get_post_meta($post->ID, 'how_connected', true);
	$other_connected = get_post_meta($post->ID, 'other_connected', true);
	$program_fee = get_post_meta($post->ID, 'program_fee', true);
	$payment_status = get_post_meta($post->ID, 'payment_status', true);
	$trans_id = get_post_meta($post->ID, 'trans_id', true);
	
	
?>
	<style type="text/css">
		.fulldiv, .fulldiv input[type='text'], .myinputes , textarea 
		{
			width:100%;
		}
		.fulldiv input[type='button']
		{
			margin-top:5px;
		}
		.fulldiv input[type='radio']
		{
			margin:2px 0 0 2px;
		}
		.fulldiv input[type='text']
		{
			margin-top:5px;
		}
	</style>
    	<p>
            <div class="fulldiv">
                  <div class="myinputes">
                        <table class="repatertab" width="100%">
                            <tr>
                                <td><label>First name</label>
                                     <input type="text" value="<?php echo $txt_fname; ?>" name="txt_fname" /></td>
                                <td><label>last name</label>
                                     <input type="text" value="<?php echo $txt_lname; ?>" name="txt_lname" /></td>
                            </tr>
                            <tr>
                                <td><label>Street</label>
                                     <input type="text" value="<?php echo $txt_street; ?>" name="txt_street" /></td>
                                <td><label>Apt</label>
                                     <input type="text" value="<?php echo $apt; ?>" name="apt" /></td>
                            </tr>
                            <tr>
                                <td><label>City</label>
                                     <input type="text" value="<?php echo $student_city; ?>" name="student_city" /></td>
                                <td><label>State</label>
                                     <input type="text" value="<?php echo $student_state; ?>" name="student_state" /></td>
                            </tr>
                            <tr>
                                <td><label>Zip</label>
                                     <input type="text" value="<?php echo $zip; ?>" name="zip" /></td>
                                <td><label>Country</label>
                                     <input type="text" value="<?php echo $student_country; ?>" name="student_country" /></td>
                            </tr>
                            <tr>
                                <td><label>E-Mail </label>
                                     <input type="text" value="<?php echo $student_email; ?>" name="student_email" /></td>
                                <td><label>Telephone</label>
                                     <input type="text" value="<?php echo $student_telephone; ?>" name="student_telephone" /></td>
                            </tr>
                            <tr>
                                <td><label>Gender</label>
                                     <input type="radio" <?php if($student_gender=='Male'){ ?> checked="checked" <?php } ?> value="Male" id="gender_male" name="student_gender">
                                     <label for="gender_male">Male</label>
                            		 <input type="radio" <?php if($student_gender=='Female'){ ?> checked="checked" <?php } ?> value="Female" id="gender_female" name="student_gender">
                                     <label for="gender_female">Female</label></td>
                                <td><label>When are you taking the USMLE Step2CS test?</label>
                                     <input type="text" value="<?php echo $test_time; ?>" name="test_time" /></td>
                            </tr>
                            <tr>
                                <td><label> Number of USMLE Step2CS test attempts (previous):</label>
                                     <input type="text" value="<?php echo $test_attempts; ?>" name="test_attempts" /></td>
                                <td><label>Another Telephone</label>
                                     <input type="text" value="<?php echo $student_telephone1; ?>" name="student_telephone1" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><label>Detail of USMLE Step2CS test attempts (previous):</label>
                                				<textarea cols="50" rows="6" name="attempts_detail">
													<?php echo $attempts_detail;?>
                                                </textarea></td>
                            </tr>
                            <tr>
                                <td><label>How did you hear about Step2CS.com?</label>
                                     <input type="text" value="<?php echo $how_connected; ?>" name="how_connected" /></td>
                                <td><label> If other please indicate:</label><input type="text" name="other_connected" value="<?php echo $other_connected; ?>" /></td>
                            </tr>
                            <tr>
                                <td><label>Program Fee:</label>
                                     <input type="text" value="<?php echo $program_fee; ?>" name="program_fee" /></td>
                                <td><label> Payment Status: </label><input type="text" name="payment_status" value="<?php echo $payment_status; ?>" /></td>
                            </tr>
                            <tr>
                                <td><label>Transaction ID</label>
                                     <input type="text" value="<?php echo $trans_id; ?>" name="trans_id" /></td>
                            </tr>
                        
                        </table>                 
                  </div> 
            </div>         
	</p> 
<?php
}
add_action('save_post', 'student_detail_save');
function student_detail_save()
{
	global $post,$wpdb;
	if ($post->post_type == 'myclass') 
	{  	
		update_post_meta($post->ID, 'student_detail_val', '');
		update_post_meta($post->ID, 'txt_fname', $_POST['txt_fname']);
		update_post_meta($post->ID, 'txt_lname',$_POST['txt_lname']);
		update_post_meta($post->ID, 'txt_street',$_POST['txt_street']);
		update_post_meta($post->ID, 'apt', $_POST['apt']);
		update_post_meta($post->ID, 'student_city', $_POST['student_city']);		
		update_post_meta($post->ID, 'student_state',$_POST['student_state']);
		update_post_meta($post->ID, 'zip', $_POST['zip']);
		update_post_meta($post->ID, 'student_country', $_POST['student_country']);
		update_post_meta($post->ID, 'student_email',$_POST['student_email']);
		update_post_meta($post->ID, 'student_telephone',$_POST['student_telephone']);
		update_post_meta($post->ID, 'student_gender',$_POST['student_gender']);
		update_post_meta($post->ID, 'test_time',$_POST['test_time']);
		update_post_meta($post->ID, 'test_attempts', $_POST['test_attempts']);
		update_post_meta($post->ID, 'student_telephone1',$_POST['student_telephone1']);
		update_post_meta($post->ID, 'attempts_detail', $_POST['attempts_detail']);
		update_post_meta($post->ID, 'how_connected',$_POST['how_connected']);
		update_post_meta($post->ID, 'other_connected', $_POST['other_connected']);
		update_post_meta($post->ID, 'program_fee', $_POST['program_fee']);
		update_post_meta($post->ID, 'payment_status', $_POST['payment_status']);
		update_post_meta($post->ID, 'trans_id', $_POST['trans_id']);
	} 
}
/*end of banner Meta Box*/
?>