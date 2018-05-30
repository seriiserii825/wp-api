<?php
/*
Plugin Name: Первый виджет
Description: Создаем первый виджет
*/

add_action('widgets_init', 'wfm_first_widget');

function wfm_first_widget(){
    register_widget('WFM_fw');
}

class WFM_fw extends WP_Widget{
    function __construct(){
        parent::__construct(
            'wfm_fw',
            'Первый виджет',
            [
                'description' => 'тестовый первый виджет',
				'classname' => 'my_widget'
            ]
        );
    }

    function form($instance){
        ?>

		<p>
            <label for="<?php echo $this->get_field_id('title')?>">Заголовок</label>
            <input type="text" name="<?php echo $this->get_field_name('title')?>" id="<?php echo $this->get_field_id('title')?>" value="<?php if(isset($instance['title'])) echo esc_attr($instance['title']); ?>" class="widefat">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text')?>">Контент</label>

			<textarea name="<?php echo $this->get_field_name('text')?>" id="<?php echo $this->get_field_id('text')?>" class="widefat" rows="7">
				<?php if(isset($instance['text'])) echo esc_attr($instance['text']); ?>
			</textarea>

        </p>

        <?php
    }

    function widget($args, $instance){
        $title = apply_filters('widget_title', $instance['title']);
        $text = apply_filters('widget_text', $instance['text']);

        echo $args['before_widget'];
        echo $args['before_title'];
        echo $title;
        echo $args['after_title'];
        echo $text;
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance){
    	$new_instance['text'] = str_replace('<p>', '', $new_instance['text']);
    	$new_instance['text'] = str_replace('</p>', '<br>', $new_instance['text']);

        return $new_instance;
    }
}
