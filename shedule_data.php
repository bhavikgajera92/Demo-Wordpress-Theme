
                <h4>Upcoming Schedule</h4>
                <ul>
                <?php 	wp_reset_query();
							$cat_starting_date = get_field("starting_date");
							
							$args = array(
										'type'                     => 'myclass',
										'orderby'                  => $cat_starting_date,
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
									$cat_location = get_field( "location", $post_id );
									$cat_city = get_field( "city", $post_id );
									$cat_state = get_field( "state", $post_id );
								?>
                    <li><a href="<?php echo get_permalink('23');?>?p=reg_form&cat_id=<?php echo $cat_id;?>"><?php echo $date." :: ".$cat_city.", ".$cat_state; ?></a></li>
					<?php $i++; }}
					wp_reset_query(); ?>
                </ul>
                <a href="<?php echo get_permalink('23');?>">Click here for full schedule <span>&#8594;</span></a>