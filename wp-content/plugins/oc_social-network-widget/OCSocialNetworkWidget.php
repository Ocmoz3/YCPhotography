<?php
/**
 * Plugin Name: OC Social Network Widget
 * Description: Adds social network links.
 * Version: 1.0
 * Author: Orianne Cielat
 */

require_once('social-network-widget-functions.php');

/**
 * The class of Social Network widget
 */ 
class OC_Social_Network_Widget extends WP_Widget 
{

    /**
	 * Register widget with WordPress.
	 */
    public $fields = [];
    public function __construct()
    {
        $widget_options = array (
            'description' => 'Add a call to action box with your own text and link.'
           );
        parent::__construct('oc_social_contact_widget', 'Social Widget Contact', $widget_options);
        $this->fields = [
            'twitter' => 'Twitter',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'snapchat' => 'Snapchat',
            'linkedin' => 'Linkedin',
            'viadeo' => 'Viadeo',
            'pinterest' => 'Pinterest',
            'flickr' => 'Flickr',
            'medium' => 'Medium',
            'youtube' => 'Youtube',
            'tiktok' => 'Tiktok',
            'dailymotion' => 'Dailymotion',
            'periscope' => 'Periscope',
            'reddit' => 'Reddit',
            'spotify' => 'Spotify',
            'deezer' => 'Deezer',
            'soundcloud' => 'Soundcloud',
        ];
    }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
    public function widget($args, $instance): void {
        $widget_id = $args['id'];
        require('data/networks.php');
        ?>
        <!-- SOCIAL NETWORKS -->
        <div class="div_around_social_network">
            <?php 
            foreach($networks as $name => $networkItems): 
                if(!empty($instance[$name])): 
                ?>
                    <div class="div_element_social element_<?php echo esc_html($networkItems['name']) ?>">
                        <a class="social_link" href="<?php echo esc_url($instance[$name]) ?>" target="_blank" title="<?php echo sprintf(esc_attr('Me suivre sur %s'), $networkItems['label']); ?>"><?php echo $networkItems['icon'] ?></a>
                    </div>
                <?php 
                endif;
            endforeach; 
            ?>
        </div>
    <?php
    }

    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
    public function form($instance): void {
        foreach($this->fields as $field => $label) {
            $value = $instance[$field] ?? '';
            ?>
            <p>
                <label for="<?php echo $this->get_field_id($field) ?>"><?php echo esc_html($label) ?></label>
                <input
                    type="text"
                    class="widefat"
                    name="<?php echo $this->get_field_name($field) ?>"
                    id="<?php echo $this->get_field_id($field) ?>"
                    value="<?php echo esc_attr($value) ?>"
                >
            </p>
        <?php
        }
    }

    /**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
    public function update($newInstance, $oldInstance): array
    {
        $output = [];
        foreach($this->fields as $field => $label) {
            if(!empty($newInstance[$field])) {
                $output[$field] = $newInstance[$field];
            }
        }
        return $output;
    }

}