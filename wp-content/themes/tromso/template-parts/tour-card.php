<?php
$tour = get_post($args['tour']['id']);
if (!is_null($tour))
{
  $post_page = get_permalink($tour->ID);
  $terms = wp_get_post_terms( $tour->ID, 'tours-category', ['fields' => 'names'] );
  $meta = get_post_meta($tour->ID);
?>
          <div class="card bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group flex flex-col">
          	<div class="relative overflow-hidden h-64">

          		<a href="<?php echo $post_page; ?>" target="_blank">
          			<?php
								echo get_the_post_thumbnail($tour->ID, 'full', false, array('class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110'));
								?>
          		</a>

          		<div class="absolute top-4 left-4 flex gap-2">
          			<?php if (array_search('Best seller', $terms) !== false) { ?>
          				<span class="bg-aurora-green text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">BEST SELLER</span>
          			<?php
								}
								if (array_search('Top rated', $terms) !== false) {
								?>
          				<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">TOP RATED</span>
          			<?php } ?>
          		</div>
          	</div>
          	<div class="p-6 card__texts">
          		<?php if ($tour->post_title != '') { ?>
          			<h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]"><?php echo $tour->post_title; ?></h3>
          		<?php } ?>
          		<div class="card-description">
          			<?php echo wpautop($tour->post_content); ?>
          		</div>
          		<a href="<?php echo $post_page; ?>" class=" button-read">Read more</a>


          		<div class="card__wrapper-info">
          			<div class=" card__stars">
          				<div class="flex items-center gap-1">
          					<?php
                    if (isset($meta['_tour_rating'][0]))
                    {
                      $rating = floatval($meta['_tour_rating'][0]);
                      if ($rating>0 && $rating<=5)
                      {
                        echo get_rating_stars($rating, 16);
                    ?>
          					<span class="ml-2 text-sm font-medium text-gray-700"><?php echo $rating; ?></span>
                    <?php } } ?>
          				</div>
          			</div>
          			<div class="flex items-center gap-4 mb-4 mt-4 text-gray-600">
                  <?php
                  if (isset($meta['_tour_hours'][0]))
                  {
                    $hours = floatval($meta['_tour_hours'][0]);
                    if ($hours>0)
                    {
                  ?>
          				<div class="flex items-center gap-1 card__field">
          					<svg class="svg svg--stroke lucide lucide-clock" width="18" height="18">
          						<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#clock'; ?>"></use>
          					</svg>
          					<span class="text-sm"><span class="card__value"><?php echo $hours; ?></span> hours</span>
          				</div>
                  <?php } } ?>
                  <?php
                  if (isset($meta['_tour_bookings'][0]))
                  {
                    $bookings = floatval($meta['_tour_bookings'][0]);
                    if ($bookings>0)
                    {
                  ?>
          				<div class="flex items-center gap-1 card__field">
          					<svg class="svg svg--stroke lucide lucide-users" width="18" height="18">
          						<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#users'; ?>"></use>
          					</svg>
          					<span class="text-sm"><span class="card__value"><?php echo $bookings; ?></span>+ bookings</span>
          				</div>
                  <?php } } ?>
          			</div>
          		</div>
          		<div class="flex items-center justify-between pt-4 border-t border-gray-200 ">
                <?php
                if (isset($meta['_tour_price'][0]))
                {
                  $price = floatval($meta['_tour_price'][0]);
                  if ($price>0)
                  {
                ?>
          			<div class="card__field">
          				<span class="text-3xl font-bold text-deep-blue"><?php echo $meta['_tour_currency'][0]; ?><span class="card__value"><?php echo $price; ?></span></span>
          				<span class="text-gray-500 text-sm ml-1">per person</span>
          			</div>
                <?php } } ?>
                <?php
                if (isset($meta['_tour_url'][0]))
                {
                  $url = $meta['_tour_url'][0];
                  if ($url!='')
                  {
                ?>
          			<a href="<?php echo $url; ?>" target="_blank"
          				class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2 card__button">
          				BOOK NOW
          			</a>
                <?php } } ?>
          		</div>
          	</div>
          </div>
<?php
}
?>
