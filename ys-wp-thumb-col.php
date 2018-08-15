<?php
/**
 * Plugin Name:     Ys WP Thumb Col
 * Plugin URI:      https://github.com/yosiakatsuki/ys-wp-thumb-col
 * Description:     投稿一覧ページにアイキャッチ画像表示列を追加するだけのプラグイン
 * Author:          yosiakatsuki
 * Author URI:      https://yosiakatsuki.net/
 * Text Domain:     ys-wp-thumb-col
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Ys WP Thumb Col
 */

/*
Copyright (c) 2018 Yoshiaki Ogata (https://yosiakatsuki.net/)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * カラムを追加
 *
 * @param array $columns columns.
 *
 * @return array
 */
function ywtc_manage_posts_columns( $columns ) {
	$columns = array_merge( $columns, array( 'ywtc_thumbnail' => 'アイキャッチ画像' ) );

	return $columns;
}

add_filter( 'manage_posts_columns', 'ywtc_manage_posts_columns' );

/**
 * カラムの中身を追加
 *
 * @param string $column  column name.
 * @param int    $post_id post id.
 */
function ywtc_manage_posts_custom_column( $column, $post_id ) {
	if ( 'ywtc_thumbnail' == $column ) {
		$img = get_the_post_thumbnail(
			$post_id,
			'full',
			array(
				'style' => 'max-width:100%;height:auto;',
			)
		);
		if( ! empty( $img ) ) {
			echo $img;
		}
	}
}

add_action( 'manage_posts_custom_column', 'ywtc_manage_posts_custom_column', 10, 2 );