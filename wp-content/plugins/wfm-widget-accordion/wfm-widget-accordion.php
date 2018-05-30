<?php
/*
Plugin Name: Виджет аккордеон
Description: Виджет выводит категории с помошью плагина аккордеон
 */

add_action('widgets_init', 'wfm_accordeon');
function wfm_accordeon(){
    register_widget('WFM_accordeon');
}

class WFM_accordeon extends WP_Widget{

    public $export_data;

    function __construct(){
        parent::__construct('wfm_accordeon', 'Виджет аккордеон', [
            'description' => 'Вывод категорий в виде аккордеона'
        ]);
    }

    function form($instance){
        $title = !empty($instance['title']) ? $instance['title'] : 'Категории';
        $eventType = isset($instance['eventType']) ? $instance['eventType'] : 'click';
        $speed = isset($instance['speed']) ? $instance['speed'] : 300;
        $disableLink = isset($instance['disableLink']) ? 1 : 0;

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title')?>">Заголовок</label>
            <input type="text" id="<?php echo $this->get_field_id('title')?>" name="<?php echo $this->get_field_name('title')?>" value="<?php echo $title; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('eventType')?>">Метод расскрытия</label>

            <select name="<?php echo $this->get_field_name('eventType')?>" id="<?php echo $this->get_field_id('eventType')?>">
                <option value="click" <?php selected('click', $eventType, true)?>>По клику</option>
                <option value="hover" <?php selected('hover', $eventType, true)?>>При наведении</option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('disableLink')?>">Переход по ссылке</label>
            <input type="checkbox" id="<?php echo $this->get_field_id('disableLink')?>" name="<?php echo $this->get_field_name('disableLink')?>" <?php checked($disableLink, 1, true);?>>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('speed')?>">Скорость раскрытия</label>
            <input type="text" id="<?php echo $this->get_field_id('speed')?>" name="<?php echo $this->get_field_name('speed')?>" value="<?php echo $speed; ?>">
        </p>

        <?php
    }

    function widget($args, $instance){

        if(isset($instance['title']) && !empty($instance['title'])){
            $instance['title'] = apply_filters( 'widget_title', $instance['title'] );
        }

        $this->export_data = [
            'eventType' => $instance['eventType'],
            'speed' => $instance['speed'],
            'disableLink' => $instance['disableLink'],
            'exclude' => $instance['exclude'],
        ];

        if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
            add_action('wp_footer', array( $this, 'wfm_accordeon_scripts' ));
            add_action('wp_footer', array( $this, 'wfm_accordeon_style' ) );
        }

        $categories = wp_list_categories([
            'title_li' => '',
            'echo' => false,
            'exclude' => $instance['exclude']
        ]);

        $html = $args['before_widget'];
        $html .= $args['before_title'];
        if(isset($instance['title'])) $html .= $instance['title'];
        $html .= $args['after_title'];
        $html .= '<ul class="wfm-accordeon" id="js-wfm-accordeon">';
        $html .= $categories;
        $html .= '</ul>';
        $html .= $args['after_widget'];

        echo $html;
    }

    function update($new_instance, $old_instance){
        $new_instance['title'] = (!empty($new_instance['title'])) ? $new_instance['title'] : 'Категории';
        $new_instance['eventType'] = ($new_instance['eventType'] === 'click') ? $new_instance['eventType'] : 'hover';
        $new_instance['disableLink'] = ($new_instance['disableLink'] === 'on') ? 'on' : null;
        $new_instance['exclude'] = (!empty($new_instance['exclude'])) ? $new_instance['exclude'] : '';
        $new_instance['speed'] = ((int)$new_instance['speed']) ? $new_instance['speed'] : 300;

        return $new_instance;
    }

    function wfm_accordeon_scripts(){
        wp_enqueue_script('jquery.cookie', plugins_url('js/jquery.cookie.js', __FILE__), ['jquery'], null, true);
        wp_enqueue_script('jquery.hoverIntent', plugins_url('js/jquery.hoverIntent.minified.js', __FILE__), ['jquery'], null, true);
        wp_enqueue_script('jquery.dcjqaccordion', plugins_url('js/jquery.dcjqaccordion.2.7.min.js', __FILE__), ['jquery'], null, true);
        wp_enqueue_script('wfm-accordeon-scripts', plugins_url('js/wfm-accordeon-scripts.js', __FILE__), ['jquery'], null, true);


        wp_localize_script('wfm-accordeon-scripts', 'wfmObj', $this->export_data);

    }

    function wfm_accordeon_style(){
        wp_enqueue_style('wmf-accordeon-style', plugins_url('css/wmf-accordeon-style.css', __FILE__));
    }
}


