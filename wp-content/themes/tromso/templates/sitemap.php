<?php

/**
 * Template Name: Sitemap
 *
 * Front page php tempate
 */

get_header();
?>
<main id="main" class="main">

	<?php get_template_part('template-parts/page', 'hero');	  ?>


	<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<div class="grid md:grid-cols-3 gap-8">
			<div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
				<div class="flex items-center gap-3 mb-6">
					<div class="bg-ice-blue w-12 h-12 rounded-lg flex items-center justify-center">
						<svg class="svg svg--stroke lucide lucide-home text-white" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#home'; ?>"></use>
						</svg>

					</div>
					<h2 class="text-2xl font-bold text-gray-900">Main Pages</h2>
				</div>
				<ul class="space-y-3">
					<li>
						<a class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2" href="/" data-discover="true"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Home</a>
					</li>
					<li>
						<a class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2" href="/about-us" data-discover="true"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>About Us</a>
					</li>
					<li>
						<a class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2" href="/contact" data-discover="true"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Contact Us</a>
					</li>
				</ul>
			</div>
			<div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
				<div class="flex items-center gap-3 mb-6">
					<div class="bg-ice-blue w-12 h-12 rounded-lg flex items-center justify-center">
						<svg class="svg svg--stroke lucide lucide-file-text text-white" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#file-text'; ?>"></use>
						</svg>

					</div>
					<h2 class="text-2xl font-bold text-gray-900">Legal</h2>
				</div>
				<ul class="space-y-3">
					<li>
						<a class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2" href="/terms-conditions" data-discover="true"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Terms &amp; Conditions</a>
					</li>
					<li>
						<a class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2" href="/privacy-policy" data-discover="true"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Privacy Policy</a>
					</li>
					<li>
						<a class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2" href="/cookie-policy" data-discover="true"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Cookie Policy</a>
					</li>
				</ul>
			</div>
			<div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
				<div class="flex items-center gap-3 mb-6">
					<div class="bg-ice-blue w-12 h-12 rounded-lg flex items-center justify-center">
						<svg class="svg svg--stroke lucide lucide-map text-white" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#map'; ?>"></use>
						</svg>
					</div>
					<h2 class="text-2xl font-bold text-gray-900">Tours</h2>
				</div>
				<ul class="space-y-3">
					<li>
						<a href="/#best-sellers" class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Best Sellers</a>
					</li>
					<li>
						<a href="/#winter-tours" class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Winter Tours</a>
					</li>
					<li>
						<a href="/#summer-tours" class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Summer Tours</a>
					</li>
					<li>
						<a href="/#autumn-tours" class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2"><span class="w-2 h-2 bg-ice-blue rounded-full"></span>Autumn Tours</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="mt-12 bg-ice-blue/10 rounded-xl p-8 border border-ice-blue/20">
			<h2 class="text-2xl font-bold text-gray-900 mb-4">Need Help?</h2>
			<p class="text-gray-600 mb-4 leading-relaxed">Can't find what you're looking for? Our team is here to help you plan your perfect Arctic adventure.</p>
			<a class="inline-flex items-center gap-2 px-6 py-3 bg-ice-blue text-white rounded-lg font-semibold hover:bg-deep-blue transition-colors" href="/contact" data-discover="true">
				<svg class="svg svg--stroke lucide lucide-mail" width="20" height="20">
					<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#mail'; ?>"></use>
				</svg>
				Contact Us</a>
		</div>
	</div>

</main>
<?php
get_footer();
?>