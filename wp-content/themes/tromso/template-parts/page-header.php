<div class="pt-32 pb-16 bg-gradient-to-b from-deep-blue to-ice-blue/20">
	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <?php if (isset($args['title']) && $args['title']!='') { ?>
		<h1 class="text-5xl font-bold text-deep-blue mb-6 text-center"><?php echo $args['title']; ?></h1>
    <?php } ?>
		<div class="text-xl text-gray-600 text-center max-w-2xl mx-auto"><?php echo $args['description']; ?></div>
	</div>
</div>