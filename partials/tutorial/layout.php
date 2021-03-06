<?php
/**
 * Single post layout
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>">

	<?php
	// Get posts format
	$format = get_post_format();

	// Get elements
	$elements = oceanwp_blog_single_elements_positioning();

	// Loop through elements
	foreach ( $elements as $element ) {

		
		// Title
		if ( 'title' == $element ) {

			get_template_part( 'partials/tutorial/header' );

		}

		// Meta
		if ( 'meta' == $element ) {

			get_template_part( 'partials/tutorial/meta' );

		}

		// Content
		if ( 'content' == $element ) {
            
            
            
			get_template_part( 'partials/tutorial/content' );

		}

		// Tags
		if ( 'tags' == $element ) {

			get_template_part( 'partials/tutorial/tags' );

		}

		// Social Share
		if ( 'social_share' == $element
			&& OCEAN_EXTRA_ACTIVE ) {

			do_action( 'ocean_social_share' );

		}

		// Next/Prev
		if ( 'next_prev' == $element ) {

			get_template_part( 'partials/tutorial/next-prev' );

		}

		// Author Box
		if ( 'author_box' == $element ) {

			get_template_part( 'partials/tutorial/author-bio' );

		}

		// Related Posts
		if ( 'related_posts' == $element ) {

			get_template_part( 'partials/tutorial/related-posts' );

		}

		// Comments
		if ( 'single_comments' == $element ) {

			comments_template();

		}

	} ?>

</article>