<?php
/**
 * Post single content
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php do_action( 'ocean_before_single_post_content' ); ?>

<div class="entry-content clr"<?php oceanwp_schema_markup( 'entry_content' ); ?>>

	
	<video width="640" height="360" controls>
    <source src="<?php the_field('video'); ?>" type="video/mp4">
    </video>   
    <br>
 
 
                 <div id="content" class="site-content clr">

				<?php do_action( 'ocean_before_content_inner' ); ?>
				 
                         <div class="tutorial-info-box"> 

                         
                            <b><p>Tutorial Level:</b> <?php  echo the_field('tutorial_level'); ?></p>
                            

                         </div> 
 
	<?php the_content();
    
       
    

	wp_link_pages( array(
		'before'      => '<div class="page-links">' . __( 'Pages:', 'oceanwp' ),
		'after'       => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after'  => '</span>',
	) ); ?>
</div><!-- .entry -->

<?php do_action( 'ocean_after_single_post_content' ); ?>