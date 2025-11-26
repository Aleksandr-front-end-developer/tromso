<?php

/**
 * Template Name: Tour
 *
 * Front page php tempate
 */

get_header();

$post_id = get_the_ID();
?>
<main id="main" class="main">

	<section class="section tour-hero pb-16">
		<div class="tour-hero__container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="tour-hero__wrapper">
				<div class="tour-hero__image">
					<img class="" src="/wp-content/uploads/2025/10/Hanging-bridges-at-Arenal-Volcano.jpg" alt="">
				</div>
				<div class="tour-hero__texts">
					<h1 class="tour-hero__title text-xl font-bold text-gray-900 mb-3 ">Tromso Aurora Hunt with Bonfire, Soup, Winter Gear & Transfers</h1>
					<div class="tour-hero__description card-description ">
						<p>Take part in 3 amazing activities on 1 tour from La Fortuna. Hike the volcanic paths around the magnificent&nbsp;<strong>Arenal Volcano</strong>, witnessing&nbsp;<strong>Arenal Volcano’s</strong>&nbsp;dramatic landscapes up close. See the spectacular cascades of La Fortuna waterfall nestled in the&nbsp;<strong>Arenal Volcano</strong>&nbsp;region, and walk through the rainforest canopy on the suspension bridges of the Arenal Hanging Bridges park, offering breathtaking views of&nbsp;<strong>Arenal Volcano</strong>&nbsp;from above.</p>
					</div>

					<div class="tour-hero__info">
						<div class="tour-hero__stars card__stars">
							<div class="flex items-center ">
								<?php echo get_rating_stars(5); ?>
								<span class="ml-2 text-sm font-medium text-gray-700">
									<?php // echo $args['tour']['rating'];
									?>
									5
								</span>
							</div>
						</div>
						<div class="tour-hero__price card__field">
							<span class="text-3xl font-bold text-deep-blue">
								<?php // echo $args['currency']
								?>
								$
								<span class="card__value">
									<?php // echo $args['tour']['price'];
									?>
									210
								</span></span>
							<span class="text-gray-500 text-sm ml-1">per person</span>
						</div>
						<div class="tour-hero__data flex items-center gap-1">
							<div class="flex items-center gap-1 card__field">
								<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
								</svg>
								<span class="text-sm"><span class="card__value">
										<?php // echo $args['tour']['hours'];
										?>
										3
									</span> hours</span>
							</div>
							<div class="flex items-center gap-1 card__field">
								<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
									<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
								</svg>
								<span class="text-sm"><span class="card__value">
										5
										<?php // echo $args['tour']['bookings'];
										?>
									</span>+ bookings</span>
							</div>
						</div>
						<button
							class="tour-hero__button px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2 card__button">
							BOOK NOW
						</button>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="section tour-content">
		<div class="tour-content__container content max-w-6xl px-4 sm:px-6 lg:px-8 pt-4 border-t border-gray-200 mx-auto">


			<div class="tour-content__block content-block">
				<h2 class="content-block__title">Overview</h2>
				<div class="content-block__description">
					<p>Chase the night sky in search of the northern lights during this small-group tour from Tromso. Sit down in front of a crackling campfire and enjoy a bowl of warm soup before heading out on your evening adventure. Drive away from city light pollution and discover one or more spots to enjoy the nature show. Sit back and relax while your guide takes photos that are emailed after the tour.</p>
					<ul class="wp-block-list">
						<li><strong>Free Cancellation</strong></li>
						<li><strong>Reserve Now &amp; Pay Later</strong></li>
						<li><strong>English guide</strong></li>
						<li><strong>Pickup</strong>&nbsp;offered</li>
					</ul>
				</div>
			</div>

			<div class="tour-content__block content-block">
				<h2 class="content-block__title">What's Included</h2>
				<div class="content-block__description">
					<div class="content-block__wrapper">
						<div class="content-block__item correct">
							<ul>
								<li>included professional photos of you with Aurora with small watermark</li>
								<li>included professional photos of you with Aurora with small watermark</li>
								<li>included professional photos of you with Aurora with small watermark</li>
							</ul>
						</div>
						<div class="content-block__item not-correct">
							<ul>
								<li>Bottled water
									Bring some water with you, it's important to be hydrated in cold and dry climate.</li>
								<li>We encourage you to wear warm clothing and appropriate footwear. We do not offer boots for out of concern for your foot hygiene.</li>
								<li>included professional photos of you with Aurora with small watermark</li>
							</ul>
						</div>

					</div>

				</div>
			</div>

			<div class="tour-content__block content-block">
				<h2 class="content-block__title">Itinerary</h2>
				<div class="content-block__description">
					After pickup in central Tromsø, travel with your guide into the surrounding countryside, potentially crossing into Finland if conditions demand. Please bring your passport to cover for this possibility.Your guide will use their knowledge of the weather and the Northern Lights to decide on a viewpoint and, on arrival, will set up camp and light a bonfire. Settle by the fire to observe the skies and enjoy homemade soup to stay warm
					Read more about - Tromso Aurora Hunt with Bonfire,
				</div>

				<div class="content-block__item number">
					<ol>
						<li><span>Tromsø</span>Each night we hunt for the Aurora and go to many different destinations, we have hundreds of areas to choose from and we will go to wherever is safest and most likely for guests to see the Northern Lights</li>
						<li><span>Tromsø</span>Each night we hunt for the Aurora and go to many different destinations, we have hundreds of areas to choose from and we will go to wherever is safest and most likely for guests to see the Northern Lights</li>
						<li><span>Tromsø</span>Each night we hunt for the Aurora and go to many different destinations, we have hundreds of areas to choose from and we will go to wherever is safest and most likely for guests to see the Northern Lights</li>

					</ol>
				</div>

			</div>




		</div>
	</section>


	<?php
	$content = mb_trim(get_the_content());
	if ($content != '') {
	?>
		<section class="tour-content__content tour-content__container content max-w-6xl px-4 sm:px-6 lg:px-8 py-16 pt-4  mx-auto">
			<div>
				<?php echo $content; ?>
			</div>
		</section>
	<?php } ?>

	<section class="tour-reviews tour-content__container content max-w-6xl px-4 sm:px-6 lg:px-8 py-16 pt-4  mx-auto">
		<div class="tour-reviews__wrapper">
			<h2 class="content-block__title">Reviews</h2>
			<div class="stars flex items-center justify-center gap-2 mb-8 bg-white/10 backdrop-blur-sm  rounded-full inline-flex">
				<div class="flex">
					<?php
					echo get_rating_stars(4.5);
					?>
				</div>
				<span class="tour-reviews__number font-semibold text-lg">4.5</span>
				<a href="" class="ml-2 text-white/90 hover:text-aurora-green transition-colors underline font-medium">Read more reviews</a>
			</div>
		</div>
	</section>

</main>
<?php
get_footer();
?>