<?php

get_header();

$post_id = get_the_ID();
?>
<main id="main" class="main">
	<section class="breadcrumbs">
		<div class="tour-hero__container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumbs__container">
				<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a class="transition-all duration-300" itemprop="item" href="<?php echo home_url(); ?>">
						<span itemprop="name"><?php echo get_bloginfo('name'); ?></span>
						<meta itemprop="position" content="1" />
					</a>
				</span>
				<?php if ($post && !is_home() && !is_archive()) : ?>
					<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<span class="divider">
							<svg class="svg" width="24" height="24">
								<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#arrow-right-24'; ?>"></use>
							</svg>
						</span>
						<span itemprop="name"><?php echo get_the_title($post); ?></span>
						<meta itemprop="position" content="2" />
					</span>
				<?php endif; ?>
			</div>
		</div>

	</section>

	<section class="section tour-hero pb-16">
		<div class="tour-hero__container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="tour-hero__wrapper">
				<div class="tour-hero__image">
					<?php echo get_the_post_thumbnail(); ?>
				</div>
				<div class="tour-hero__texts">
					<h1 class="tour-hero__title text-xl font-bold text-gray-900 mb-3 "><?php echo the_title(); ?></h1>
					<div class="tour-hero__description card-description "><?php echo the_content(); ?></div>

					<div class="tour-hero__info">
						<?php
						$rating = floatval(carbon_get_post_meta($post_id, 'tour_rating'));
						if ($rating > 0 && $rating <= 5) {
						?>
							<div class="tour-hero__stars card__stars">
								<div class="flex items-center ">
									<?php echo get_rating_stars($rating); ?>
									<span class="ml-2 text-sm font-medium text-gray-700">
										<?php echo $rating; ?>
									</span>
								</div>
							</div>
						<?php } ?>
						<?php
						$price = floatval(carbon_get_post_meta($post_id, 'tour_price'));
						$currency = carbon_get_post_meta($post_id, 'tour_currency');
						if ($price > 0) {
						?>
							<div class="tour-hero__price card__field">
								<span class="text-3xl font-bold text-deep-blue">
									<?php echo $currency; ?>
									<span class="card__value">
										<?php echo $price; ?>
									</span>
								</span>
								<span class="text-gray-500 text-sm ml-1">per person</span>
							</div>
						<?php } ?>
						<div class="tour-hero__data flex items-center gap-1">
							<?php
							$hours = intval(carbon_get_post_meta($post_id, 'tour_hours'));
							if ($hours > 0) {
							?>
								<div class="flex items-center gap-1 card__field">
									<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
									</svg>
									<span class="text-sm"><span class="card__value">
											<?php echo $hours; ?>
										</span> hours</span>
								</div>
							<?php } ?>
							<?php
							$bookings = floatval(carbon_get_post_meta($post_id, 'tour_bookings'));
							if ($bookings > 0) {
							?>
								<div class="flex items-center gap-1 card__field">
									<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
										<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
									</svg>
									<span class="text-sm"><span class="card__value">
											<?php echo $bookings; ?>
										</span>+ bookings</span>
								</div>
							<?php } ?>
						</div>
						<?php $link = carbon_get_post_meta($post_id, 'tour_url'); ?>
						<a href="<?php echo $link; ?>" target="_blank"
							class="tour-hero__button px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2 card__button">
							BOOK NOW
						</a>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="section tour-content">
		<div class="tour-content__container content max-w-6xl px-4 sm:px-6 lg:px-8 pt-4 border-t border-gray-200 mx-auto">
			<?php
			$title = carbon_get_post_meta($post_id, 'tour_section_1_title');
			$description = carbon_get_post_meta($post_id, 'tour_section_1_description');
			$list = carbon_get_post_meta($post_id, 'tour_section_1_list');
			$do_not_show = carbon_get_post_meta($post_id, 'tours_do_not_show1');
			if (!$do_not_show && (check_cf_complex($list) || check_cf($title) || check_cf($description))) {
			?>
				<div class="tour-content__block content-block">
					<h2 class="content-block__title"><?php echo $title; ?></h2>
					<div class="content-block__description">
						<?php echo wpautop($description); ?>
						<ul class="wp-block-list">
							<?php foreach ($list as $item) { ?>
								<li><?php echo $item['list_item']; ?></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			<?php } ?>

			<?php
			$title = carbon_get_post_meta($post_id, 'tour_section_2_title');
			$included = carbon_get_post_meta($post_id, 'tour_section_2_included');
			$excluded = carbon_get_post_meta($post_id, 'tour_section_2_excluded');
			$do_not_show = carbon_get_post_meta($post_id, 'tours_do_not_show2');
			if (!$do_not_show && (check_cf_complex($included) || check_cf_complex($excluded) || check_cf($title))) {
			?>
				<div class="tour-content__block content-block">
					<h2 class="content-block__title"><?php echo $title; ?></h2>
					<div class="content-block__description">
						<div class="content-block__wrapper">
							<div class="content-block__item correct">
								<ul>
									<?php foreach ($included as $item) { ?>
										<li><?php echo $item['list_item']; ?></li>
									<?php } ?>
								</ul>
							</div>
							<div class="content-block__item not-correct">
								<ul>
									<?php foreach ($excluded as $item) { ?>
										<li><?php echo $item['list_item']; ?></li>
									<?php } ?>
								</ul>
							</div>

						</div>

					</div>
				</div>
			<?php } ?>

			<?php
			$title = carbon_get_post_meta($post_id, 'tour_section_3_title');
			$description = carbon_get_post_meta($post_id, 'tour_section_3_description');
			$list = carbon_get_post_meta($post_id, 'tour_section_3_list');
			$do_not_show = carbon_get_post_meta($post_id, 'tours_do_not_show3');
			if (!$do_not_show && (check_cf_complex($list) || check_cf($description) || check_cf($title))) {
			?>
				<div class="tour-content__block content-block">
					<h2 class="content-block__title"><?php echo $title; ?></h2>
					<div class="content-block__description">
						<?php echo wpautop($description); ?>
					</div>

					<div class="content-block__item number">
						<ol>
							<?php foreach ($list as $item) { ?>
								<li><?php echo $item['list_item']; ?></li>
							<?php } ?>
						</ol>
					</div>

				</div>
			<?php } ?>




		</div>
	</section>


	<?php
	$description = carbon_get_post_meta($post_id, 'tour_section_4_description');
	$do_not_show = carbon_get_post_meta($post_id, 'tours_do_not_show4');
	if (!$do_not_show && check_cf($description)) {
	?>
		<section class="tour-content__content tour-content__container content max-w-6xl px-4 sm:px-6 lg:px-8 py-16 pt-4  mx-auto">
			<div>
				<?php echo wpautop($description); ?>
			</div>
		</section>
	<?php } ?>

	<?php
	$link = carbon_get_post_meta($post_id, 'tour_section_5_link');
	if ($link == '') $link = carbon_get_post_meta($post_id, 'tour_url');
	$do_not_show = carbon_get_post_meta($post_id, 'tours_do_not_show5');
	if (!$do_not_show && check_cf($link)) {
	?>
		<section class="tour-reviews tour-content__container content max-w-6xl px-4 sm:px-6 lg:px-8 py-16 pt-4  mx-auto">
			<div class="tour-reviews__wrapper">
				<h2 class="content-block__title">Reviews</h2>
				<div class="stars flex items-center justify-center gap-2 mb-8 bg-white/10 backdrop-blur-sm  rounded-full inline-flex">
					<div class="flex">
						<?php echo get_rating_stars($rating); ?>
					</div>
					<span class="tour-reviews__number font-semibold text-lg"><?php echo $rating; ?></span>
					<a href="<?php echo $link; ?>" class="ml-2 text-white/90 hover:text-aurora-green transition-colors underline font-medium">Read more reviews</a>
				</div>
			</div>
		</section>
	<?php } ?>

</main>
<?php
get_footer();
?>