<?php
class Latest_posts_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'latest_posts',
            'Earnify - Latest Posts Widget',
            array('description' => __('Latest Posts '))
        );
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
        $instance['direction'] = strip_tags($new_instance['direction']);
        return $instance;
    }


    function form($instance)
    {
        if ($instance) {
            $title = esc_attr($instance['title']);
            $numberOfListings = esc_attr($instance['numberOfListings']);
            $direction = esc_attr($instance['direction']);
        } else {
            $title = '';
            $numberOfListings = '';
            $direction = '';
        }
?>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'latest_posts'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        <label for="<?php echo $this->get_field_id('numberOfListings'); ?>"><?php _e('Number of Listings:', 'latest_posts'); ?></label>
        <select id="<?php echo $this->get_field_id('numberOfListings'); ?>" name="<?php echo $this->get_field_name('numberOfListings'); ?>">
            <?php for ($x = 1; $x <= 10; $x++) : ?>
                <option <?php echo $x == $numberOfListings ? 'selected="selected"' : ''; ?> value="<?php echo $x; ?>"><?php echo $x; ?></option>
            <?php endfor; ?>
        </select>
        <label for="<?php echo $this->get_field_id('direction'); ?>"><?php _e('Direction:', 'latest_posts'); ?></label>
        <select id="<?php echo $this->get_field_id('direction'); ?>" name="<?php echo $this->get_field_name('direction'); ?>">
            <option <?php echo $direction == 'column' ? 'selected="selected"' : ''; ?> value="column">Column</option>
            <option <?php echo $direction == 'row' ? 'selected="selected"' : ''; ?> value="row">row</option>
        </select>

<?php
    }


    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $numberOfListings = $instance['numberOfListings'];
        $direction = $instance['direction'];
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        $this->getRealtyListings($numberOfListings, $direction);
        echo $after_widget;
    }

    function getRealtyListings($numberOfListings, $direction)
    { 
        global $post;
        $listings = new WP_Query();
        $listings->query('posts_per_page=' . $numberOfListings);
        if ($listings->found_posts > 0) {

            echo '<div class="'.($direction == 'row' ? 'flex flex-wrap ' : '').'">';

            while ($listings->have_posts()) {
                $listings->the_post();

?>
                <div class="cursor-pointer my-3 px-1 w-full <?=$direction == 'row' ? 'flex flex-row md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3' : '' ?>"  onclick="goToPost('<?= esc_url(get_permalink()) ?>')">
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <?php
                        if (has_post_thumbnail($post->ID)) :
                            the_post_thumbnail('ewpl-featured-image');
                        else :
                            echo '<img src="' . get_template_directory_uri() . '/assets/images/default-thumb.jpg" />';
                        endif;
                        ?>
                        <div class="px-6 py-2">
                            <div class="font-bold text-lg">
                                <a class="text-black" href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
                            </div>
                        </div>
                    </div>
                </div>

<?php
            }

            echo '</div>';

            wp_reset_postdata();
        }
    }
}
register_widget('latest_posts_Widget');
