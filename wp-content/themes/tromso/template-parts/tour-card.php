<?php
$tour = get_post($args['tour']['id']);
if (!is_null($tour))
{
  $lng = get_current_language();
  $default_lng = get_default_language();
  $post_page = get_permalink($tour->ID);
  $terms = wp_get_post_terms( $tour->ID, 'tours-category', ['fields' => 'all'] );
  if ($lng==$default_lng)
  {
    $default_terms = $terms;
  
  } else
  {
    $default_terms = array();
    foreach ($terms as $term)
    {
      $new_term = get_language_term($term->term_id, $default_lng);
      $default_terms[] = get_term($new_term);    
    }
  }
  
  $bestseller = false;
  $toprated = false;
  foreach ($default_terms as $term)
  {
    if ($term->name=='Best seller') $bestseller = true;
    if ($term->name=='Top rated') $toprated = true;
  }
  
  $meta = get_post_meta($tour->ID);
?>
          <div class="card bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] group flex flex-col">
          	<div class="relative overflow-hidden h-64">

          		<a href="<?php echo $post_page; ?>">
          			<?php
								echo get_the_post_thumbnail($tour->ID, 'full', array('class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110'));
								?>
          		</a>

          		<div class="absolute top-4 left-4 flex gap-2">
          			<?php if ($bestseller) { ?>
          				<span class="bg-aurora-green text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide"><?php _e('BEST SELLER', 'tromso'); ?></span>
          			<?php
								}
								if ($toprated) {
								?>
          				<span class="bg-ice-blue text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide"><?php _e('TOP RATED', 'tromso'); ?></span>
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
          		<a href="<?php echo $post_page; ?>" class=" button-read"><?php _e('Read more', 'tromso'); ?></a>


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
          					<span class="text-sm"><span class="card__value"><?php echo $hours; ?></span> <?php _e('hours', 'tromso'); ?></span>
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
          					<span class="text-sm"><span class="card__value"><?php echo number_format($bookings, 0, '', '.'); ?></span>+ <?php _e('bookings', 'tromso'); ?></span>
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
          				<span class="text-gray-500 text-sm ml-1 per-person"></span>
          			</div>
                <?php } } ?>
          			<a href="<?php echo $post_page; ?>" target="_blank"
          				class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2 card__button">
          				<?php _e('CHECK AVAILABILITY', 'tromso'); ?>
          			</a>
                <?php
                /*if (isset($meta['_tour_url'][0]))
                {
                  $url = $meta['_tour_url'][0];
                  if ($url!='')
                  {
                ?>
          			<a href="<?php echo $url; ?>" target="_blank"
          				class="px-6 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 bg-aurora-green text-white hover:bg-green-600 shadow-lg hover:shadow-xl px-6 py-2 card__button">
          				<?php _e('CHECK AVAILABILITY', 'tromso'); ?>
          			</a>
                <?php } }*/ ?>
          		</div>
          	</div>
          </div>
<?php
}
?>
