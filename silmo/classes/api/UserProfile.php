<?php
require_once get_template_directory() . '/classes/api/ApiController.php';
require_once get_template_directory() . '/classes/KeyConverter.php';
/**
 * ユーザープロファイル情報を取得・加工するクラス
 *
 * @package Silmo
 */

class UserProfile extends ApiController
{
  private static $_optionKeys = [
    'companyName',
    'silmoDescription',
    'hobbies',
    'business_contents',
    'histories',
  ];
  /**
   * WordPressのカスタムフィールドからユーザープロファイル情報を取得し、
   * キーをキャメルケースに変換して返却します
   *
   * @return array キャメルケース変換済みのプロファイル情報
   */
  public static function getData(): array
  {
    $values = [];
    foreach (self::$_optionKeys as $key) {
      $values[$key] = get_field($key, "option");
    }

    // キーをキャメルケースに変換
    return KeyConverter::toCamelCase($values);
  }

  function __construct()
  {
    try {
      $this->data = self::getData();
    } catch (Exception $e) {
      $this->hasError = true;
      $this->errorMessage = $e->getMessage();
    }
  }
}
