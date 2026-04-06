<?php
/**
 * 成心館テーマ
 *
 * ヘッダー・フッターのマークアップはリポジトリ直下の templates/header.php と templates/footer.php。
 * 本テーマの header.php / footer.php はその共通ファイルを読み込むだけです。
 */

add_filter( 'get_the_archive_title', function ( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  }
  return $title;
} );
?>