<?php



function theme_base_setup()
{
  add_theme_support('post-thumbnails'); // アイキャッチ.
  // add_theme_supportは他にもあるので必要に応じて下に追加していく.
}

function redirectToHome()
{
  header('Location: https://silmo.jp/', true, 301);
  exit();
}
