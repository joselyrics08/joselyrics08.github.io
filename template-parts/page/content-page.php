<article id="post-<?php the_ID(); ?>" <?php post_class('post-container'); ?>>
	<div class="px-1 md:px-6 md:py-4">

		<header class="entry-header">
			<?php the_title('<div class="font-bold text-xl my-2">', '</div>'); ?>
			<div class="entry-meta">
				<?php //twentyseventeen_posted_on(); 
				?>
			</div>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

	</div>

</article>