<?php /**
 * Plugin Name: Setting & Optins
 * Description: Настройки и опции
 */
add_action('admin_menu', 'wfm_menu_options');

add_action('admin_init', 'wfm_menu_check_options');

function wfm_menu_check_options(){
    //$option_group, $option_name
    register_setting('wfm_menu_options_group', 'wfm_theme_options', 'wfm_menu_options_sinitize');

    //$id, $title, $callback, $page
    add_settings_section('wfm_theme_options_section', 'Опции меню', '', 'wfm_menu_options_page');

    //$id, $title, $callback, $page, $section
    add_settings_field('wfm_body_option', 'Цвет body', 'wfm_theme_option_body', 'wfm_menu_options_page', 'wfm_theme_options_section');
    add_settings_field('wfm_header_option', 'Цвет header', 'wfm_theme_option_header', 'wfm_menu_options_page', 'wfm_theme_options_section');
}

function wfm_theme_option_body(){

    $options = get_option('wfm_theme_options');

        ?>
		<p>
			<input type="text" id="wfm_body_option" name="wfm_theme_options[wfm_body_option]"
				   value="<?php echo isset($options['wfm_body_option']) ? $options['wfm_body_option'] : ''; ?>"
				   class="regular-text"/>
		</p>

        <?php
}

function wfm_theme_option_header(){

    $options = get_option('wfm_theme_options');

        ?>
		<p>
			<input type="text" id="wfm_header_option"
				   name="wfm_theme_options[wfm_header_option]"
				   value="<?php echo isset($options['wfm_header_option']) ? $options['wfm_header_option'] : ''; ?>"
				   class="regular-text"/>
		</p>

        <?php
}

function wfm_menu_options_sinitize($options){
    if (!$options){
        return [];
    }

    $clear_options = [];

    foreach ($options as $k => $v){
        $clear_options[$k] = strip_tags($v);
    }

    return $clear_options;
}

function wfm_menu_options(){
    //$page_title, $menu_title, $capability, $menu_slug
    add_options_page('Опции меню', 'Опции меню', 'manage_options', 'wfm_menu_options_page', 'wfm_menu_options_cb');
}

function wfm_menu_options_cb(){

    ?>

	<div class="wrap">
		<h2>Опции темы</h2>
		<p>Добавляем свои опции для темы</p>

        <div class="updated">
            <p><strong>Настройки сохранены</strong></p>
        </div>

		<form action="options.php" method="post">
            <?php settings_fields('wfm_menu_options_group'); ?><?php /*var_dump(do_settings_sections('wfm_menu_options_page')); */
            ?><?php do_settings_sections('wfm_menu_options_page'); ?><?php submit_button(); ?>
		</form>

	</div>

    <?php
}

