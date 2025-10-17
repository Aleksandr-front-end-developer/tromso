<?php

/**
 * Template Name: Contact
 *
 * Front page php tempate
 */

get_header();

$post_id = get_the_ID();
?>
<main id="main" class="main">

	<?php get_template_part('template-parts/page', 'header', array('title'=>carbon_get_post_meta($post_id, 'cnt_section_1_title'), 'description'=>carbon_get_post_meta($post_id, 'cnt_section_1_description')));	  ?>

	<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
		<div class="grid md:grid-cols-2 gap-12">
			<div>
        <?php
        $title = carbon_get_post_meta($post_id, 'cnt_section_2_title');
        if (isset($title) && $title!='') {
        ?>
				<h2 class="text-3xl font-bold text-gray-900 mb-6"><?php echo $title; ?></h2>
        <?php } ?>
				<div class="text-gray-600 mb-8 leading-relaxed"><?php echo wpautop(carbon_get_post_meta($post_id, 'cnt_section_2_description')); ?></div>
				<div class="space-y-6">
					<div class="flex items-start gap-4">
						<div class="bg-ice-blue w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0">

							<svg class="svg svg--stroke lucide lucide-mail text-white" width="24" height="24">
								<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#mail'; ?>"></use>
							</svg>

						</div>
						<div>
              <?php
              $title = carbon_get_post_meta($post_id, 'cnt_section_2_email_title');
              if (isset($title) && $title!='') {
              ?>
							<h3 class="font-bold text-gray-900 mb-1"><?php echo $title; ?></h3>
              <?php } ?>
							<a href="mailto:<?php echo carbon_get_post_meta($post_id, 'cnt_section_2_email'); ?>" class="text-ice-blue hover:text-deep-blue transition-colors"><?php echo carbon_get_post_meta($post_id, 'cnt_section_2_email'); ?></a>
						</div>
					</div>
					<div class="flex items-start gap-4">
						<div class="bg-aurora-green w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
							<svg class="svg svg--stroke lucide lucide-phone text-white" width="24" height="24">
								<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#phone'; ?>"></use>
							</svg>

						</div>
						<div>
              <?php
              $title = carbon_get_post_meta($post_id, 'cnt_section_2_phone_title');
              if (isset($title) && $title!='') {
              ?>
							<h3 class="font-bold text-gray-900 mb-1"><?php echo $title; ?></h3>
              <?php } ?>
              <?php
                $phone = carbon_get_post_meta($post_id, 'cnt_section_2_phone');
                $cleaned_phone = preg_replace('/[^\d\+]/', '', $phone);
              ?>
							<a href="tel:<?php echo $cleaned_phone; ?>" class="text-ice-blue hover:text-deep-blue transition-colors"><?php echo $phone; ?></a>
							<div class="text-sm text-gray-500 mt-1"><?php echo wpautop(carbon_get_post_meta($post_id, 'cnt_section_2_phone_description')); ?></div>
						</div>
					</div>
					<div class="flex items-start gap-4">
						<div class="bg-deep-blue w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
							<svg class="svg svg--stroke lucide lucide-map-pin text-white" width="24" height="24">
								<use xlink:href="<?php echo THEME_URI . '/assets/img/icons/icons.svg#map-pin'; ?>"></use>
							</svg>

						</div>
						<div>
              <?php
              $title = carbon_get_post_meta($post_id, 'cnt_section_2_address_title');
              if (isset($title) && $title!='') {
              ?>
							<h3 class="font-bold text-gray-900 mb-1"><?php echo $title; ?></h3>
              <?php } ?>
							<p class="text-gray-600"><?php echo carbon_get_post_meta($post_id, 'cnt_section_2_address'); ?></p>
						</div>
					</div>
				</div>
				<div class="mt-8 p-6 bg-ice-blue/10 rounded-xl border border-ice-blue/20">
          <?php
          $title = carbon_get_post_meta($post_id, 'cnt_section_2_work_time');
          if (isset($title) && $title!='') {
          ?>
					<h3 class="font-bold text-gray-900 mb-2"><?php echo $title; ?></h3>
          <?php } ?>
					<div class="space-y-1 text-gray-600"><?php echo wpautop(carbon_get_post_meta($post_id, 'cnt_section_2_work_time_description')); ?></div>
				</div>
			</div>
			<div>
				<div class="bg-white rounded-xl shadow-lg p-8">
          <?php
          $title = carbon_get_post_meta($post_id, 'cnt_section_3_title');
          if (isset($title) && $title!='') {
          ?>
					<h2 class="text-2xl font-bold text-gray-900 mb-6"><?php echo $title; ?></h2>
          <?php } ?>
					<?php echo do_shortcode(carbon_get_post_meta($post_id, 'cnt_section_2_contact_form')); ?>

				</div>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
?>