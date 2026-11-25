<?php
/**
 * Site footer.
 *
 * @package EverAfter
 */
?>
<footer class="site-footer py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h3 class="serif h4 text-white">EverAfter Events</h3>
        <p class="small mb-0"><?php esc_html_e( 'A fictional wedding & event planning studio created as a self-directed portfolio project. Not a real business.', 'everafter' ); ?></p>
      </div>
      <div class="col-md-3">
        <h4 class="h6 text-white"><?php esc_html_e( 'Explore', 'everafter' ); ?></h4>
        <?php
        wp_nav_menu( array(
            'theme_location' => 'footer',
            'container'      => false,
            'menu_class'     => 'list-unstyled small',
            'fallback_cb'    => false,
        ) );
        ?>
      </div>
      <div class="col-md-3">
        <h4 class="h6 text-white"><?php esc_html_e( 'Visit', 'everafter' ); ?></h4>
        <p class="small mb-0"><?php esc_html_e( 'Glassboro, New Jersey', 'everafter' ); ?><br>hello@everafter-events.example</p>
      </div>
    </div>
    <hr style="border-color:rgba(233,220,195,.25)">
    <p class="small mb-0 text-center">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> EverAfter Events — <?php esc_html_e( 'fictional demo site. Portfolio piece by Khushi Khatri.', 'everafter' ); ?></p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
