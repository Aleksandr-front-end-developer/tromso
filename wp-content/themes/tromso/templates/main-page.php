<?php

/**
 * Template Name: Main page
 *
 * Front page php tempate
 */

get_header();

$post_id = get_the_ID();
?>
<main id="main" class="main">

	<section class="hero relative h-screen flex items-center justify-center overflow-hidden">
		<div
			class="absolute inset-0 z-0 hero-bg" style="background-image:url(<?php echo wp_get_attachment_image_url(carbon_get_post_meta($post_id, 'section_1_image'), 'full'); ?>)">
			<div class="absolute inset-0 bg-gradient-to-b from-deep-blue/70 via-deep-blue/50 to-deep-blue/70"></div>
		</div>
		<div class="hero-container relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <?php 
      $title = carbon_get_post_meta($post_id, 'section_1_title');
      if (isset($title) && $title!='') {
      ?>
			<h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white mb-6 animate-fade-in"><?php echo $title; ?></h1>
      <?php } ?>
      <?php 
      $subtitle = carbon_get_post_meta($post_id, 'section_1_subtitle');
      if (isset($subtitle) && $subtitle!='') {
      ?>
			<h2 class="text-2xl sm:text-3xl text-white/90 mb-6 font-medium"><?php echo $subtitle; ?></h2>
      <?php } ?>
			<div class="text-lg sm:text-xl text-white/80 mb-8 max-w-2xl mx-auto leading-relaxed"><?php echo wpautop(carbon_get_post_meta($post_id, 'section_1_description')); ?></div>
			<div class="flex items-center justify-center gap-2 mb-8 bg-white/10 backdrop-blur-sm px-6 py-4 rounded-full inline-flex">
				<div class="flex">
					<?php
					$rating = carbon_get_post_meta($post_id, 'section_1_rating');
					echo get_rating_stars($rating);
					?>
				</div>
				<span class="text-white font-semibold text-lg"><?php echo $rating; ?></span>
				<a href="<?php echo carbon_get_post_meta($post_id, 'section_1_link_url'); ?>" class="ml-2 text-white/90 hover:text-aurora-green transition-colors underline font-medium"><?php echo carbon_get_post_meta($post_id, 'section_1_link_text'); ?></a>
			</div>
			<button data-section="tours_block"
				class="tour-item px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl text-lg px-8 py-4">
				<?php echo carbon_get_post_meta($post_id, 'section_1_button_text'); ?>
			</button>
		</div>
		<div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
			<div class="w-6 h-10 border-2 border-white/50 rounded-full flex items-start justify-center p-2">
				<div class="w-1 h-3 bg-white/50 rounded-full"></div>
			</div>
		</div>
	</section>

	<div id="tours_block">
		<?php
		$currency = carbon_get_post_meta($post_id, 'currency_symbol');
		$tour_blocks = carbon_get_post_meta($post_id, 'main_page_tours');
		if (is_array($tour_blocks)) {
			foreach ($tour_blocks as $tour_block) {
		?>
				<section id="<?php echo $tour_block['anchor']; ?>" class="py-20" style="background-color:<?php echo $tour_block['background']; ?>">
					<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
						<div class="text-center mb-16">
              <?php if (isset($tour_block['title']) && $tour_block['title']!='') { ?>
							<h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-4"><?php echo $tour_block['title']; ?></h2>
							<?php } ?>
							<?php if ($tour_block['underline'] == 'y') { ?>
								<div class="w-24 h-1 bg-aurora-green mx-auto"></div>
							<?php } ?>
							<div class="text-xl text-gray-600 max-w-2xl mx-auto"><?php echo wpautop($tour_block['description']); ?></div>
						</div>
						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
							<?php
							if (is_array($tour_block['tours'])) {
								foreach ($tour_block['tours'] as $tour) {
									get_template_part('template-parts/tour-card', null, array('tour' => $tour, 'currency' => $currency));
								}
							}
							?>
						</div>
					</div>
				</section>
		<?php
			}
		}
		?>
  </div>

		<section id="about" class="py-20 bg-gradient-to-b from-gray-50 to-white">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="text-center mb-16">
          <?php
          $title = carbon_get_post_meta($post_id, 'section_3_title');
          if (isset($title) && $title!='') {
          ?>
          <h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-6"><?php echo $title; ?></h2>
          <?php } ?>
					<div class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed"><?php echo wpautop(carbon_get_post_meta($post_id, 'section_3_description')); ?></div>
				</div>
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
					<?php
					$cards = carbon_get_post_meta($post_id, 'section_3_cards');
					if (is_array($cards)) {
						foreach ($cards as $card) {
					?>
							<div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
								<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto" style="background-color: <?php echo $card['image_background']; ?>;">
									<?php
									$image = intval($card['image']);
									if ($image > 0) echo wp_get_attachment_image($image, array(32, 32), false);
									?>
								</div>
                <?php if (isset($card['title']) && $card['title']!='') { ?>
								<h3 class="text-xl font-bold text-deep-blue mb-3 text-center"><?php echo $card['title']; ?></h3>
                <?php } ?>
								<p class="text-gray-600 text-center leading-relaxed"><?php echo wpautop($card['description']); ?></p>
							</div>
					<?php
						}
					}
					?>
				</div>
			</div>
		</section>

		<section class="py-20 bg-gray-50">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="text-center mb-12">
          <?php
          $title = carbon_get_post_meta($post_id, 'section_4_title');
          if (isset($title) && $title!='') {
          ?>
					<h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-4"><?php echo $title; ?></h2>
          <?php } ?>
					<div class="w-24 h-1 bg-aurora-green mx-auto"></div>
				</div>
				<div class="grid md:grid-cols-2 gap-12 items-center">
					<div class="order-2 md:order-1">
						<?php
						$image = intval(carbon_get_post_meta($post_id, 'section_4_image'));
						if ($image > 0) echo wp_get_attachment_image($image, 'full', false, array('class' => "rounded-2xl shadow-2xl w-full h-auto"));
						?>
					</div>
					<div class="order-1 md:order-2">
						<div class="text-xl text-gray-700 leading-relaxed mb-6"><?php echo wpautop(carbon_get_post_meta($post_id, 'section_4_description1')); ?></div>
						<div class="text-lg text-gray-600 leading-relaxed"><?php echo wpautop(carbon_get_post_meta($post_id, 'section_4_description2')); ?></div>
					</div>
				</div>
			</div>
		</section>

		<section class="py-20 bg-white">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="text-center mb-12">
          <?php
          $title = carbon_get_post_meta($post_id, 'section_5_title');
          if (isset($title) && $title!='') {
          ?>
					<h2 class="text-3xl sm:text-4xl font-bold text-deep-blue mb-4"><?php echo $title; ?></h2>
          <?php } ?>
					<div class="text-lg text-gray-600"><?php echo wpautop(carbon_get_post_meta($post_id, 'section_5_description')); ?></div>
				</div>
				<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
					<?php
					$cards = carbon_get_post_meta($post_id, 'section_5_cards');
					if (is_array($cards)) {
						foreach ($cards as $card) {
					?>
							<div
								class="flex flex-col items-center justify-center p-6 rounded-xl border-2 border-gray-200 hover:border-aurora-green hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
								<div class=" w-16 h-16 rounded-full flex items-center justify-center mb-4" style="background-color: <?php echo $card['image_background']; ?>;">
									<?php
									$image = intval($card['image']);
									if ($image > 0) echo wp_get_attachment_image($image, array(32, 32), false);
									?>
								</div>
								<div class="text-center">
									<p class="text-sm font-bold text-gray-900 mb-1"><?php echo $card['title']; ?></p>
									<div class="text-xs text-gray-500 font-semibold"><?php echo wpautop($card['description']); ?></div>
								</div>
							</div>
					<?php
						}
					}
					?>
				</div>
			</div>
		</section>

		<?php /* section spollers  */ ?>
		<section class=" bg-white section-spollers">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div data-spollers data-one-spoller class="spollers">
					<?php
					$items = carbon_get_post_meta($post_id, 'section_6_items');
					if (is_array($items)) {
						foreach ($items as $item) {
					?>
					<div class="spollers__item">
						<button type="button" data-spoller class="spollers__title text-xl text-gray-700 leading-relaxe"><?php echo $item['title']; ?></button>
						<div class="spollers__body text-lg text-gray-600 leading-relaxed"><?php echo wpautop($item['description']); ?></div>
					</div>
					<?php
						}
					}
          ?>
				</div>
			</div>
		</section>

		<div class="content max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16"><?php the_content() ?></div>
</main>
<?php
get_footer();
?>