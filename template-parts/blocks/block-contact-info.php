<?php
/**
 * Template part for displaying "Contacts Info" block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brightech
 */

?>

<?php  
	$address = get_option('bt_contact_address');

	$contact_phone = get_option('bt_contact_phone');
	$phone_link = ( is_array($contact_phone) && $contact_phone["link"] ) ? $contact_phone["link"] : '';
	$phone_text = ( is_array($contact_phone) && $contact_phone["text"] ) ? $contact_phone["text"] : $phone_link;
	
	$support_info = get_option('bt_support_info');

	$support_phone = get_option('bt_support_phone');
	$support_phone_link = ( is_array($support_phone) && $support_phone["link"] ) ? $support_phone["link"] : '';
	$support_phone_text = ( is_array($support_phone) && $support_phone["text"] ) ? $support_phone["text"] : $support_phone_link;

	$contact_email = get_option('bt_contact_email');
	$contact_email_link = ( is_array($contact_email) && $contact_email["email"] ) ? $contact_email["email"] : '';
	$contact_email_text = ( is_array($contact_email) && $contact_email["text"] ) ? $contact_email["text"] : $contact_email_link;

	$contact_message = get_option('bt_contact_message');
	$contact_message_link = ( is_array($contact_message) && $contact_message["link"] ) ? $contact_message["link"] : '';
	$contact_message_text = ( is_array($contact_message) && $contact_message["text"] ) ? $contact_message["text"] : $contact_message_link;

	$contact_form = get_option('bt_contact_form');
	$contact_form_link = ( is_array($contact_form) && $contact_form["link"] ) ? $contact_form["link"] : '';
	$contact_form_text = ( is_array($contact_form) && $contact_form["text"] ) ? $contact_form["text"] : $contact_form_link;
?>

<section class="page-block page-block--contact-info">
	<div class="block-contact-info">
		<div class="site__width">
			<div class="cols cols--v-gut-30">
				
				<!-- column: Main Info -->
				<div class="cols__col cols__col--v-gut-30 cols__col--md-1-2">
					<div class="block-contact-info__main">
						<h2 class="block-contact-info__title"><?php _e("GMS Headquarters", "brightech") ?></h2>
						<div class="cols cols--v-gut-30">
							
							<!-- column: Address -->
							<div class="cols__col cols__col--v-gut-30 cols__col--md-1-2">
								
								<!-- address -->
								<?php if ($address): ?>
									<p>
										<?php foreach (explode( "\n", $address) as $key => $value): ?>
											<?php echo $key != 0 ? "<br>$value" : $value ?>
										<?php endforeach ?>
									</p>
								<?php endif; ?>

								<!-- phone -->
								<?php if ($phone_text): ?>
									<p class="text-phone h3 pt-35">
										<?php echo wp_sprintf('%2$s %1$s %3$s', 
											$phone_text,
											$phone_link ? "<a href=\"tel:$phone_link\">" : "",
											$phone_link ? "</a>" : ""
										) ?>
									</p>
								<?php endif ?>
							</div>

							<!-- column: Links -->
							<div class="cols__col cols__col--v-gut-30 cols__col--md-1-2">
								<dl>
									<?php if ($contact_email_text): ?>
										<dt><?php echo $contact_email['title'] ?: __('Email', 'brightech') ?></dt>
										<dd>
											<?php echo wp_sprintf('%2$s %1$s %3$s', 
												$contact_email_text,
												$contact_email_link ? "<a href=\"mailto:$contact_email_link\">" : "",
												$contact_email_link ? "</a>" : ""
											) ?>
										</dd>
									<?php endif ?>

									<?php if ($contact_message_text): ?>
										<dt><?php echo $contact_message['title'] ?: __('Send message', 'brightech') ?></dt>
										<dd>
											<?php echo wp_sprintf('%2$s %1$s %3$s', 
												$contact_message_text,
												$contact_message_link ? "<a href=\"$contact_message_link\">" : "",
												$contact_message_link ? "</a>" : ""
											) ?>
										</dd>
									<?php endif ?>

									<?php if ($contact_form_text): ?>
										<dt><?php echo $contact_form['title'] ?: __('Send form', 'brightech') ?></dt>
										<dd>
											<?php echo wp_sprintf('%2$s %1$s %3$s', 
												$contact_form_text,
												$contact_form_link ? "<a href=\"$contact_form_link\">" : "",
												$contact_form_link ? "</a>" : ""
											) ?>
										</dd>
									<?php endif ?>
								</dl>
							</div>
						</div>
					</div>
				</div>

				<!-- column: About -->
				<div class="cols__col cols__col--v-gut-30 cols__col--md-1-2">
					<div class="block-contact-info__support">
						<h2 class="block-contact-info__title"><?php _e("Technical support 24/7", "brightech") ?></h2>
						
						<?php if ($support_info): ?>
							<p>
								<?php foreach (explode( "\n", $support_info) as $key => $value): ?>
									<?php echo $key != 0 ? "<br>$value" : $value ?>
								<?php endforeach ?>
							</p>
						<?php endif; ?>

						<!-- phone -->
						<?php if ($support_phone_text): ?>
							<p class="text-phone h3 pt-35">
								<?php echo wp_sprintf('%2$s %1$s %3$s', 
									$support_phone_text,
									$support_phone_link ? "<a href=\"tel:$support_phone_link\">" : "",
									$support_phone_link ? "</a>" : ""
								) ?>
							</p>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>