<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Legacy_Pro_Max
 */

if ( ! function_exists( 'legacy_pro_max_attorney_advertising_notice' ) ) :
	/**
	 * Displays the attorney advertising notice.
	 */
	function legacy_pro_max_attorney_advertising_notice() {
		$show_notice = get_theme_mod( 'legacy_pro_max_show_attorney_advertising_notice', true );
		$notice_text = get_theme_mod( 'legacy_pro_max_attorney_advertising_notice', __( 'Attorney Advertising. Prior results do not guarantee a similar outcome.', 'legacy-pro-max' ) );

		if ( $show_notice && ! empty( $notice_text ) ) {
			echo '<div class="attorney-advertising-notice">';
			echo wp_kses_post( $notice_text );
			echo '</div>';
		}
	}
endif;

if ( ! function_exists( 'legacy_pro_max_exit_intent_modal' ) ) :
	/**
	 * Displays the exit-intent modal.
	 */
	function legacy_pro_max_exit_intent_modal() {
		$enable_modal = get_theme_mod( 'legacy_pro_max_enable_exit_intent_modal', false );

		if ( ! $enable_modal ) {
			return;
		}

		$title       = get_theme_mod( 'legacy_pro_max_exit_intent_modal_title', __( 'Before You Go...', 'legacy-pro-max' ) );
		$content     = get_theme_mod( 'legacy_pro_max_exit_intent_modal_content', __( 'Have a question? We offer a free, no-obligation consultation.', 'legacy-pro-max' ) );
		$button_text = get_theme_mod( 'legacy_pro_max_exit_intent_modal_button_text', __( 'Request a Free Consultation', 'legacy-pro-max' ) );
		?>
		<div id="exit-intent-modal" class="exit-intent-modal">
			<div class="modal-content">
				<span class="close-modal">&times;</span>
				<h2><?php echo esc_html( $title ); ?></h2>
				<p><?php echo wp_kses_post( $content ); ?></p>
				<a href="#" class="btn"><?php echo esc_html( $button_text ); ?></a>
			</div>
		</div>
		<?php
	}
endif;
add_action( 'wp_footer', 'legacy_pro_max_exit_intent_modal' );

if ( ! function_exists( 'legacy_pro_max_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function legacy_pro_max_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'legacy-pro-max' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'legacy_pro_max_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function legacy_pro_max_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'legacy-pro-max' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'legacy_pro_max_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function legacy_pro_max_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'legacy-pro-max' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'legacy-pro-max' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'legacy-pro-max' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'legacy-pro-max' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'legacy-pro-max' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'legacy-pro-max' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'legacy_pro_max_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function legacy_pro_max_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;
