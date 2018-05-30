<?php 

function get_subscribers($all=false){
    global $wpdb;

    $page_params = get_page_params();

    if($all){
        return $wpdb->get_results( "SELECT * FROM  wp_wfm_subscribes", ARRAY_A ); 
    }

    return $wpdb->get_results( "SELECT * FROM  wp_wfm_subscribes LIMIT {$page_params['start_pos']}, {$page_params['per_page']}", ARRAY_A ); 
}

function get_page_params(){
    global $wpdb;

    //сколько записей выводить на страницу
    $per_page = 3;

    //кол-во записей    
    $count = $wpdb->get_var("SELECT COUNT(*) FROM wp_wfm_subscribes");

    //кол-во страниц
    $count_pages = ceil($count / $per_page);

    if(!$count_pages){
        $count_pages = 1;
    }

    if(isset($_GET['paged'])){
        $page = (int)$_GET['paged'];

        if($page <= 0){
            $page = 1;
        }
    }else{
        $page = 1;
    }

    if($page > $count_pages){
        $page = $count_pages;
    }

    $star_pos = ($page - 1) * $per_page;   

    $pagination_params = [
        'per_page' => $per_page,
        'count' => $count,
        'page' => $page,
        'count_pages' => $count_pages,
        'start_pos' => $star_pos
    ];

    return $pagination_params;
}

function pagination($page, $count_pages){
    $back = null;
    $forward = null;
    $start_page = null;
    $end_page = null;
    $page2left = null;
    $page1left = null;
    $page2right = null;
    $page1right = null;

    $uri = "?";

    if($_SERVER['QUERY_STRING']){
        foreach ($_GET as $key => $value) {
            if($key !== 'paged'){
                $uri .= "{$key}=$value&amp;";     
            }
        }
    }

    if($page > 1){
        $back = '<a class="nav-link" href="'.$uri.'paged='.($page-1).'">Назад</a>';
    }

    if($page < $count_pages){
        $forward = '<a class="nav-link" href="'.$uri.'paged='.($page+1).'">Вперед</a>';   
    }

    if($page >3){
        $start_page = '<a class="nav-link" href="'.$uri.'paged=a">Вперед</a>';
    }

    if($page < ($count_pages - 2)){
        $end_page = '<a class="nav-link" href="'.$uri.'paged='.($count_pages).'">Назад</a>';
    }

    if(($page - 2) > 0){
        $page2left = '<a class="nav-link" href="'.$uri.'paged='.($page-2).'">'.($page-2).'</a>';
    }

    if(($page - 1) > 0){
        $page1left = '<a class="nav-link" href="'.$uri.'paged='.($page-1).'">'.($page-1).'</a>';
    }

    if(($page+1) > 0){
        $page1right = '<a class="nav-link" href="'.$uri.'paged='.($page+1).'">'.($page+1).'</a>';
    }

    if(($page+2) > 0){
        $page1right = '<a class="nav-link" href="'.$uri.'paged='.($page+2).'">'.($page+2).'</a>';
    }

    return $start_page.$back.$page2left.$page1left.'<a class="active-page">'.$page.'</a>'.$page1right.$page2right.$forward.$end_page;
}