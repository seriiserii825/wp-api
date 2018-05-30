<?php 

function wfm_ajax_subscriber(){
    
    if(!wp_verify_nonce($_POST['security'], 'wfmajax')){
        die('Ошибка безопасности');
    }

    parse_str($_POST['formData'], $wfm_data);

    if(empty($wfm_data['wfm-name']) || empty($wfm_data['wfm-email'])){
        wp_die('Заполните поля!!!');
    }

    if(!is_email($wfm_data['wfm-email'])){
        wp_die("Email не соответствует формату");
    }

    global $wpdb;

    

    if($wpdb->get_var($wpdb->prepare(
        "SELECT id FROM wp_wfm_subscribes WHERE email=%s", $wfm_data['wfm-email']
    ))){
        echo 'Вы уже подписаны';
    }else{
        if($wpdb->query($wpdb->prepare(
           "INSERT INTO wp_wfm_subscribes (name, email) VALUES (%s, %s)", [$wfm_data['wfm-name'], $wfm_data['wfm-email']]
        ))){
            echo "Подписка оформлена";
        }else{
            echo "Ошибка записи!!!";
        }
    }

    wp_die();
}

function wfm_ajax_admin(){
    if(empty($_POST['data'])){
        echo 'Ввдеите текст рассылки';
        wp_die();
    }

    $subscribers = get_subscribers(true);

    $i = 0;

    foreach ($subscribers as $subscriber) {

        $data = nl2br(str_replace('%name%', $subscriber['name'], $_POST['data']));
        if(wp_mail( $subscriber['email'], 'Рассылка с сайта', $data)){
            $i++;
        }
    }

    wp_die("Рассылка отправленно. Отправлено писем {$i}");
}

