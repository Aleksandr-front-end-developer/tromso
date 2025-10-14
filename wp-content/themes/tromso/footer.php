<?php

/**
 * The template for displaying the footer
 */

?>


<footer id="contact" class="bg-deep-blue text-white pt-16 pb-8">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
			<div>
				<h3 class="text-2xl font-bold mb-4">Tromsø Norway Tours</h3>
				<p class="text-white/80 mb-4">Your gateway to Arctic adventures and unforgettable experiences in Tromsø, Norway.</p>
				<div class="flex gap-4">
					<a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="hover:text-aurora-green transition-colors" aria-label="YouTube">
						<svg class="svg svg--stroke lucide lucide-youtube" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#youtube'; ?>"></use>
						</svg>
					</a>
					<a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="hover:text-aurora-green transition-colors" aria-label="TikTok">
						<svg class="svg svg--stroke lucide lucide-music-2" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#music-2'; ?>"></use>
						</svg>
					</a>
				</div>
			</div>
			<div>
				<h4 class="text-xl font-bold mb-4">Contact</h4>
				<div class="space-y-3 text-white/80">
					<div class="flex items-start gap-2">
						<svg class="svg svg--stroke lucide lucide-map-pin mt-1 flex-shrink-0" width="20" height="20">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#map-pin'; ?>"></use>
						</svg>
						<span>Tromsø, Norway</span>
					</div>
					<div class="flex items-center gap-2">
						<svg class="svg svg--stroke lucide lucide-phone" width="20" height="20">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#phone'; ?>"></use>
						</svg>
						<a href="tel:+4712345678" class="hover:text-aurora-green transition-colors">+47 123 45 678</a>
					</div>
					<div class="flex items-center gap-2">
						<svg class="svg svg--stroke lucide lucide-mail" width="20" height="20">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#mail'; ?>"></use>
						</svg>
						<a href="mailto:info@tromsonorwaytours.com" class="hover:text-aurora-green transition-colors">info@tromsonorwaytours.com</a>
					</div>
				</div>
			</div>
			<div>
				<h4 class="text-xl font-bold mb-4">Quick Links</h4>

				<?php
				wp_nav_menu([
					'theme_location'  => 'menu_footer',
					'container'       => '',
					'container_class' => '',
					'menu_class'      => 'space-y-2 text-white/80', //  <ul>, 
					'walker'          => new Tailwind_Walker_Nav_Menu()
				]);
				?>

			</div>
			<div>
				<h4 class="text-xl font-bold mb-4">Get Arctic Adventure Updates</h4>
				<?php echo do_shortcode('[contact-form-7 id=6ee1167 title=Subscribe html_class=form html_class=space-y-3]'); ?>

			</div>
		</div>
		<div class="border-t border-white/20 pt-8 text-center text-white/60">
			<p>© <?php echo date('Y'); ?> Tromsø Norway Tours. All rights reserved.
			</p>
		</div>
	</div>
</footer>


<?php wp_footer(); ?>