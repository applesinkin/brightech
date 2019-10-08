<?php
/**
 * Template part for displaying "Contact Contact" block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brightech
 */

?>

<div class="page-block page-block--contact-form" id="contact-form">
	<div class="block-contact-form">
		<div class="site__width">
			<h2 class="page-block__title page-block__title--contact-form">Contact Us</h2>
			<div class="cols cols--v-gut-30">
				<div class="cols__col cols__col--v-gut-30 cols__col--md-1-2">
					<div class="block-contact-form__form">
						<form action="" method="POST" id="contact_form" name="contact_form" class="form">
							<div class="form__field">
								<label class="form__label" for="your_name"><?php _e("Name", "brightech") ?></label>
								<input type="text" name="your_name" id="your_name" class="form__input" placeholder="<?php _e("Name", "brightech") ?>" />
							</div>
							<div class="form__field">
								<label class="form__label" for="your_tel"><?php _e("Phone", "brightech") ?></label>
								<input type="tel" name="your_tel" id="your_tel" class="form__input" placeholder="<?php _e("Phone", "brightech") ?>" />
							</div>
							<div class="form__field">
								<label class="form__label" for="your_email"><?php _e("Email", "brightech") ?></label>
								<input type="email" name="your_email" id="your_email" class="form__input" placeholder="<?php _e("Email", "brightech") ?>" />
							</div>
							<div class="form__agree">
								<label class="form__checkbox-label">
									<input type="checkbox" name="form_agree" id="form_agree" class="form__checkbox" />
									<span class="form__checkmark"></span>
									<span><?php _e("I agree the processing of personal data", "brighteck"); ?></span>
								</label>
							</div>
							<div class="form__btn">
								<button class="btn btn--submit js-submit"><?php _e("Get in touch", "brighteck") ?></button>
							</div>
						</form>
					</div>
				</div>
				<div class="cols__col cols__col--v-gut-30 cols__col--md-1-2">
					<div class="block-contact-form__desc">
						<p class="color-dark"><?php _e("Please tell us more about your request and give us info about your company and country", "brighteck"); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>