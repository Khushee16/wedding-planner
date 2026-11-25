<?php
/**
 * Site header.
 *
 * @package EverAfter
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <?php if ( has_custom_logo() ) { the_custom_logo(); } else { echo 'EverAfter <span style="color:#b08d57">Events</span>'; } ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'everafter' ); ?>"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <?php
      wp_nav_menu( array(
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'navbar-nav ms-auto align-items-lg-center',
          'fallback_cb'    => 'everafter_fallback_menu',
      ) );
      ?>
      <a class="btn btn-gold btn-sm ms-lg-3" href="<?php echo esc_url( get_permalink( get_page_by_path( 'enquiry' ) ) ); ?>"><?php esc_html_e( 'Enquire', 'everafter' ); ?></a>
    </div>
  </div>
</nav>
