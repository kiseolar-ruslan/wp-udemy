<?php

get_header();

$term = get_term_by(
	'slug',
	get_query_var( 'term' ),
	get_query_var( 'taxonomy' )
);

echo $term->name;

?>

<div>
	<?php
	if (have_posts() === true) {
		while (have_posts() === true) {
			the_post();
			get_template_part('partials/content', 'car');
		}
	} else {
		get_template_part('partials/content-none', 'none');
	}
	?>
</div>
