<?php

use Controller\_403Controller;
use Controller\_404Controller;
use Controller\WelcomeController;

define('ROUTES', [
  '/error/403' => [_403Controller::class, 'index'],

  '/' => [WelcomeController::class, 'index'],
]);

define('DEFAULT_CONTROLLER', _404Controller::class);
define('DEFAULT_METHOD', 'index');
