<?php
get_header(); ?>


<div class="container mx-auto pt-4">

	<h1 class="text-xl">
		<?php
		/* translators: Search query. */
		printf(__('Search Results for: %s', 'twentyseventeen'), '<span>' . get_search_query() . '</span>');
		?>
	</h1>

	<div class="flex flex-wrap lg:-mx-4">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="flex my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3 cursor-pointer" onclick="goToPost('<?= esc_url(get_permalink()) ?>')">
					<div class="overflow-hidden rounded-lg shadow-lg">
						<?php
						if (has_post_thumbnail($post->ID)) :
							the_post_thumbnail('ewpl-featured-image');
						else :
							echo '<img loading="lazy" src="' . get_template_directory_uri() . '/assets/images/default-thumb.jpg" />';
						endif;
						?>
						<div class="px-6 py-4">
							<div class="font-bold text-lg mb-2">
								<?php
								the_title('<a class="text-black" href="' . esc_url(get_permalink()) . '">', '</a>');
								?>
							</div>
							<p class="text-gray-700 text-base">
								<?php
								get_the_title();
								?>
							</p>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
	</div>

	<div class="row">
		<div class="w-full mx-auto">
			<div class="flex w-full justify-between">
				<?php if (get_previous_posts_link()) : ?>
					<div class="w-1/4">
						<a href="<?= get_previous_posts_page_link() ?>">
							<div class="h-full p-6">
								<h3 class="text-2xl mb-3 font-semibold inline-flex">
									<svg class="mr-2" width="24" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1.02698 11.9929L5.26242 16.2426L6.67902 14.8308L4.85766 13.0033L22.9731 13.0012L22.9728 11.0012L4.85309 11.0033L6.6886 9.17398L5.27677 7.75739L1.02698 11.9929Z" fill="currentColor" />
									</svg>
									Prev
								</h3>
							</div>
						</a>
					</div>
				<?php
				endif;
				if (get_next_posts_link()) : ?>
					<div class="w-1/4 ml-auto">
						<a href="<?= get_next_posts_page_link() ?>">
							<div class="h-full p-6 text-right">
								<h3 class="text-2xl mb-3 font-semibold inline-flex ">
									Next
									<svg class="ml-2" width="24" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M23.0677 11.9929L18.818 7.75739L17.4061 9.17398L19.2415 11.0032L0.932469 11.0012L0.932251 13.0012L19.2369 13.0032L17.4155 14.8308L18.8321 16.2426L23.0677 11.9929Z" fill="currentColor" />
									</svg>
								</h3>
							</div>
						</a>
					</div>

			<?php 
				endif;
			else : 
			?>
				<div class="w-full text-center my-4">
					<?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ewpl'); ?>
					<?php get_search_form(); ?>
				</div>
				
			<?php
			endif;
			?>
			</div>
		</div>
	</div>

</div>
<?php
get_footer();
