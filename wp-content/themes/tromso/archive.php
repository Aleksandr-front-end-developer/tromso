<?php

/**
 * The template for displaying archive pages
 */

get_header();

?>
<main id="main" class="main">

	<?php

	if (have_posts()) :

		get_template_part('template-parts/archive', get_post_type());

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main>

<?php
get_footer();
