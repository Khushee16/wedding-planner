<?php
/**
 * Template Name: Enquiry
 * Enquiry page template. Validates the form, emails it to the site admin
 * via wp_mail(), and saves a copy as a private everafter_enquiry post.
 *
 * @package EverAfter
 */

get_header();

$sent   = false;
$errors = array();
$name   = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['everafter_enquiry_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['everafter_enquiry_nonce'] ), 'everafter_enquiry' ) ) {
    $name    = isset( $_POST['eq_name'] ) ? sanitize_text_field( wp_unslash( $_POST['eq_name'] ) ) : '';
    $contact = isset( $_POST['eq_contact'] ) ? sanitize_text_field( wp_unslash( $_POST['eq_contact'] ) ) : '';
    $type    = isset( $_POST['eq_type'] ) ? sanitize_text_field( wp_unslash( $_POST['eq_type'] ) ) : '';
    $date    = isset( $_POST['eq_date'] ) ? sanitize_text_field( wp_unslash( $_POST['eq_date'] ) ) : '';
    $guests  = isset( $_POST['eq_guests'] ) ? absint( $_POST['eq_guests'] ) : 0;
    $budget  = isset( $_POST['eq_budget'] ) ? sanitize_text_field( wp_unslash( $_POST['eq_budget'] ) ) : '';
    $notes   = isset( $_POST['eq_notes'] ) ? sanitize_textarea_field( wp_unslash( $_POST['eq_notes'] ) ) : '';

    if ( '' === $name ) {
        $errors[] = __( 'Please enter your name.', 'everafter' );
    }
    if ( '' === $contact ) {
        $errors[] = __( 'Please enter an email address or phone number.', 'everafter' );
    }
    if ( '' === $type ) {
        $errors[] = __( 'Please choose an event type.', 'everafter' );
    }

    if ( empty( $errors ) ) {
        $subject = sprintf( __( 'New enquiry from %s — EverAfter Events', 'everafter' ), $name );
        $message = sprintf(
            "Name: %s\nContact: %s\nEvent type: %s\nDate: %s\nGuests: %s\nBudget: %s\n\nDetails:\n%s",
            $name, $contact, $type, $date, $guests ? $guests : '—', $budget ? $budget : '—', $notes
        );
        wp_mail( get_option( 'admin_email' ), $subject, $message );

        wp_insert_post( array(
            'post_type'   => 'everafter_enquiry',
            'post_title'  => $name . ' — ' . $type . ' (' . current_time( 'Y-m-d' ) . ')',
            'post_content' => $message,
            'post_status' => 'private',
            'meta_input'  => array(
                'eq_contact' => $contact,
                'eq_date'    => $date,
                'eq_guests'  => $guests,
                'eq_budget'  => $budget,
            ),
        ) );

        $sent = true;
    }
}
?>

<main class="section">
  <div class="container" style="max-width:760px">
    <div class="text-center mb-4">
      <p class="eyebrow"><?php esc_html_e( 'Enquire', 'everafter' ); ?></p>
      <h1><?php the_title(); ?></h1>
      <p class="text-muted"><?php esc_html_e( 'A few details help us reply with honest, useful next steps.', 'everafter' ); ?></p>
    </div>

    <?php if ( $sent ) : ?>
      <div class="card p-4 p-md-5 text-center" role="status">
        <h2 class="h3"><?php printf( esc_html__( 'Thank you, %s!', 'everafter' ), esc_html( $name ) ); ?></h2>
        <p class="text-muted"><?php esc_html_e( 'Your enquiry has been sent. We will be in touch soon.', 'everafter' ); ?></p>
        <a class="btn btn-outline-gold" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'everafter' ); ?></a>
      </div>
    <?php else : ?>
      <?php if ( ! empty( $errors ) ) : ?>
        <div class="alert alert-danger" role="alert">
          <ul class="mb-0">
            <?php foreach ( $errors as $error ) : ?>
              <li><?php echo esc_html( $error ); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>

      <form method="post" action="<?php echo esc_url( get_permalink() ); ?>" class="card p-4 p-md-5">
        <?php wp_nonce_field( 'everafter_enquiry', 'everafter_enquiry_nonce' ); ?>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label" for="eq-name"><?php esc_html_e( 'Your name *', 'everafter' ); ?></label>
            <input class="form-control" id="eq-name" name="eq_name" required value="<?php echo esc_attr( $name ); ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="eq-contact"><?php esc_html_e( 'Email or phone *', 'everafter' ); ?></label>
            <input class="form-control" id="eq-contact" name="eq_contact" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="eq-type"><?php esc_html_e( 'Event type *', 'everafter' ); ?></label>
            <select class="form-select" id="eq-type" name="eq_type" required>
              <option value=""><?php esc_html_e( 'Choose…', 'everafter' ); ?></option>
              <option><?php esc_html_e( 'Wedding', 'everafter' ); ?></option>
              <option><?php esc_html_e( 'Engagement', 'everafter' ); ?></option>
              <option><?php esc_html_e( 'Reception', 'everafter' ); ?></option>
              <option><?php esc_html_e( 'Anniversary', 'everafter' ); ?></option>
              <option><?php esc_html_e( 'Other celebration', 'everafter' ); ?></option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="eq-date"><?php esc_html_e( 'Event date', 'everafter' ); ?></label>
            <input type="date" class="form-control" id="eq-date" name="eq_date">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="eq-guests"><?php esc_html_e( 'Number of guests', 'everafter' ); ?></label>
            <input type="number" min="1" max="2000" class="form-control" id="eq-guests" name="eq_guests" placeholder="e.g. 120">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="eq-budget"><?php esc_html_e( 'Budget range', 'everafter' ); ?></label>
            <select class="form-select" id="eq-budget" name="eq_budget">
              <option value=""><?php esc_html_e( 'Choose…', 'everafter' ); ?></option>
              <option><?php esc_html_e( 'Under $5,000', 'everafter' ); ?></option>
              <option><?php esc_html_e( '$5,000 – $10,000', 'everafter' ); ?></option>
              <option><?php esc_html_e( '$10,000 – $25,000', 'everafter' ); ?></option>
              <option><?php esc_html_e( '$25,000+', 'everafter' ); ?></option>
              <option><?php esc_html_e( 'Not sure yet', 'everafter' ); ?></option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label" for="eq-notes"><?php esc_html_e( 'Tell us more', 'everafter' ); ?></label>
            <textarea class="form-control" id="eq-notes" name="eq_notes" rows="4" placeholder="<?php esc_attr_e( 'Venue, style, anything that matters to you…', 'everafter' ); ?>"></textarea>
          </div>
          <div class="col-12"><button class="btn btn-gold w-100" type="submit"><?php esc_html_e( 'Send Enquiry', 'everafter' ); ?></button></div>
        </div>
      </form>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
