<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/**
 * Hook: colormag_before_body_content.
 */
do_action( 'colormag_before_body_content' );
?>
	<?php colormag_two_sidebar_select(); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<h1 class="page-title">
						<span>
							<?php
							printf(
								/* Translators: %s: Search query. */
								esc_html__( 'Search Results for: %s', 'colormag' ),
								get_search_query()
							);
							?>
						</span>
					</h1>
				</header><!-- .page-header -->

				<?php
				/**
				 * Hook: colormag_before_search_results_page_loop.
				 */
				do_action( 'colormag_before_search_results_page_loop' );
				?>

				<?php
				$pagination_type  = get_theme_mod( 'colormag_post_pagination', 'default' );
				$pagination_class = '';

				if ( 'infinite_scroll' === $pagination_type ) {
					$pagination_class .= 'tg-infinite-scroll-container';
				}
				?>

				<div class="article-container <?php echo esc_attr( $pagination_class ); ?>">
					<?php
					while ( have_posts() ) :
						the_post();

						/**
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'content', 'archive' );
					endwhile;
					?>
				</div>

				<?php
				/**
				 * Hook: colormag_after_archive_page_loop.
				 */
				do_action( 'colormag_after_search_results_page_loop' );

				colormag_pagination();

			else :
				if ( true === apply_filters( 'colormag_search_results_page_no_results_filter', true ) ) {
					get_template_part( 'no-results', 'archive' );
				}
			endif;
			?>
		</div><!-- #content -->

		<?php colormag_infinite_scroll(); ?>
	</div><!-- #primary -->

<?php
colormag_sidebar_select();

/**
 * Hook: colormag_after_body_content.
 */
do_action( 'colormag_after_body_content' );

get_footer();
