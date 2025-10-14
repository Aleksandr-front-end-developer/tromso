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
					<a href="/" class=" flex items-center gap-2 text-white font-bold text-xl hover:text-aurora-green transition-colors">
						<img width="172" height="32" class="" src="/wp-content/uploads/2025/10/logo.svg" alt="">
					</a>
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