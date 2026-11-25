<?php
/**
 * Template Name: Packages
 * Packages page template. Package content is edited as page content
 * in the editor (see README-WORDPRESS.md) — no custom post type needed.
 *
 * @package EverAfter
 */

get_header();
?>

<main class="section">
  <div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="text-center mb-5">
        <p class="eyebrow"><?php esc_html_e( 'Packages & Pricing', 'everafter' ); ?></p>
        <h1><?php the_title(); ?></h1>
      </div>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <p class="text-center text-muted mt-4 small"><?php esc_html_e( 'All packages are customised after a consultation. Prices shown are fictional demo figures for this portfolio piece.', 'everafter' ); ?></p>
    <?php endwhile; endif; ?>
    <div class="text-center mt-4">
      <?php $enquiry = get_page_by_path( 'enquiry' ); ?>
      <?php if ( $enquiry ) : ?>
        <a class="btn btn-gold" href="<?php echo esc_url( get_permalink( $enquiry ) ); ?>"><?php esc_html_e( 'Start an Enquiry', 'everafter' ); ?></a>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php
get_footer();
