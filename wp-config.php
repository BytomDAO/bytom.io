	<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'bytom');

/** MySQL数据库用户名 */
define('DB_USER', 'mybytom');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'mybytom@8btc');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?`g1jY04K:#*(M,]0b^.N{~;/?WvMC Pv kkG&%tF8RQ:KPK-0yk`mCo;]g{xW`W');
define('SECURE_AUTH_KEY',  ']ng7T?k`RUVnGbG/UKhs,@N^EumDsQAl=>uuQ&sM#>Q2?S{4qB}ChU XO#xwocro');
define('LOGGED_IN_KEY',    'nL5 J;Q^W`<}o{gU72T:d707+WnmOVZ=5J2?8|UM{Fh]K|=|KHhK^Lm:qqy(}F[M');
define('NONCE_KEY',        'k8h9I7X@DiLq~VST$3gl4:?3cYd>)rA7MyNcyJ<i3Yhe>1<?{~Pe3(irp^cVmzB9');
define('AUTH_SALT',        'M)|qOjb@0zNC?m5[;wu82YSY)4L _K1hSW:9q(/yLWZ?kKQiXp2ca;}V)y$1cX`h');
define('SECURE_AUTH_SALT', ':xQ$/P+5%ze1HaY-RykEp`5Dw}4%R.Y>Ag[xnT:(Y?M*EndXYB~<s*jf6o!hst=&');
define('LOGGED_IN_SALT',   'wZuZ-$.=hyPIUavW19OOH*|=GOlBHlk7l$N7%)jyoOY_7UBY%tbCu}A ryW|^yH&');
define('NONCE_SALT',       'j7_zW2qT2#1$J3hY>csE>[KeaKSZ602F/Ctc77ieIuo-wEJl{Sh2.q 9exbmJn=U');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

$allow_admin_action_url_arr = array(
	'test.bytom.io',
	'www.bytom.io',
);
if(!empty($_SERVER['HTTP_HOST']) && in_array($_SERVER['HTTP_HOST'], $allow_admin_action_url_arr)){
	$set_home_url = 'https://'.$_SERVER['HTTP_HOST'];
	$set_site_url = 'https://'.$_SERVER['HTTP_HOST'];
	define('WP_HOME', $set_home_url);
	define('WP_SITEURL', $set_site_url);
}else{
	if($_SERVER['REQUEST_URI'] != '/' && !strstr($_SERVER['REQUEST_URI'], 'wp-login.php') && !strstr($_SERVER['REQUEST_URI'], 'wp-admin')){
		$set_home_url = 'https://'.$_SERVER['HTTP_HOST'];
        $set_site_url = 'https://'.$_SERVER['HTTP_HOST'];
        define('WP_HOME', $set_home_url);
        define('WP_SITEURL', $set_site_url);
	}
}

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');



define("FS_METHOD","direct");

define("FS_CHMOD_DIR", 0777);

define("FS_CHMOD_FILE", 0777);
