<?php

namespace Core;

class Session
{
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public static function get($key)
  {
    return $_SESSION[$key];
  }

  public static function has($key)
  {
    return key_exists($key, $_SESSION);
  }

  public static function unset($key = null)
  {
    if ($key) unset($_SESSION[$key]);
    else session_unset();
  }

  public static function has_error()
  {
    return self::has('error');
  }

  public static function get_error()
  {
    if (self::has_error()) {
      $error = self::get('error');
      self::unset('error');
      return $error;
    } else return null;
  }

  public static function set_error($error)
  {
    self::set('error', $error);
  }

  public static function has_success()
  {
    return self::has('success');
  }

  public static function get_success()
  {
    if (self::has_success()) {
      $success = self::get('success');
      self::unset('success');
      return $success;
    } else return null;
  }

  public static function set_success($success)
  {
    self::set('success', $success);
  }
}
