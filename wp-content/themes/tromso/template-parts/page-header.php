<section class="pt-32 pb-16 bg-gradient-to-b from-deep-blue to-ice-blue/20">
	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
		<?php if (isset($args['title']) && $args['title'] != '') { ?>
			<h1 class="text-5xl font-bold text-deep-blue mb-6 text-center"><?php echo $args['title']; ?></h1>
		<?php } ?>
		<div class="text-xl text-gray-600 text-center max-w-2xl mx-auto"><?php echo $args['description']; ?></div>
	</div>
</section>

<section class="breadcrumbs">
	<div class="tour-hero__container max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
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