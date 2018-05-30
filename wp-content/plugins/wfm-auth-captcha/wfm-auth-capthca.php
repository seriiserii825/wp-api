<?php
/*
 * Plugin Name: Простая капча для авторизации
 * Description: Плагин добавляет простую проверку на человечность для формы авторизации
 * */

/*add_filter('login_errors', 'my_login_errors');

function my_login_errors(){
	return 'Ошибка авторизации!!!';
}*/

add_action('login_form', 'wfm_login_form');
add_filter('authenticate', 'wfm_authenticate', 30, 3);

function wfm_authenticate($user, $username, $password){
    if (isset($_POST['check']) && $_POST['check'] == 'check'){
        $user = new WP_Error('broke', '<b>Ошибка: Вы бот?</b>');
    }

    if(isset($user->errors['invalid_username']) || isset($user->errors['incorrect_password'])){
		return new WP_Error('broke', '<b>Неверный логин или пароль!!!</b>');
	}

    return $user;
}

function wfm_login_form(){
    ?>
	<p>
		<label for="check">
			<input type="checkbox" name="check" id="check" value="check" checked>
			Снимите галочку
		</label>
	</p>
    <?php
}
