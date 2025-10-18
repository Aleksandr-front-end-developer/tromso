<?php

/**
 * Template Name: Sitemap
 *
 * Front page php tempate
 */

get_header();

$post_id = get_the_ID();
?>
<main id="main" class="main">

  <?php
	$title = carbon_get_post_meta($post_id, 'stm_section_1_title');
  $description = carbon_get_post_meta($post_id, 'stm_section_1_description');
  if (check_cf($title) || check_cf($description)) {
    get_template_part('template-parts/page', 'header', array('title'=>$title, 'description'=>$description));
  }
  ?>


	<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <?php
    $blocks = carbon_get_post_meta($post_id, 'stm_section_2_list');
    if (check_cf_complex($blocks)) {
    ?>
		<div class="grid md:grid-cols-3 gap-8">
      <?php
      if (is_array($blocks))
      {
        foreach ($blocks as $block)
        {
        ?>
			<div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
				<div class="flex items-center gap-3 mb-6">
					<div class="bg-ice-blue w-12 h-12 rounded-lg flex items-center justify-center">
            <?php
            if ($block['icon']=='home')
            {
            ?>
						<svg class="svg svg--stroke lucide lucide-home text-white" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#home'; ?>"></use>
						</svg>
            <?php
            } elseif ($block['icon']=='page1')
            {
            ?>
						<svg class="svg svg--stroke lucide lucide-file-text text-white" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#file-text'; ?>"></use>
						</svg>
            <?php
            } elseif ($block['icon']=='page2')
            {
            ?>
						<svg class="svg svg--stroke lucide lucide-map text-white" width="24" height="24">
							<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#map'; ?>"></use>
						</svg>
            <?php
            }
            ?>

					</div>
          <?php if (isset($block['title']) && $block['title']!='') { ?>
					<h2 class="text-2xl font-bold text-gray-900"><?php echo $block['title']; ?></h2>
					<?php } ?>
				</div>
				<ul class="space-y-3">
          <?php
          $from = $block['select_pages_from'];
          if ($from=='list')
          {
            $items =array();
            foreach ($block['pages_list'] as $list_item)
            {
              $items[] = array('title'=>get_the_title($list_item['id']), 'url'=>get_permalink($list_item['id']));  
            }
          }
          elseif ($from=='custom') $items = $block['custom_urls'];

          if (is_array($items))
          {
            foreach ($items as $item)
            {
            ?>
					<li>
						<a class="text-ice-blue hover:text-deep-blue transition-colors font-medium flex items-center gap-2" href="<?php echo $item['url']; ?>" data-discover="true"><span class="w-2 h-2 bg-ice-blue rounded-full"></span><?php echo $item['title']; ?></a>
					</li>
          <?php
            }
          }
          ?>
				</ul>
			</div>
          <?php  
        }
      }
      ?>
		</div>
    <?php } ?>
    
    <?php
    $title = carbon_get_post_meta($post_id, 'stm_section_3_title');
    $description = carbon_get_post_meta($post_id, 'stm_section_3_description');
    $button_url = carbon_get_post_meta($post_id, 'stm_section_3_button_url');
    $button_title = carbon_get_post_meta($post_id, 'stm_section_3_button_title');
    if (check_cf($title) || check_cf($description) || check_cf($button_url) || check_cf($button_title)) {
    ?>
		<div class="mt-12 bg-ice-blue/10 rounded-xl p-8 border border-ice-blue/20">
      <?php
      if (isset($title) && $title!='') {
      ?>
			<h2 class="text-2xl font-bold text-gray-900 mb-4"><?php echo $title; ?></h2>
      <?php } ?>
			<div class="text-gray-600 mb-4 leading-relaxed"><?php echo wpautop(carbon_get_post_meta($post_id, 'stm_section_3_description')); ?></div>
			<a class="inline-flex items-center gap-2 px-6 py-3 bg-ice-blue text-white rounded-lg font-semibold hover:bg-deep-blue transition-colors" href="<?php echo $button_url; ?>" data-discover="true">
				<svg class="svg svg--stroke lucide lucide-mail" width="20" height="20">
					<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#mail'; ?>"></use>
				</svg>
				<?php echo $button_title; ?></a>
		</div>
    <?php } ?>
	</div>

</main>
<?php
get_footer();
?>