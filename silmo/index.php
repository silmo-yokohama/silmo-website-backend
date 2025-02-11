<?php
require_once __DIR__ . '/classes/api/UserProfile.php';

// プロファイル情報を取得してJSONとして出力
debug(UserProfile::getData());
