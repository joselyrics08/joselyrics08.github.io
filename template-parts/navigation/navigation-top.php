<nav class="flex items-center justify-between flex-wrap bg-cyan-500 p-3">
	<div class="flex items-center flex-shrink-0 text-white mr-6">
		<span class="font-semibold text-xl tracking-tight">
			<a class="text-white" href="/"><?php (has_custom_logo()) ? the_custom_logo() : bloginfo('name'); ?></a>
		</span>
	</div>

	<label class="block lg:hidden cursor-pointer flex items-center px-3 py-2 border rounded text-cyan-200 border-cyan-400 hover:text-white hover:border-white" for="menu-toggle">
		<svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
			<title>Menu</title>
			<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
		</svg>
	</label>

	<input class="hidden" type="checkbox" id="menu-toggle" />
	<div class="hidden w-full block flex-grow lg:flex lg:items-center lg:w-auto" id="menu">
		<div class="text-sm lg:flex-grow">
		</div>
		<div class="block">
			<?php if (has_nav_menu('top')) : ?>
				<?php
				wp_nav_menu(array(
					'menu_class'        => 'top-menu',
					'link_before'       => '<span class="block mt-4 lg:inline-block lg:mt-0 text-cyan-200 hover:text-white mr-4">',
					'link_after'        => "</span>",
					'theme_location'    => 'top',
				));
				?>
			<?php endif; ?>

		</div>
	</div>
</nav>