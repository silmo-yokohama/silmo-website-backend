<?php
require_once __DIR__ . '/classes/api/UserProfile.php';

// プロファイル情報を取得してJSONとして出力
echo json_encode(UserProfile::getData());
