<?php
/**
 * WordPress テーマ用ラッパー。
 *
 * ヘッダーの HTML・ナビ・CSS はすべて ../../../../../templates/header.php を編集してください。
 * ここでは WP 向けに title / description / cssinc だけ未定義なら補います。
 */
if ( ! defined( 'description' ) ) {
	define( 'description', '心身統一合氣道会の公式サイトです。' );
}
if ( ! defined( 'title' ) ) {
	define( 'title', '合気道｜心身統一合氣道会 成心館道場 公式サイト' );
}
if ( ! defined( 'cssinc' ) ) {
	if ( function_exists( 'is_home' ) && function_exists( 'is_front_page' ) && ( is_home() || is_front_page() ) ) {
		define( 'cssinc', 'top' );
	} elseif ( function_exists( 'is_category' ) && is_category( 'dojo' ) ) {
		define( 'cssinc', 'seishinkan' );
	} elseif ( function_exists( 'is_singular' ) && is_singular() && function_exists( 'in_category' ) && in_category( 'dojo' ) ) {
		define( 'cssinc', 'seishinkan' );
	} else {
		define( 'cssinc', 'about/corporation' );
	}
}

// wp/wp-content/themes/seishinkan → 4 段上がサイトルート（templates ・ wp が並ぶ階層）
$seishinkan_site_root = dirname( __DIR__, 4 );
require $seishinkan_site_root . '/templates/header.php';
