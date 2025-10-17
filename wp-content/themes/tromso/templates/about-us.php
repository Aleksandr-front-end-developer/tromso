<?php

/**
 * Template Name: About Us
 *
 * Front page php tempate
 */

get_header();

$post_id = get_the_ID();
?>
<main id="main" class="main">

	<?php get_template_part('template-parts/page', 'header', array('title'=>carbon_get_post_meta($post_id, 'au_section_1_title'), 'description'=>carbon_get_post_meta($post_id, 'au_section_1_description')));	  ?>

	<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <?php
    $blocks = carbon_get_post_meta($post_id, 'au_section_2_blocks');
    if (is_array($blocks))
    {
      foreach ($blocks as $block)
      {
        if ($block['image_side']=='r')
        {
        ?>
		<div class="grid md:grid-cols-2 gap-12 mb-16">
			<div class="flex flex-col justify-center order-2 md:order-1">
        <?php if (isset($block['title']) && $block['title']!='') { ?>
				<h2 class="text-3xl font-bold text-gray-900 mb-4"><?php echo $block['title']; ?></h2>
        <?php } ?>
				<div class="text-gray-600 mb-4 leading-relaxed"><?php echo wpautop($block['description']); ?></div>
			</div>
			<div class="order-1 md:order-2">
        <?php
        $image = intval($block['image']);
        if ($image>0) echo wp_get_attachment_image( $image, 'full', false, array('class'=>'rounded-xl shadow-lg w-full h-[400px] object-cover') );
        ?>
			</div>
		</div>
        <?php  
        } else
        {
        ?>
		<div class="grid md:grid-cols-2 gap-12 mb-16">
			<div>
        <?php
        $image = intval($block['image']);
        if ($image>0) echo wp_get_attachment_image( $image, 'full', false, array('class'=>'rounded-xl shadow-lg w-full h-[400px] object-cover') );
        ?>
			</div>
			<div class="flex flex-col justify-center">
        <?php if (isset($block['title']) && $block['title']!='') { ?>
				<h2 class="text-3xl font-bold text-gray-900 mb-4"><?php echo $block['title']; ?></h2>
        <?php } ?>
				<div class="text-gray-600 mb-4 leading-relaxed"><?php echo wpautop($block['description']); ?></div>
			</div>
		</div>
        <?php  
        }
      }
    }
    ?>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
      <?php
      $cards = carbon_get_post_meta($post_id, 'au_section_3_cards');
      if (is_array($cards))
      {
        foreach ($cards as $card)
        {
      ?>
			<div class="text-center p-6 bg-white rounded-xl shadow-md">
				<div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: <?php echo $card['image_background']; ?>;">
          <?php
          $image = intval($card['image']);
          if ($image>0) echo wp_get_attachment_image( $image, array(32,32), false );
          ?>
				</div>
        <?php if (isset($card['title']) && $card['title']!='') { ?>
				<h3 class="text-2xl font-bold text-gray-900 mb-2"><?php echo $card['title']; ?></h3>
        <?php } ?>
				<div class="text-gray-600"><?php echo wpautop($card['description']); ?></div>
			</div>
      <?php    
        }
      }
      ?>
		</div>
		<div class="bg-gradient-to-r from-ice-blue to-deep-blue rounded-xl p-8 md:p-12 text-white text-center">
      <?php 
      $title = carbon_get_post_meta($post_id, 'au_section_4_title');
      if (isset($title) && $title!='') {
      ?>
			<h2 class="text-3xl font-bold mb-4"><?php echo $title; ?></h2>
      <?php } ?>
			<div class="grid md:grid-cols-3 gap-8 mt-8">
        <?php
        $blocks = carbon_get_post_meta($post_id, 'au_section_4_blocks');
        if (is_array($blocks))
        {
          foreach ($blocks as $block)
          {
        ?>
				<div>
          <?php if (isset($block['title']) && $block['title']!='') { ?>
					<h3 class="text-xl font-bold mb-2"><?php echo $block['title']; ?></h3>
          <?php } ?>
					<div class="text-white/90"><?php echo wpautop($block['description']); ?></div>
				</div>
        <?php    
          }
        }
        ?>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
?>