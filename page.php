<?php
get_header(); ?>

<div class="container mx-auto pt-4">
	<div class="flex flex-wrap mb-4">
		<div class="w-full lg:w-3/4 xl:w-3/4 px-4">
			<?php
			the_post();
			get_template_part('template-parts/page/content-page', 'page');
			?>
		</div>
		<div class="w-full lg:w-1/4 xl:w-1/4">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php
get_footer();
