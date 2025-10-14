<?php

/**
 * Template Name: About Us
 *
 * Front page php tempate
 */

get_header();
?>
<main id="main" class="main">

	<?php get_template_part('template-parts/page', 'hero');	  ?>

	<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<div class="grid md:grid-cols-2 gap-12 mb-16">
			<div>
				<img src="/wp-content/uploads/2025/10/pexels-photo-1054218.jpeg" alt="Tromsø Northern Lights" class="rounded-xl shadow-lg w-full h-[400px] object-cover" />
			</div>
			<div class="flex flex-col justify-center">
				<h2 class="text-3xl font-bold text-gray-900 mb-4">Our Story</h2>
				<p class="text-gray-600 mb-4 leading-relaxed">
					Founded by Arctic enthusiasts with deep roots in Tromsø, we've been connecting travelers with the magic of Northern Norway for years. Our passion for the Arctic wilderness
					and commitment to sustainable tourism drives everything we do.
				</p>
				<p class="text-gray-600 leading-relaxed">
					We partner with the most reputable local tour operators to ensure you experience the very best of Tromsø - from chasing the Northern Lights to whale watching in pristine
					fjords. Every tour we recommend has been personally vetted by our team.
				</p>
			</div>
		</div>
		<div class="grid md:grid-cols-2 gap-12 mb-16">
			<div class="flex flex-col justify-center order-2 md:order-1">
				<h2 class="text-3xl font-bold text-gray-900 mb-4">Our Mission</h2>
				<p class="text-gray-600 mb-4 leading-relaxed">
					To make Arctic adventures accessible to everyone while preserving the pristine beauty of Northern Norway for future generations. We believe in responsible tourism that
					benefits local communities and protects the environment.
				</p>
				<p class="text-gray-600 leading-relaxed">
					We work exclusively with operators who share our values of sustainability, safety, and authentic experiences. Your adventure should leave you with incredible memories and a
					deep appreciation for the Arctic.
				</p>
			</div>
			<div class="order-1 md:order-2">
				<img src="/wp-content/uploads/2025/10/pexels-photo-3408744.jpeg" alt="Tromsø Winter Adventure" class="rounded-xl shadow-lg w-full h-[400px] object-cover" />
			</div>
		</div>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
			<div class="text-center p-6 bg-white rounded-xl shadow-md">
				<div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: #0891b2;">
					<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/mountain.svg" alt="">
				</div>
				<h3 class="text-2xl font-bold text-gray-900 mb-2">10+</h3>
				<p class="text-gray-600">Years Experience</p>
			</div>
			<div class="text-center p-6 bg-white rounded-xl shadow-md">
				<div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: #10b981;">
					<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/users.svg" alt="">
				</div>
				<h3 class="text-2xl font-bold text-gray-900 mb-2">50,000+</h3>
				<p class="text-gray-600">Happy Travelers</p>
			</div>
			<div class="text-center p-6 bg-white rounded-xl shadow-md">
				<div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: #eab308;">
					<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/award.svg" alt="">
				</div>
				<h3 class="text-2xl font-bold text-gray-900 mb-2">25+</h3>
				<p class="text-gray-600">Partner Operators</p>
			</div>
			<div class="text-center p-6 bg-white rounded-xl shadow-md">
				<div class=" w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: #ef4444;">
					<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/heart.svg" alt="">
				</div>
				<h3 class="text-2xl font-bold text-gray-900 mb-2">4.8/5</h3>
				<p class="text-gray-600">Average Rating</p>
			</div>
		</div>
		<div class="bg-gradient-to-r from-ice-blue to-deep-blue rounded-xl p-8 md:p-12 text-white text-center">
			<h2 class="text-3xl font-bold mb-4">Why Choose Us?</h2>
			<div class="grid md:grid-cols-3 gap-8 mt-8">
				<div>
					<h3 class="text-xl font-bold mb-2">Expert Curation</h3>
					<p class="text-white/90">Every tour is personally selected and vetted by our Arctic experts</p>
				</div>
				<div>
					<h3 class="text-xl font-bold mb-2">Best Price Guarantee</h3>
					<p class="text-white/90">We work directly with operators to ensure competitive pricing</p>
				</div>
				<div>
					<h3 class="text-xl font-bold mb-2">24/7 Support</h3>
					<p class="text-white/90">Our team is here to help before, during, and after your trip</p>
				</div>
			</div>
		</div>
	</div>





</main>
<?php
get_footer();
?>