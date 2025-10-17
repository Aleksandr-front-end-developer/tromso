          <a href="<?php echo $args['tour']['url']; ?>" class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group">
          	<div class="relative overflow-hidden h-64">
          		<?php
							$image = intval($args['tour']['image']);
							if ($image > 0) echo wp_get_attachment_image($image, 'full', false, array('class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110'));
							?>
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
          	<div class="p-6">
          		<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]"><?php echo $args['tour']['title']; ?></h3>
          		<div class="card-description">
          			<p>Take part in 3 amazing activities on 1 tour from La Fortuna. Hike the volcanic paths around the magnificent <strong>Arenal Volcano</strong>, witnessing <strong>Arenal Volcano’s</strong> dramatic landscapes up close. See the spectacular cascades of La Fortuna waterfall nestled in the <strong>Arenal Volcano</strong> region, and walk through the rainforest canopy on the suspension bridges of the Arenal Hanging Bridges park, offering breathtaking views of <strong>Arenal Volcano</strong> from above.</p>
          		</div>
          		<div class="mb-4">
          			<div class="flex items-center gap-1">
          				<?php echo get_rating_stars($args['tour']['rating'], 16); ?>
          				<span class="ml-2 text-sm font-medium text-gray-700"><?php echo $args['tour']['rating']; ?></span>
          			</div>
          		</div>
          		<div class="flex items-center gap-4 mb-4 text-gray-600">
          			<div class="flex items-center gap-1">
          				<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
          					<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
          				</svg>
          				<span class="text-sm"><?php echo $args['tour']['hours']; ?> hours</span>
          			</div>
          			<div class="flex items-center gap-1">
          				<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
          					<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
          				</svg>
          				<span class="text-sm"><?php echo $args['tour']['bookings']; ?>+ bookings</span>
          			</div>
          		</div>
          		<div class="flex items-center justify-between pt-4 border-t border-gray-200">
          			<div>
          				<span class="text-3xl font-bold text-deep-blue"><?php echo $args['currency'] . $args['tour']['price']; ?></span>
          				<span class="text-gray-500 text-sm ml-1">per person</span>
          			</div>
          			<button
          				class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2">
          				LEARN MORE
          			</button>
          		</div>
          	</div>
          </a>