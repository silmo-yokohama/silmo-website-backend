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

  function __construct()
  {
    try {
      $this->data = self::getData();
    } catch (Exception $e) {
      $this->hasError = true;
      $this->errorMessage = $e->getMessage();
    }
  }

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

    $values['skills'] = self::getSkills();

    // キーをキャメルケースに変換
    return KeyConverter::toCamelCase($values);
  }


  public static function getSkills()
  {
    $terms = get_terms([
      'taxonomy' => 'skills',
      'hide_empty' => false,
    ]);

    // 階層構造を維持するための再帰関数
    function buildHierarchy($terms, $parentId = 0)
    {
      $branch = [];
      foreach ($terms as $term) {
        if ($term->parent == $parentId) {
          $children = buildHierarchy($terms, $term->term_id);

          $termData = [
            'id' => $term->term_id,
            'name' => $term->name,
            'slug' => $term->slug,
          ];

          // 子要素が存在する場合は追加
          if (!empty($children)) {
            $termData['children'] = $children;
          }

          // レベル情報の追加（親要素以外の場合）
          if ($parentId !== 0) {
            $termData['level'] = get_field('level', 'skills_' . $term->term_id);
          }

          $branch[] = $termData;
        }
      }

      // idの昇順でソート
      if (!empty($branch)) {
        usort($branch, function ($a, $b) {
          return $a['id'] - $b['id'];
        });
      }

      return $branch;
    }

    // 階層構造を構築
    return buildHierarchy($terms);
  }
}
