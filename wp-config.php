<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp_udemy_course' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '33LF+?*Sl)8C&a*14+8~zHu1-+Us*B,Ek1jBh*&Q?>Z%^7=z_#*`)K& =ESjt{-R' );
define( 'SECURE_AUTH_KEY',  '(mKQfen6P9?iJ;MtJ>t^/<8^2!Ft-+fC.DH>O}6d%qC!k>uO3fkWT~;<4o}k`G?`' );
define( 'LOGGED_IN_KEY',    'p.0p[.A;QI*IAw+cg)WH5}Pdv12k7^9ICji*~q&>@+GaEI(|dSnw&oA?0z~tk5y/' );
define( 'NONCE_KEY',        'Z7&D[(89)9at%,7 G$V<j!%l?(mY>FEvp{JgQ% wI  g I.VtLjY ?(sl`%Mcxu/' );
define( 'AUTH_SALT',        '73NZkNiJ:9dK(CsnJtAnWB@ecnm$I3j0z8>[5rhrkBNYGcS<=Tdk[c^rlx??|Ud=' );
define( 'SECURE_AUTH_SALT', 'u-$s3.i]o }V]r#hR^<V)3A_dgKKm ^!>?2$zY7ecqK5-5}Vb.z_o8} @^o~1`_e' );
define( 'LOGGED_IN_SALT',   '^VSc<h1-nF;Hdf3O=~uE].Mb1B2VsCk?)Y,FbSom}mp8 GEAIqR}5/M^Tgp`%Y=,' );
define( 'NONCE_SALT',       '0TyXl3~*/ic_ }A7Z{tE)t!3cam0QO?>BqT<()n>{lBFBEZ`zRX2t=Z>DwL3%Hdb' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
