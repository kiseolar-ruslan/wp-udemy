<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<h1><?php the_title(); ?></h1>
	<div><?php the_content(); ?></div>
	<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more..' );?></a>
</article>
