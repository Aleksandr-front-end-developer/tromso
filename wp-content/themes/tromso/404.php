<?php

/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<main id="main" class="main">

	<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-orange-50 flex items-center justify-center">
		<div class="max-w-2xl mx-auto px-6 text-center">
			<div class="mb-8 mt-8">
				<div class="text-8xl md:text-9xl font-bold text-transparent bg-gradient-to-r from-blue-600 via-purple-600 to-orange-500 bg-clip-text mb-4">404</div>
				<div class="w-32 h-1 bg-gradient-to-r from-blue-600 to-purple-600 mx-auto rounded-full"></div>
			</div>
			<h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4"><?php _e('Page not found', 'tromso'); ?></h1>
			<p class="text-lg text-gray-600 mb-8 max-w-md mx-auto"><?php _e('Unfortunately, the requested page does not exist or has been moved. You may have followed an outdated link.', 'tromso'); ?></p>

			<div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
				<a class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl text-lg px-8 py-4" href="/" data-discover="true"><?php _e('Home page', 'tromso'); ?></a>

			</div>
		</div>
	</div>

</main>

<?php
get_footer();
