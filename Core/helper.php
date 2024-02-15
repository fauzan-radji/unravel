<?php

namespace Core;

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

function env($key, $default = null)
{
  $content = file_get_contents(ROOT . '.env');
  $content = preg_split('/[\r\n]/', $content);
  foreach ($content as $line) {
    if (str_starts_with($line, '#') || strlen($line) === 0) continue;

    [$k, $v] = explode('=', $line);
    if ($k === $key) return $v;
  }

  return $default;
}

function asset($asset)
{
  return env('APP_URL') . 'public/' . trim($asset, '/');
}

function uploads($asset)
{
  return env('APP_URL') . 'uploads/' . trim($asset, '/');
}

function route($route)
{
  return env('APP_URL') . trim($route, '/');
}

function redirect($url)
{
  header('Location: ' . route($url));
}

function view($view, $data = [])
{
  foreach ($data as $key => $value) {
    $GLOBALS[$key] = $value;
    ${$key} = $value;
  }

  require ROOT . "views/$view.php";
}

function extend($layout, $data = [])
{
  foreach ($data as $key => $value) ${$key} = $value;

  require_once ROOT . "views/layouts/$layout.php";
}

function section($section, $data = [])
{
  if (function_exists($section)) $section($data);
}

function component($component, $data = [])
{
  foreach ($data as $key => $value)
    ${$key} = $value;

  require ROOT . "views/components/$component.php";
}

function routeIs($guess)
{
  global $path;
  $guess = str_replace('/', '\\/', $guess);
  $pattern = '/^' . str_replace('*', '.*', $guess) . '$/';

  return preg_match($pattern, $path);
}

function truncate($string, $length = 30, $append = "&hellip;")
{
  $string = trim($string);

  if (strlen($string) > $length) {
    $string = wordwrap($string, $length);
    $string = explode("\n", $string, 2);
    $string = $string[0] . $append;
  }

  return $string;
}

function formatTime($format, $time)
{
  return date($format, strtotime($time));
}
