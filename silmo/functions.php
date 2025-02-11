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
