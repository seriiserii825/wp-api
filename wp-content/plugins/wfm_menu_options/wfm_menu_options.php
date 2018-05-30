<?php /**
 * Plugin Name: Menu Options &amp; Settings
 * Description: Настройки и опции в разделе меню
 */
add_action('admin_menu', 'wfm_menu_options');

add_action('admin_init', 'wfm_menu_check_options');

function wfm_menu_check_options(){
    //$option_group, $option_name
    register_setting('wfm_menu_options_group_body', 'wfm_theme_options_body', 'wfm_menu_options_sinitize');
    register_setting('wfm_menu_options_group_header', 'wfm_theme_options_header', 'wfm_menu_options_sinitize');

    //$id, $title, $callback, $page
    add_settings_section('wfm_theme_options_section_body', 'Опции меню для body', '', 'wfm_body');

    add_settings_section('wfm_theme_options_section_header', 'Опции меню для header', '', 'wfm_header');

    //$id, $title, $callback, $page, $section
    add_settings_field('wfm_body_option', 'Цвет body', 'wfm_theme_option_body', 'wfm_body', 'wfm_theme_options_section_body');
    add_settings_field('wfm_body_color_option', 'Цвет текста body', 'wfm_theme_option_body_color', 'wfm_body', 'wfm_theme_options_section_body');
    add_settings_field('wfm_header_option', 'Цвет header', 'wfm_theme_option_header', 'wfm_header', 'wfm_theme_options_section_header');
    add_settings_field('wfm_header_color_option', 'Цвет текста header', 'wfm_theme_option_color_header', 'wfm_header', 'wfm_theme_options_section_header');

}

function wfm_theme_option_body_color(){
    $options = get_option('wfm_theme_options_body');
    ?>
	<p>
		<input type="text" id="wfm_body_color_option" name="wfm_theme_options_body[wfm_body_color_option]"
			   value="<?php echo isset($options['wfm_body_color_option']) ? $options['wfm_body_color_option'] : ''; ?>"
			   class="regular-text"/>
	</p>

    <?php
}

function wfm_theme_option_body(){

    $options = get_option('wfm_theme_options_body');

    ?>
	<p>
		<input type="text" id="wfm_body_option" name="wfm_theme_options_body[wfm_body_option]"
			   value="<?php echo isset($options['wfm_body_option']) ? $options['wfm_body_option'] : ''; ?>"
			   class="regular-text"/>
	</p>

    <?php
}

function wfm_theme_option_header(){

    $options = get_option('wfm_theme_options_header');

    ?>
	<p>
		<input type="text" id="wfm_header_option" name="wfm_theme_options_header[wfm_header_option]"
			   value="<?php echo isset($options['wfm_header_option']) ? $options['wfm_header_option'] : ''; ?>"
			   class="regular-text"/>
	</p>

    <?php
}

function wfm_theme_option_color_header(){

    $options = get_option('wfm_theme_options_header');

    ?>
	<p>
		<input type="text" id="wfm_header_color_option" name="wfm_theme_options_header[wfm_header_color_option]"
			   value="<?php echo isset($options['wfm_header_color_option']) ? $options['wfm_header_color_option'] : ''; ?>"
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
    //$page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position
    add_menu_page('menu_options', 'Опции для body', 'manage_options', 'wfm_menu_options', 'wfm_menu_options_cb', 'dashicons-welcome-widgets-menus');

    // $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function
    add_submenu_page('wfm_menu_options', 'Опции для header', 'Опции для header', 'manage_options', 'wfm_header', 'wfm_submenu_page');
}

function wfm_submenu_page(){

	?>
	<div class="wrap">
		<h2>Опции для header</h2>
		<p>Добавляем свои опции для темы</p>

		<form action="options.php" method="post">
            <?php
            settings_fields('wfm_menu_options_group_header');
            do_settings_sections('wfm_header');
            submit_button();
            ?>
		</form>

	</div>
	<?php
}

function wfm_menu_options_cb(){

    ?>

	<div class="wrap">
		<h2>Опции темы</h2>
		<p>Добавляем свои опции для темы</p>

		<form action="options.php" method="post">
            <?php
            settings_fields('wfm_menu_options_group_body');
            do_settings_sections('wfm_body');
            submit_button();
            ?>
		</form>

	</div>

    <?php
}

