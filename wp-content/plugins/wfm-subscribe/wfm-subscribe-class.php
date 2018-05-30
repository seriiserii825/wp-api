<?php 

class WFM_Subscribe extends WP_Widget{
    function __construct(){
        $args = [
            'name' => 'Виджет подписки',
            'description' => 'Виджет выводит форму для имени и email подписчика',
            'classname' => 'wfm-subscribe'
        ];

        parent::__construct('wfm_subscriber_id', '', $args);
    }

    function widget($args, $instance){
        add_action( 'wp_footer', 'wfm_subscribes_scripts' );

        $title = isset($instance['title']) ? $instance['title'] : '';
        $title = apply_filters( 'widget_title', $title );

        echo $args['before_widget'];
        echo $args['before_title'] . $title . $args['after_title'];

        ?>
            <form action="" method="post" id="wfm-form-subscribe">
                <p>
                    <label for="wfm-name">Имя:</label>
                    <input type="text" id="wfm-name" name="wfm-name">
                </p>

                <p>
                    <label for="wfm-email">E-mail:</label>
                    <input type="text" id="wfm-email" name="wfm-email">
                </p>

                <p>
                    <input type="submit" id="wfm-submit" value="Подписаться">
                    <span class="loader" style="display: none;">
                        <img src="<?php echo plugins_url('img/loader.gif', __FILE__); ?>" alt="">
                    </span>
                </p>
                <div class="ajax-result"></div>
            </form>
        <?php

        echo $args['after_widget'];

    }

    function form($instance){
        $title = isset($instance['title']) ? $instance['title'] : '';
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок: </label>
                <input type="text" 
                        id="<?php echo $this->get_field_id('title'); ?>" 
                        name="<?php echo $this->get_field_name('title'); ?>" 
                        value="<?php echo $title; ?>"
                        class="widefat">
            </p>
        <?php
    }
}

