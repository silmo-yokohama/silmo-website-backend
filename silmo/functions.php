<?php

require_once __DIR__ . '/utils/common.php';
require_once __DIR__ . '/utils/debug.php';
require_once __DIR__ . '/utils/registerApi.php';
require_once __DIR__ . '/classes/KeyConverter.php';
require_once __DIR__ . '/classes/api/UserProfile.php';

/**
 * テーマのセットアップ
 */
add_action('after_setup_theme', 'theme_base_setup');




// /**
//  * ヘルスチェックのハンドラー関数
//  *
//  * @param WP_REST_Request $request リクエストオブジェクト
//  * @return WP_REST_Response レスポンスオブジェクト
//  */
// function handle_health_check($request)
// {
//   global $wpdb;

//   // データベース接続チェック
//   $db_status = 'healthy';
//   $db_message = '';
//   try {
//     $wpdb->get_results("SELECT 1");
//     if ($wpdb->last_error) {
//       $db_status = 'error';
//       $db_message = $wpdb->last_error;
//     }
//   } catch (Exception $e) {
//     $db_status = 'error';
//     $db_message = $e->getMessage();
//   }

//   $response = [
//     'status' => 'ok',
//     'timestamp' => current_time('mysql'),
//     'environment' => [
//       'wordpress_version' => get_bloginfo('version'),
//       'php_version' => PHP_VERSION,
//       'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown',
//     ],
//     'database' => [
//       'status' => $db_status,
//       'message' => $db_message,
//     ],
//     'memory' => [
//       'limit' => WP_MEMORY_LIMIT,
//       'usage' => memory_get_usage(true),
//     ]
//   ];

//   return new WP_REST_Response($response, 200);
// }
