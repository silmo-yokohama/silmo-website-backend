<?php

/**
 * KeyConverterクラス
 *
 * 入力配列のキーをキャメルケースに変換する機能を提供します。
 */
class KeyConverter
{
  /**
   * キーをキャメルケースに変換するメソッド
   *
   * @param array $array 入力配列
   * @return array キーがキャメルケースに変換された配列
   */
  public static function toCamelCase(array $array): array
  {
    $result = [];
    foreach ($array as $key => $value) {
      // スネークケースをキャメルケースに変換
      $camelCaseKey = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));

      // 値が配列の場合は再帰的に処理
      if (is_array($value)) {
        $value = self::toCamelCase($value);
      }

      $result[$camelCaseKey] = $value;
    }
    return $result;
  }
}
