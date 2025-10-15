<?php

/**
 * Template Name: Contact Верстка
 *
 * Front page php tempate
 */

get_header();
?>
<main id="main" class="main">

	<?php get_template_part('template-parts/page', 'hero');	  ?>



	<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<div class="grid md:grid-cols-2 gap-12">
			<div>
				<h2 class="text-3xl font-bold text-gray-900 mb-6">Get In Touch</h2>
				<p class="text-gray-600 mb-8 leading-relaxed">
					Whether you have questions about our tours, need help planning your Arctic adventure, or just want to say hello, we'd love to hear from you.
				</p>
				<div class="space-y-6">
					<div class="flex items-start gap-4">
						<div class="bg-ice-blue w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0">

							<svg class="svg svg--stroke lucide lucide-mail text-white" width="24" height="24">
								<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#mail'; ?>"></use>
							</svg>

						</div>
						<div>
							<h3 class="font-bold text-gray-900 mb-1">Email</h3>
							<a href="mailto:info@tromsonorwaytours.com" class="text-ice-blue hover:text-deep-blue transition-colors">info@tromsonorwaytours.com</a>
						</div>
					</div>
					<div class="flex items-start gap-4">
						<div class="bg-aurora-green w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
							<svg class="svg svg--stroke lucide lucide-phone text-white" width="24" height="24">
								<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#phone'; ?>"></use>
							</svg>

						</div>
						<div>
							<h3 class="font-bold text-gray-900 mb-1">Phone</h3>
							<a href="tel:+4712345678" class="text-ice-blue hover:text-deep-blue transition-colors">+47 123 45 678</a>
							<p class="text-sm text-gray-500 mt-1">Mon-Fri 9:00 AM - 6:00 PM CET</p>
						</div>
					</div>
					<div class="flex items-start gap-4">
						<div class="bg-deep-blue w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
							<svg class="svg svg--stroke lucide lucide-map-pin text-white" width="24" height="24">
								<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#map-pin'; ?>"></use>
							</svg>

						</div>
						<div>
							<h3 class="font-bold text-gray-900 mb-1">Office</h3>
							<p class="text-gray-600">Tromsø, Norway</p>
						</div>
					</div>
				</div>
				<div class="mt-8 p-6 bg-ice-blue/10 rounded-xl border border-ice-blue/20">
					<h3 class="font-bold text-gray-900 mb-2">Business Hours</h3>
					<div class="space-y-1 text-gray-600">
						<p>Monday - Friday: 9:00 AM - 6:00 PM</p>
						<p>Saturday: 10:00 AM - 4:00 PM</p>
						<p>Sunday: Closed</p>
					</div>
				</div>
			</div>
			<div>
				<div class="bg-white rounded-xl shadow-lg p-8">
					<h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h2>
					<?php echo do_shortcode('[contact-form-7 id=b5cd96e title=Contact html_class=form html_class=space-y-4]'); ?>

				</div>
			</div>
		</div>
	</div>



</main>
<?php
get_footer();
?>