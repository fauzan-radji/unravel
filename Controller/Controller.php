<?php

namespace Controller;

use Core\Auth;

use function Core\redirect;

abstract class Controller
{
  abstract public static function index();

  public static function authorize(...$levels)
  {
    foreach ($levels as $level) {
      if (Auth::is($level)) return;
    }

    return redirect('/error/403');
  }
}
