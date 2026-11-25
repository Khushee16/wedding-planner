<?php
/**
 * Template Name: Home
 * Home page template.
 *
 * @package EverAfter
 */

get_header();
?>

<header class="hero">
  <div class="container">
    <p class="eyebrow text-white-50"><?php esc_html_e( 'Wedding & Event Planning', 'everafter' ); ?></p>
    <h1><?php esc_html_e( 'Your day, beautifully thought through.', 'everafter' ); ?></h1>
    <p class="lead mx-auto my-4" style="max-width:560px"><?php esc_html_e( 'EverAfter Events plans weddings and celebrations with calm, considered design — from the first mood board to the last dance.', 'everafter' ); ?></p>
    <?php $packages = get_page_by_path( 'packages' ); ?>
    <?php if ( $packages ) : ?>
      <a class="btn btn-gold me-2" href="<?php echo esc_url( get_permalink( $packages ) ); ?>"><?php esc_html_e( 'View Packages', 'everafter' ); ?></a>
    <?php endif; ?>
    <?php $gallery = get_page_by_path( 'gallery' ); ?>
    <?php if ( $gallery ) : ?>
      <a class="btn btn-outline-light rounded-pill px-4 py-2" href="<?php echo esc_url( get_permalink( $gallery ) ); ?>"><?php esc_html_e( 'See the Gallery', 'everafter' ); ?></a>
    <?php endif; ?>
  </div>
</header>

<section class="section">
  <div class="container">
    <div class="text-center mb-5"><p class="eyebrow"><?php esc_html_e( 'How we work', 'everafter' ); ?></p><h2><?php esc_html_e( 'Three steps to a day that feels like you', 'everafter' ); ?></h2></div>
    <div class="row g-4">
      <div class="col-md-4"><div class="card h-100 p-4 text-center"><h3 class="h4"><?php esc_html_e( '01 · Listen', 'everafter' ); ?></h3><p class="text-muted"><?php esc_html_e( 'A relaxed first conversation about your story, your people, and the feeling you want the day to have.', 'everafter' ); ?></p></div></div>
      <div class="col-md-4"><div class="card h-100 p-4 text-center"><h3 class="h4"><?php esc_html_e( '02 · Design', 'everafter' ); ?></h3><p class="text-muted"><?php esc_html_e( 'A single, cohesive design — palette, florals, light, music — planned around your venue and your budget.', 'everafter' ); ?></p></div></div>
      <div class="col-md-4"><div class="card h-100 p-4 text-center"><h3 class="h4"><?php esc_html_e( '03 · Deliver', 'everafter' ); ?></h3><p class="text-muted"><?php esc_html_e( 'Our team runs the day quietly in the background, so you can be fully present with the people you love.', 'everafter' ); ?></p></div></div>
    </div>
  </div>
</section>

<section class="section" style="background:var(--blush)">
  <div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="row align-items-center g-5">
        <div class="col-lg-6"><img class="img-fluid rounded-4 shadow" src="https://picsum.photos/seed/everafter-table/1000/700" alt="<?php esc_attr_e( 'A styled wedding reception table', 'everafter' ); ?>"></div>
        <div class="col-lg-6">
          <p class="eyebrow"><?php esc_html_e( 'The studio', 'everafter' ); ?></p>
          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; endif; ?>
  </div>
</section>

<?php
get_footer();
