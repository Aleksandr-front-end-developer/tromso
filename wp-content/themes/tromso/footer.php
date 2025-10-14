<?php

/**
 * The template for displaying the footer
 */

?>


<footer id="contact" class="bg-deep-blue text-white pt-16 pb-8">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
			<div>
				<h3 class="text-2xl font-bold mb-4"><?php echo carbon_get_theme_option('column_1_title'); ?></h3>
        <div class="text-white/80 mb-4"><?php echo wpautop(carbon_get_theme_option('footer_description')); ?></div>
				<div class="flex gap-4">
					<?php
					$social = carbon_get_theme_option('social_links');
					if (is_array($social)) {
						foreach ($social as $item) {
					?>
					<a href="<?php echo $item['link']; ?>" target="_blank" rel="noopener noreferrer" class="hover:text-aurora-green transition-colors" aria-label="<?php echo $item['name']; ?>">
						<svg class="svg svg--stroke lucide lucide-<?php echo $item['icon_index']; ?>" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#'.$item['icon_index']; ?>"></use>
						</svg>
					</a>
					<?php
						}
					}
					?>
				</div>
			</div>
			<div>
				<h4 class="text-xl font-bold mb-4"><?php echo carbon_get_theme_option('column_2_title'); ?></h4>
				<div class="space-y-3 text-white/80">
					<div class="flex items-start gap-2">
						<svg class="svg svg--stroke lucide lucide-map-pin mt-1 flex-shrink-0" width="20" height="20">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#map-pin'; ?>"></use>
						</svg>
						<span><?php echo carbon_get_theme_option('column_2_address'); ?></span>
					</div>
					<div class="flex items-center gap-2">
						<svg class="svg svg--stroke lucide lucide-phone" width="20" height="20">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#phone'; ?>"></use>
						</svg>
            <?php
              $phone = carbon_get_theme_option('column_2_phone');
              $cleaned_phone = preg_replace('/[^\d\+]/', '', $phone);
            ?>
						<a href="tel:<?php echo $cleaned_phone; ?>" class="hover:text-aurora-green transition-colors"><?php echo $phone; ?></a>
					</div>
					<div class="flex items-center gap-2">
						<svg class="svg svg--stroke lucide lucide-mail" width="20" height="20">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#mail'; ?>"></use>
						</svg>
						<a href="mailto:<?php echo carbon_get_theme_option('column_2_email'); ?>" class="hover:text-aurora-green transition-colors"><?php echo carbon_get_theme_option('column_2_email'); ?></a>
					</div>
				</div>
			</div>
			<div>
				<h4 class="text-xl font-bold mb-4"><?php echo carbon_get_theme_option('column_3_title'); ?></h4>

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
				<h4 class="text-xl font-bold mb-4"><?php echo carbon_get_theme_option('column_4_title'); ?></h4>
				<?php echo do_shortcode(carbon_get_theme_option('column_4_contact_form')); ?>

			</div>
		</div>
		<div class="border-t border-white/20 pt-8 text-center text-white/60">
			<p><?php echo str_replace('%current_year%', date('Y'), carbon_get_theme_option('copyright_text')); ?></p>
		</div>
	</div>
</footer>


<?php wp_footer(); ?>