<?php
/**
 * The template for displaying register form.
 *
 * Override this template
 *
 * @author 		UserPress
 * @package 	UserPress/Templates
 * @version     1.0.0
 */
if (! defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}
?>

<div class="ct-user-form-body ct-user-form-register">
	<div class="register-form">
		<div class="fields-content">
			<div class="field-group">
				<input id="res_user" type="text" class="input" placeholder="<?php esc_html_e('Username', 'ct-user-form'); ?>" data-validate="<?php esc_html_e('Required Field', 'ct-user-form'); ?>" data-user-length="<?php esc_html_e('Username too short. At least 4 characters is required.', 'ct-user-form'); ?>" data-special-char="<?php esc_html_e("The value of text field can't contain any of the following characters: \ / : * ? \" < > space", 'ct-user-form'); ?>">
				<i class="zmdi zmdi-account"></i>
			</div>
			<div class="field-group">
				<input id="res_email" type="text" class="input" placeholder="<?php esc_html_e('Email Address', 'ct-user-form'); ?>" data-validate="<?php esc_html_e('Required Field', 'ct-user-form'); ?>"  data-email-format="<?php esc_html_e('The Email address is incorrect!', 'ct-user-form'); ?>">
				<i class="zmdi zmdi-email"></i>
			</div>
			<div class="field-group">
				<input id="res_pass1" type="password" class="input" data-type="password" placeholder="<?php esc_html_e('Password', 'ct-user-form'); ?>" data-validate="<?php esc_html_e('Required Field', 'ct-user-form'); ?>" data-pass-length="<?php esc_html_e( 'Password length must be greater than 5.', 'ct-user-form' ); ?>">
				<i class="zmdi zmdi-lock"></i>
			</div>
			<div class="field-group">
				<input id="res_pass2" type="password" class="input" data-type="password" placeholder="<?php esc_html_e('Confirm Password', 'ct-user-form'); ?>" data-validate="<?php esc_html_e('Required Field', 'ct-user-form'); ?>" data-pass-confirm="<?php esc_html_e('Your password and confirmation password do not match.', 'ct-user-form'); ?>">
				<i class="zmdi zmdi-lock"></i>
			</div>
			<div class="field-group">
				<button type="button" class="button btn-up-register"><?php esc_html_e('Create Account', 'ct-user-form');?></button>
			</div>
		</div>
	</div>
</div>