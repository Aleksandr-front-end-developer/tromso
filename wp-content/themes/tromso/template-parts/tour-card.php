          <div class="card bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group flex flex-col">
          	<div class="relative overflow-hidden h-64">

          		<a href="<?php echo $args['tour']['url']; ?>" target="_blank">
          			<?php
								$image = intval($args['tour']['image']);
								if ($image > 0) echo wp_get_attachment_image($image, 'full', false, array('class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110'));
								?>
          		</a>

          		<div class="absolute top-4 left-4 flex gap-2">
          			<?php if ($args['tour']['best_seller'] == 'yes') { ?>
          				<span class="bg-aurora-green text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">BEST SELLER</span>
          			<?php
								}
								if ($args['tour']['top_rated'] == 'yes') {
								?>
          				<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
          			<?php } ?>
          		</div>
          	</div>
          	<div class="p-6 card__texts">
          		<?php if (isset($args['tour']['title']) && $args['tour']['title'] != '') { ?>
          			<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]"><?php echo $args['tour']['title']; ?></h3>
          		<?php } ?>
          		<div class="card-description">
          			<?php echo wpautop($args['tour']['description']); ?>
          		</div>

          		<a href="/" class=" button-read">Read more</a>


          		<div class="card__wrapper-info">
          			<div class=" card__stars">
          				<div class="flex items-center gap-1">
          					<?php echo get_rating_stars($args['tour']['rating'], 16); ?>
          					<span class="ml-2 text-sm font-medium text-gray-700"><?php echo $args['tour']['rating']; ?></span>
          				</div>
          			</div>
          			<div class="flex items-center gap-4 mb-4 mt-4 text-gray-600">
          				<div class="flex items-center gap-1 card__field">
          					<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
          						<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
          					</svg>
          					<span class="text-sm"><span class="card__value"><?php echo $args['tour']['hours']; ?></span> hours</span>
          				</div>
          				<div class="flex items-center gap-1 card__field">
          					<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
          						<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
          					</svg>
          					<span class="text-sm"><span class="card__value"><?php echo $args['tour']['bookings']; ?></span>+ bookings</span>
          				</div>
          			</div>
          		</div>
          		<div class="flex items-center justify-between pt-4 border-t border-gray-200 ">
          			<div class="card__field">
          				<span class="text-3xl font-bold text-deep-blue"><?php echo $args['currency'] ?><span class="card__value"><?php echo $args['tour']['price']; ?></span></span>
          				<span class="text-gray-500 text-sm ml-1">per person</span>
          			</div>
          			<a href="<?php echo $args['tour']['url']; ?>" target="_blank"
          				class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2 card__button">
          				BOOK NOW
          			</a>
          		</div>
          	</div>
          </div>