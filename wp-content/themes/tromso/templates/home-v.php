<?php

/**
 * Template Name: Home Верстка
 *
 * Front page php tempate
 */

get_header();
?>
<main id="main" class="main">

	<section class="relative h-screen flex items-center justify-center overflow-hidden">
		<div
			class="absolute inset-0 z-0 hero-bg">
			<div class="absolute inset-0 bg-gradient-to-b from-deep-blue/70 via-deep-blue/50 to-deep-blue/70"></div>
		</div>
		<div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
			<h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white mb-6 animate-fade-in">Experience the Magic of Tromsø</h1>
			<h2 class="text-2xl sm:text-3xl text-white/90 mb-6 font-medium">Discover unforgettable adventures in the Arctic</h2>
			<p class="text-lg sm:text-xl text-white/80 mb-8 max-w-2xl mx-auto leading-relaxed">
				Experience the magic of the Arctic Circle with authentic adventures guided by local experts. From chasing the Northern Lights to whale watching in pristine fjords, create
				memories that last a lifetime.
			</p>
			<div class="flex items-center justify-center gap-2 mb-8 bg-white/10 backdrop-blur-sm px-6 py-4 rounded-full inline-flex">
				<div class="flex">
					<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="20" height="20">
						<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
					</svg>
					<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="20" height="20">
						<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
					</svg>

					<!-- Полная звезда -->
					<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="20" height="20">
						<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
					</svg>
					<!-- --- -->
					<!-- Половина звезди -->
					<div class="relative" style="width: 20px; height: 20px">
						<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="20" height="20">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
						</svg>
						<div class="overflow-hidden absolute" style="width: 10px">
							<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="20" height="20">
								<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
							</svg>
						</div>
					</div>
					<!-- ---- -->
					<!-- Пустая звезда -->
					<svg class="svg svg--stroke lucide lucide-star text-gray-300 " width="20" height="20">
						<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
					</svg>
					<!-- ---- -->
				</div>
				<span class="text-white font-semibold text-lg">4.8</span><button class="ml-2 text-white/90 hover:text-aurora-green transition-colors underline font-medium">READ MORE</button>
			</div>
			<button data-section="best-sellers"
				class="tour-item px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl text-lg px-8 py-4">
				Explore Tours
			</button>
		</div>
		<div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
			<div class="w-6 h-10 border-2 border-white/50 rounded-full flex items-start justify-center p-2">
				<div class="w-1 h-3 bg-white/50 rounded-full"></div>
			</div>
		</div>
	</section>

	<section id="best-sellers" class="py-20 bg-gray-50">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-4">Best Seller Tours</h2>
				<p class="text-xl text-gray-600 max-w-2xl mx-auto">Our most popular Arctic adventures, loved by travelers from around the world</p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<a href="#" class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1579033461380-adb47c3eb938.jpg"
							alt="Ultimate Aurora Hunt &amp; Citizen Science Adventure"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-aurora-green text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">BEST SELLER</span>
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Ultimate Aurora Hunt &amp; Citizen Science Adventure</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<!-- Полная звезда -->
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<!-- --- -->
								<!-- Половина звезди -->
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<!-- ---- -->
								<!-- Пустая звезда -->
								<svg class="svg svg--stroke lucide lucide-star text-gray-300 " width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<!-- ---- -->
								<span class="ml-2 text-sm font-medium text-gray-700">4.9</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">5 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">120+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$215</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								LEARN MORE
							</button>
						</div>
					</div>
				</a>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1516681100942-77d8e7f9dd97.jpg"
							alt="Authentic Reindeer Sledding &amp; Sami Cultural Journey"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-aurora-green text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">BEST SELLER</span>
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Authentic Reindeer Sledding &amp; Sami Cultural Journey</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.9</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">5 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">110+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$185</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								LEARN MORE
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1542435503-956c469947f6.jpg"
							alt="Epic Husky Sledding Self-Drive Experience"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-aurora-green text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">BEST SELLER</span>
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Epic Husky Sledding Self-Drive Experience</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.8</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">4 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">95+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$225</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								LEARN MORE
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="autumn-tours" class="py-20 bg-white">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-4">Autumn Tours</h2>
				<div class="w-24 h-1 bg-aurora-green mx-auto"></div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1559827260-dc66d52bef19.jpg"
							alt="Whale Watching RIB Boat Tour in Skjervøy from Tromsø"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Whale Watching RIB Boat Tour in Skjervøy from Tromsø</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.8</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">6 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">40+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$189</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1513836279014-a89f7a76ae86.jpg"
							alt="Tromsø: Fjord Adventure Tour with Wildlife and Lunch"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Tromsø: Fjord Adventure Tour with Wildlife and Lunch</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.7</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">8 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">75+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$143</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1483921020237-2ff51e8e4b22.jpg"
							alt="Ice Domes Snow Park and Wilderness Experience"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Ice Domes Snow Park and Wilderness Experience</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.6</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">4 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">60+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$95</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="summer-tours" class="py-20 bg-white">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-4">Summer Tours</h2>
				<div class="w-24 h-1 bg-aurora-green mx-auto"></div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1506905925346-21bda4d32df4.jpg"
							alt="Tromsø: Morning Polar Expedition Cruise to Arctic Archipelago"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Tromsø: Morning Polar Expedition Cruise to Arctic Archipelago</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.8</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">7 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">45+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$165</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1544551763-46a013bb70d5.jpg"
							alt="Tromsø Floating in Arctic Sea Experience"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Tromsø Floating in Arctic Sea Experience</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.7</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">3 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">85+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$79</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/caption.jpg"
							alt="Tromsø: Fjord Fishing Cruise"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Tromsø: Fjord Fishing Cruise</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.6</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">5 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">55+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$125</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="winter-tours" class="py-20 bg-white">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-4">Winter Tours</h2>
				<div class="w-24 h-1 bg-aurora-green mx-auto"></div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1579033461380-adb47c3eb938.jpg"
							alt="Ultimate Aurora Hunt &amp; Citizen Science Adventure"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Ultimate Aurora Hunt &amp; Citizen Science Adventure</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.9</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">5 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">120+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$215</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1516681100942-77d8e7f9dd97.jpg"
							alt="Authentic Reindeer Sledding &amp; Sami Cultural Journey"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Authentic Reindeer Sledding &amp; Sami Cultural Journey</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.9</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">5 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">110+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$185</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1483728642387-6c3bdd6c93e5.jpg"
							alt="Tromsø: Luxury Northern Lights Cruise with Hot Tub &amp; Dinner"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Tromsø: Luxury Northern Lights Cruise with Hot Tub &amp; Dinner</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.9</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">6 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">90+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$245</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1542435503-956c469947f6.jpg"
							alt="Epic Husky Sledding Self-Drive Experience"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Epic Husky Sledding Self-Drive Experience</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.8</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">4 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">95+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$225</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1553531889-e6cf4d692b1b.jpg"
							alt="Husky Sledding Self-Drive Adventure in Tromsø"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Husky Sledding Self-Drive Adventure in Tromsø</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">
									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">

										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.8</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">4 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">65+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$195</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
				<div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
					<div class="relative overflow-hidden h-64">
						<img
							src="/wp-content/uploads/2025/10/photo-1591025207163-942350e47db2.jpg"
							alt="Silent Whale Watching"
							loading="lazy"
							class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
						<div class="absolute top-4 left-4 flex gap-2">
							<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">Silent Whale Watching</h3>
						<div class="mb-4">
							<div class="flex items-center gap-1">
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
								</svg>
								<div class="relative" style="width: 16px; height: 16px">

									<svg class="svg svg--stroke lucide lucide-star text-gray-300 absolute" width="16" height="16">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
									</svg>
									<div class="overflow-hidden absolute" style="width: 8px">
										<svg class="svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400" width="16" height="16">
											<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#star'; ?>"></use>
										</svg>
									</div>
								</div>
								<span class="ml-2 text-sm font-medium text-gray-700">4.7</span>
							</div>
						</div>
						<div class="flex items-center gap-4 mb-4 text-gray-600">
							<div class="flex items-center gap-1">

								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm">5 hours</span>
							</div>
							<div class="flex items-center gap-1">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm">35+ bookings</span>
							</div>
						</div>
						<div class="flex items-center justify-between pt-4 border-t border-gray-200">
							<div>
								<span class="text-3xl font-bold text-deep-blue">$155</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
							<button
								class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
								BOOK NOW
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section id="about" class="py-20 bg-gradient-to-b from-gray-50 to-white">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-16">
				<h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-6">Why Tromsø is a Must-Visit Destination</h2>
				<p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
					Located 350 kilometers north of the Arctic Circle, Tromsø is the gateway to Arctic adventures. Known as the "Paris of the North," this vibrant city offers a unique blend of
					stunning natural phenomena, rich cultural heritage, and unforgettable wildlife encounters. Whether you're chasing the Northern Lights in winter or experiencing the midnight
					sun in summer, Tromsø delivers authentic Arctic experiences year-round.
				</p>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
				<div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto" style="background-color: rgba(8, 145, 178, 0.1019607843);">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/snowflake.svg" alt="">
					</div>
					<h3 class="text-xl font-bold text-deep-blue mb-3 text-center">Arctic Wildlife</h3>
					<p class="text-gray-600 text-center leading-relaxed">Experience unforgettable encounters with whales, reindeer, and unique Arctic fauna in their natural habitat.</p>
				</div>
				<div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto" style="background-color: rgba(8, 145, 178, 0.1019607843);">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/sparkles.svg" alt="">
					</div>
					<h3 class="text-xl font-bold text-deep-blue mb-3 text-center">Northern Lights Experience</h3>
					<p class="text-gray-600 text-center leading-relaxed">Witness the magical Aurora Borealis dancing across the Arctic sky during the polar night season.</p>
				</div>
				<div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto" style="background-color: rgba(8, 145, 178, 0.1019607843);">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/ship.svg" alt="">
					</div>
					<h3 class="text-xl font-bold text-deep-blue mb-3 text-center">Unique Fjord Boat Tours</h3>
					<p class="text-gray-600 text-center leading-relaxed">Explore dramatic fjords, pristine waters, and remote Arctic archipelagos on guided boat expeditions.</p>
				</div>
				<div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto" style="background-color: rgba(8, 145, 178, 0.1019607843);">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/compass.svg" alt="">
					</div>
					<h3 class="text-xl font-bold text-deep-blue mb-3 text-center">Authentic Northern Experience</h3>
					<p class="text-gray-600 text-center leading-relaxed">Immerse yourself in Sami culture, traditional cuisine, and genuine Arctic hospitality.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="py-20 bg-gray-50">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-12">
				<h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-4">Meet the Team</h2>
				<div class="w-24 h-1 bg-aurora-green mx-auto"></div>
			</div>
			<div class="grid md:grid-cols-2 gap-12 items-center">
				<div class="order-2 md:order-1">
					<img
						src="/wp-content/uploads/2025/10/photo-1522071820081-009f0129c71c.jpg"
						alt="Tromsø Tours Expert Team"
						loading="lazy"
						class="rounded-2xl shadow-2xl w-full h-auto" />
				</div>
				<div class="order-1 md:order-2">
					<p class="text-xl text-gray-700 leading-relaxed mb-6">
						Our expert team has been helping navigate and book Tromsø tours and activities for tourists from the US and Canada for over a decade, ensuring you have a hassle-free trip
						with everything booked in advance.
					</p>
					<p class="text-lg text-gray-600 leading-relaxed">
						With deep knowledge of the Arctic region, partnerships with the best local operators, and a passion for creating unforgettable experiences, we're committed to making your
						Arctic adventure truly extraordinary. From your first inquiry to your last tour, we're here to support you every step of the way.
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="py-20 bg-white">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-12">
				<h2 class="text-3xl sm:text-4xl font-bold text-deep-blue mb-4">Award-Winning Travel Experience</h2>
				<p class="text-lg text-gray-600">Recognized by leading travel platforms worldwide</p>
			</div>
			<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
				<div
					class="flex flex-col items-center justify-center p-6 rounded-xl border-2 border-gray-200 hover:border-aurora-green hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-4" style="background-color: #fef9c3;">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/trophy.svg" alt="">
					</div>
					<div class="text-center">
						<p class="text-sm font-bold text-gray-900 mb-1">TripAdvisor Certificate of Excellence</p>
						<p class="text-xs text-gray-500 font-semibold">2024</p>
					</div>
				</div>
				<div
					class="flex flex-col items-center justify-center p-6 rounded-xl border-2 border-gray-200 hover:border-aurora-green hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-4" style="background-color: #dbeafe;">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/star-color.svg" alt="">
					</div>
					<div class="text-center">
						<p class="text-sm font-bold text-gray-900 mb-1">Booking.com Traveller Review Award</p>
						<p class="text-xs text-gray-500 font-semibold">2024</p>
					</div>
				</div>
				<div
					class="flex flex-col items-center justify-center p-6 rounded-xl border-2 border-gray-200 hover:border-aurora-green hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-4" style="background-color: #dcfce7;">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/award.svg" alt="">
					</div>
					<div class="text-center">
						<p class="text-sm font-bold text-gray-900 mb-1">Best Tour Operator Norway</p>
						<p class="text-xs text-gray-500 font-semibold">2023</p>
					</div>
				</div>
				<div
					class="flex flex-col items-center justify-center p-6 rounded-xl border-2 border-gray-200 hover:border-aurora-green hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-4" style="background-color: #f3e8ff;">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/medal.svg" alt="">
					</div>
					<div class="text-center">
						<p class="text-sm font-bold text-gray-900 mb-1">TrustPilot Excellent Rating</p>
						<p class="text-xs text-gray-500 font-semibold">2024</p>
					</div>
				</div>
				<div
					class="flex flex-col items-center justify-center p-6 rounded-xl border-2 border-gray-200 hover:border-aurora-green hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
					<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-4" style="background-color: #fee2e2;">
						<img width="32" height="32" class="" src="/wp-content/uploads/2025/10/thumbs-up.svg" alt="">
					</div>
					<div class="text-center">
						<p class="text-sm font-bold text-gray-900 mb-1">Arctic Tourism Award</p>
						<p class="text-xs text-gray-500 font-semibold">2023</p>
					</div>
				</div>
			</div>
		</div>
	</section>





</main>
<?php
get_footer();
?>