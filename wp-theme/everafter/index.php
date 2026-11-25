<?php
/**
 * Fallback template: blog / archive loop.
 *
 * @package EverAfter
 */

get_header();
?>

<main class="section">
  <div class="container">
    <h1 class="mb-4"><?php esc_html_e( 'Journal', 'everafter' ); ?></h1>
    <?php if ( have_posts() ) : ?>
      <div class="row g-4">
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="col-md-6 col-lg-4">
            <div class="card h-100">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'card-img-top', 'style' => 'height:220px;object-fit:cover' ) ); ?></a>
              <?php endif; ?>
              <div class="card-body">
                <h2 class="h5"><a class="text-decoration-none text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="text-muted small"><?php echo esc_html( get_the_date() ); ?></p>
                <?php the_excerpt(); ?>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
      <div class="mt-4"><?php the_posts_pagination(); ?></div>
    <?php else : ?>
      <p class="text-muted"><?php esc_html_e( 'Nothing here yet.', 'everafter' ); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
