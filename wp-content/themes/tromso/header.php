<?php

/**
 * The header for our theme
 */

?>


<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div class="wrapper min-h-screen">

		<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="flex justify-between items-center h-20">
					<div class=" flex items-center gap-2 text-white font-bold text-xl hover:text-aurora-green transition-colors">
						<?php the_custom_logo(); ?>
					</div>
					<nav class="hidden md:flex items-center gap-8">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'menu_header',
							'walker' => new Custom_Nav_Walker(),
							'container' => false,
							'items_wrap' => '%3$s',
							'fallback_cb' => false
						));
						?>
					</nav>
					<button class="mobile-toggle md:hidden text-white hover:text-aurora-green transition-colors" aria-label="Toggle menu">
						<svg class="svg svg--stroke lucide lucide-menu" width="28" height="28">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#menu'; ?>"></use>
						</svg>
					</button>
					<ul class="polylang-flags">
						<?php
						if (function_exists('pll_the_languages')) {
              //pll_the_languages(array('show_names' => 1, 'show_flags'=>1, 'dropdown'=>0));
							$languages = pll_the_languages(array('raw' => 1));

							if (! empty($languages)) {

								$current_lang = array_filter($languages, function ($l) {
									return $l['current_lang'];
								});
								$current_lang = !empty($current_lang) ? reset($current_lang) : $languages[0];
						?>

								<div class="relative custom-lang-dropdown">


									<button type="button" class="dropdown-toggle">
										<span><?php echo esc_html($current_lang['name']); ?></span>

										<svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
										</svg>
									</button>

									<ul class="absolute z-50 hidden dropdown-menu">
										<?php foreach ($languages as $lang) : ?>
											<li class="<?php echo $lang['current_lang'] ? 'current-item' : ''; ?>">
												<a href="<?php echo esc_url($lang['url']); ?>">
													<?php echo esc_html($lang['name']); ?>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>

								</div>
						<?php
							}
						}
						?>
					</ul>
				</div>
			</div>
			<nav class="mobile-menu md:hidden bg-deep-blue/98 backdrop-blur-md">
				<div class="px-4 pt-2 pb-4 space-y-3">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'menu_mobile',
						'walker' => new Mobile_Nav_Walker(),
						'container' => false,
						'items_wrap' => '%3$s',
						'fallback_cb' => false
					));
					?>
				</div>
			</nav>
		</header>