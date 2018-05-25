<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wp-api');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'g+^/aMZ$m;2B=Vkus&72CRm?g.>+y+VKH]a1Gt78v+Ena)z{i|C=.tV<2O~GOeO-');
define('SECURE_AUTH_KEY',  'Qf;lu8uY/PWtz2`d |R3~(L~bYL[:&- Je.J5J:Tt(MOE^Lp2sdh>!>qmoMw&}Gg');
define('LOGGED_IN_KEY',    'V4&LE=%MTdUG5y|$DG(4zhj~IOwoE`Q+DcKPG&:TRxF</YF$w=AO+u;{u^tOgS,7');
define('NONCE_KEY',        'CESZ1<*E=SCa:</.NN}kFCic=Ee49fY0zE+Ya>KP,!519um4kGef7;kw|IFy_|2n');
define('AUTH_SALT',        '$Uam^ftP6Jv%H2Sk4#mff@$!8J|Y8fb:[I`Ny_b=2{1Ykrg?j<i!W2KDex2sO/c_');
define('SECURE_AUTH_SALT', 'K|6Q~VyQC~fSlFvRZWLr~t=uKgie{^psSB:$^N%2Oj!3xNEr()82+985)0`4M%JF');
define('LOGGED_IN_SALT',   '2wl$ZLvhd;&6B(!O#%T(*.M-1QPE(zAa.-kBHZ@3H<MTBObYrxko5Z71gx$2{)AI');
define('NONCE_SALT',       'k{u-2S`?;8:Ik3;|D5n+) -Fx:N>YMkN?q/W*5Mdrx%C9u.i?3L@vX(b ;P|6/SZ');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
