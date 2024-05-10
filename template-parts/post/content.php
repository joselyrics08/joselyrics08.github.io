<article id="post-<?php the_ID(); ?>" <?php post_class('post-container'); ?>>
	<div class="px-1 md:px-6 md:py-4">

		<?= ewpl_resolve_ads('ad_top'); ?>

		<header class="entry-header">
			<?php the_title('<div class="font-bold text-xl my-2">', '</div>'); ?>
			<div class="entry-meta">
				<?php //twentyseventeen_posted_on(); 
				?>
			</div>
		</header>

		<?= ewpl_resolve_ads('ad_post_top'); ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<?= ewpl_resolve_ads('ad_post_bottom'); ?>

		<?php
		if (get_theme_mod('show_nextbutton')) {
			global $multipage, $numpages, $page;

			echo '<div class="post-nav">';

			if ($page == 1) {
				previous_post_link('%link', '<div class="post-nav__link">←<span class="hidden lg:inline">  ANTERIOR</span></div>');
			}
			wp_link_pages(array(
				'before' => '',
				'after' => ' ',
				'link_before' => '<div class="post-nav__link">',
				'link_after' => '</div>',
				'next_or_number' => 'next',
				'nextpagelink' => 'SIGUIENTE<span class="hidden lg:inline"> PÁGINA</span> →',
				'previouspagelink' => '←<span class="hidden lg:inline">  ANTERIOR</span>'
			));

			if ($page == $numpages) {
				next_post_link('%link', '<div class="post-nav__link">SIGUIENTE<span class="hidden lg:inline"> PÁGINA →</div>');
			}

			echo '</div>';
		}	
		?>

		<?= ewpl_resolve_ads('ad_bottom'); ?>

	</div>

</article>