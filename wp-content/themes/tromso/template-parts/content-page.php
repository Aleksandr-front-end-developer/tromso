<?php

/**
 * Template part for displaying page content in page.php
 */
?>

<?php get_template_part('template-parts/page', 'title');	  ?>


<div class="content max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
	<div class="prose prose-lg max-w-none">
		<?php echo the_content()  ?>
	</div>
</div>