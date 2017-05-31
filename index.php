<?php get_header();?>

<div id="content">
	<div class="wrapper">
    	<div class="blog-left">
               
        	<?php if (have_posts()) : ?>            
            	
            	<?php while (have_posts()) : the_post(); ?>
                    
                    <div class="post-box">
            
            			<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        
                        <p class="byline">Written by: <span><?php the_author_link(); ?></span> on <span><?php the_time(get_option('date_format')); ?></span></p>
                          
            			<?php the_excerpt(); ?>  
                        
                        <div class="post-meta">Posted in <?php the_category(',') ?> | <?php comments_popup_link(__('0 Comments'), __('1 Comment'), __('% Comments')); ?></div>
                    </div>
                          
            	<?php endwhile; ?>  
                
                	<div class="pager">
					<?php
                       
                        global $wp_query;
                
                        $big = 999999999; // need an unlikely integer
                        
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages
                        ) );
                         wp_reset_query();
                    ?>
                    </div>               
                 	<div class="clear"></div>
                    
            <?php else: ?>    
                    
				<div class="error"><?php _e('Not found.'); ?></div> 
                           
			<?php endif; ?>
               
            
        </div>
        <div class="content-right">        	
			<?php get_sidebar(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div><!-- EOF : content ID -->

<?php get_footer(); ?>