<?php
/*
Plugin Name: Сбор подписчиков
Description: Плагин добавляет подписчики в базу данных
 */
include_once __DIR__ . '/wfm-helpers.php';
include_once __DIR__ . '/wfm-subscribe-class.php';
include_once __DIR__ . '/wfm-ajax-functions.php';

register_activation_hook(__FILE__, 'wfm_create_table');

add_action('widgets_init', 'wfm_create_widget');
add_action('wp_ajax_wfm_subscriber', 'wfm_ajax_subscriber');
add_action('wp_ajax_nopriv_wfm_subscriber', 'wfm_ajax_subscriber');
add_action('admin_menu', 'wfm_admin_menu');
add_action('wp_ajax_wfm_subscriber_admin', 'wfm_ajax_admin');

function wfm_create_table(){
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $table_name = $wpdb->get_blog_prefix() . 'wfm_subscribes';

    $sql = "CREATE TABLE {$table_name} (
    id  int(5) unsigned NOT NULL auto_increment,
    name varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    PRIMARY KEY  (id)
)";

    dbDelta($sql);
}

function wfm_create_widget(){
    register_widget('WFM_Subscribe');
}

function wfm_subscribes_scripts(){
    wp_enqueue_script('wfm-subscribe', plugins_url('js/wfm-subscribe.js', __FILE__), ['jquery'], null, true);
    wp_localize_script('wfm-subscribe', 'wfmajax', [
        'url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('wfmajax')
    ]);
}

function wfm_admin_menu(){
    //$page_title, $menu_title, $capability, $menu_slug
    add_options_page('Подписчики', 'Подписчики', 'manage_options', 'wfm-subscriber', 'wfm_subscriber_page');

    add_action( 'admin_enqueue_scripts', 'wfm_scripts' );
}

function wfm_subscriber_page(){
   ?> 
    <div class="wrap">
        <h2>Подписчики</h2>

        <?php 
            $pagination_params = get_page_params();
            $subscribers = get_subscribers();
        ?>

        <p>Колличество подписчиков: <?php echo $pagination_params['count'];?></p>


        <table class="wp-list-table widefat wfm-table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Имя</td>
                    <td>E-mail</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach($subscribers as $subscriber): ?>
                    <tr>
                        <td><?php echo $subscriber['id']; ?></td>
                        <td><?php echo $subscriber['name']; ?></td>
                        <td><?php echo $subscriber['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- pagination -->
        <?php if($pagination_params['count'] > 1): ?>
            <div class="pagination">
                <?php echo pagination($pagination_params['page'], $pagination_params['count_pages']); ?>
            </div>
        <?php endif; ?>
        <!-- pagination -->

        <p>
            <label for="wfm-text">Текст рассылки(для имени используйте шаблон %name%)</label><br>
            <textarea name="wfm-text" id="wfm-text" cols="80" rows="10"></textarea><br>

            <input type="submit" value="Отправить" id="wmf_ajax_btn">
            <span class="loader" style="display: none;">
                <img src="<?php echo plugins_url('img/loader.gif', __FILE__); ?>" alt="">
            </span>
        </p>

        <div class="ajax-result"></div>

        <?php  ?>
    </div>
    <?php
}

/**
 * подключаем скрипты и стили
 * @return [type] [description]
 */
function wfm_scripts($hook){
    if($hook !== 'settings_page_wfm-subscriber'){
        return;
    }
    wp_enqueue_style('wfm-subscriber-style', plugins_url('css/wfm-subscribe.css', __FILE__));
    wp_enqueue_script('wfm-subscriber-admin', plugins_url('js/wfm-subscribe-admin.js', __FILE__), ['jquery']);
}