<?php
require_once get_template_directory() . '/classes/api/UserProfile.php';

const SILMO_API_NAMESPACE = 'silmo/v1';

function initApi()
{
  add_action(
    'rest_api_init',
    function () {
      // SilMo情報取得API
      registerProfileApi();
    }
  );
}
/**
 * APIの初期化
 */
add_action('init', 'initApi');

/**
 * SilMo情報取得APIの登録
 */
function registerProfileApi()
{
  $userProfile = new UserProfile();
  register_rest_route(SILMO_API_NAMESPACE, '/profile', [
    'methods' => 'GET',
    'callback' => [$userProfile, 'response'],
  ]);
}
