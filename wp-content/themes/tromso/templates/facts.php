<?php

/**
 * Template Name: Facts
 *
 * Front page php tempate
 */

get_header();

$post_id = get_the_ID();
?>
<main id="main" class="main">

	<?php get_template_part('template-parts/page', 'header', array('title'=>carbon_get_post_meta($post_id, 'aun_section_1_title'), 'description'=>carbon_get_post_meta($post_id, 'aun_section_1_description')));	  ?>

  <div id="tours_block">
    <?php
    $currency = carbon_get_post_meta($post_id, 'currency_symbol');
    $tour_blocks = carbon_get_post_meta($post_id, 'aun_tours');
    if (is_array($tour_blocks)) {
      foreach ($tour_blocks as $tour_block) {
    ?>
        <section id="<?php echo $tour_block['anchor']; ?>" class="py-20" style="background-color:<?php echo $tour_block['background']; ?>">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
              <h2 class="text-4xl sm:text-5xl font-bold text-deep-blue mb-4"><?php echo $tour_block['title']; ?></h2>
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
  <div class="content max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16"><?php the_content() ?></div>
</main>
<?php
get_footer();
?>