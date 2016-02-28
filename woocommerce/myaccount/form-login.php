<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php
// If resistration is enabled, we shoudl have a 2-column login-registration form
	if (get_option('woocommerce_enable_myaccount_registration')=='yes') {
		$content_class = 'seven columns';
	} else{
		$content_class = 'twelve columns';
	}

?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) { ?>

<div class="row">
	<div class="woo-myaccount <?php echo $content_class; ?>" id="customer_login">

		<div class="myaccount-login">

			<?php } ?>

			<div class="woo-myaccount">

				<h2><?php _e( "I'm a returning customer", 'woocommerce' ); ?></h2>

				<form method="post" class="login">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<p class="form-row form-row-wide">
						<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>
					<p class="form-row form-row-wide">
						<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input class="input-text" type="password" name="password" id="password" />
					</p>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<p class="form-row">
						<label>&nbsp;</label>
						<?php wp_nonce_field( 'woocommerce-login' ); ?>
						<input type="submit" class="button blue" name="login" value="<?php _e( 'Sign me in', 'woocommerce' ); ?>" />
						<a class="lost_password" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
					</p>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>
			</div>

			<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) { ?>

		</div>

		<div class="myaccount-register">

			<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

			<form method="post" class="register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) { ?>

					<p class="form-row form-row-wide">
						<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>

				<?php } ?>

				<p class="form-row form-row-wide">
					<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) { ?>
		
					<p class="form-row form-row-wide">
						<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="password" class="input-text" name="password" id="reg_password" />
					</p>

				<?php } ?>

				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-register' ); ?>
					<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
		</div>

	</div>

	<div class="five columns woo-myaccount">
		<div class="myaccount-separator">
			<div class="login-line"></div>
			<div class="login-or">OR</div>
		</div>
		<ul class="account-toggler">
			<li class="account-toggle-register">
				<div class="account-toggler-wrapper">
					<h3><?php _e( "I'm a new customer", 'woocommerce' ); ?></h3>
						<?php if(strlen(options::get_value( 'general' , 'new_customer' ))) { echo '<p>'. options::get_value( 'general' , 'new_customer' ) .'</p>'; } ?>
					<a href="#" class="customer-login button">Register me</a>
				</div>
			</li>
			<li class="account-toggle-login">
				<div class="account-toggler-wrapper">
					<h3><?php _e( "I'm a returning customer", 'woocommerce' ); ?></h3>
						<?php if(strlen(options::get_value( 'general' , 'returning_customer' ))) { echo '<p>'. options::get_value( 'general' , 'returning_customer' ) .'</p>'; } ?>
					<a href="#" class="customer-register button">Sign me in</a>
				</div>
			</li>
		</ul>
	</div>

<?php } ?>
</div>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
