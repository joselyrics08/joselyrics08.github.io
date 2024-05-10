
<?php $unique_id = uniqid(); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="relative my-2">
		<input type="search" id="<?php echo $unique_id; ?>" class="bg-cyan-white shadow rounded border-0 p-3"  placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentyseventeen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<div class="absolute pin-r pin-t mt-3 mr-4 text-cyan-lighter">
		</div>
		<button type="submit" class="search-submit bg-cyan-400 rounded p-3"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'twentyseventeen' ); ?></span></button>
	</div>
</form>
