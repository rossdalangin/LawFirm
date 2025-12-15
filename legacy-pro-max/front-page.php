<?php
/**
 * The front page template file for Legacy Pro Max.
 *
 * This template displays the content of the page designated as the "Front Page"
 * in the WordPress Reading Settings. It uses the standard WordPress loop to
 * render content from the Block Editor, allowing for a flexible, user-editable
 * homepage.
 *
 * @package Legacy_Pro_Max
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php
    // Start the WordPress loop.
    while ( have_posts() ) :
        the_post();

        // Display the page content from the Block Editor.
        the_content();

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php get_footer();
