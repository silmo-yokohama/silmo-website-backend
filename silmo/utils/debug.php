<?php

function debug($value)
{
  echo '<pre>';
  echo json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  echo '</pre>';
}
