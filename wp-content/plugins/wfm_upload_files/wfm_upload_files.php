<?php /**
 * Plugin Name: Upload files
 * Description: Загрузка файлов на сервер
 */
add_action('admin_menu', 'wfm_menu_options');

add_action('admin_init', 'wfm_menu_check_options');

function wfm_menu_check_options(){
    //$option_group, $option_name
    register_setting('wfm_theme_options_group', 'wfm_theme_options', 'wfm_menu_options_sinitize');

    //$id, $title, $callback, $page
    add_settings_section('wfm_theme_options_id', 'Опции темы', '', 'wfm_theme_options');

    //$id, $title, $callback, $page, $section
    add_settings_field('wfm_body_bg_id', 'Цвет body', 'wfm_body_bg_cb', 'wfm_theme_options', 'wfm_theme_options_id', ['for_id' => 'wfm_body_bg_id']);
    add_settings_field('wfm_body_pic_id', 'Цвет body', 'wfm_body_pic_cb', 'wfm_theme_options', 'wfm_theme_options_id', ['for_id' => 'wfm_body_pic_id']);

}
/*
function wfm_body_bg_cb(){
	$options = get_option('wfm_theme_options');
	*/?><!--
	<input type="text" id="wfm_body_bg_id" name="wfm_theme_options[body_bg]" value="<?php /*echo isset($options['body_bg']) ? $options['body_bg'] : '';*/?>" class="regular-text">
	<?php
/*}

function wfm_body_pic_cb(){
    //$options = get_option('wfm_theme_options');
    */?>
	<input type="file" id="wfm_body_pic_id" name="wfm_body_pic">
    --><?php
/*}*/

function wfm_menu_options_sinitize($options){

	//var_dump($options);



	return $options;
}

function wfm_menu_options(){
	//$page_title, $menu_title, $capability, $menu_slug, $function
    add_options_page('Опции темы', 'Опции темы', 'manage_options', 'wfm_theme_options', 'wfm_theme_options_cb');
}


function wfm_theme_options_cb(){

    ?>

	<div class="wrap">
		<h2>Опции темы</h2>
		<p>Добавляем свои опции для темы</p>

		<form action="options.php" method="post" enctype="multipart/form-data">
            <?php
            settings_fields('wfm_theme_options_group');
            do_settings_sections('wfm_theme_options');
            submit_button();
            ?>
		</form>

	</div>

    <?php
}

