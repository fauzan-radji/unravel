<?php

use function Core\extend;

function title()
{
  echo 'Welcome';
}

function body()
{
?>
  <h1>Welcome</h1>
  <p>Unravel is a <strong>Laravel like</strong> web application framework but with minimalistic features. It is designed to be simple and easy to use. It is a good starting point for those who want build their simple web with the power of Laravel.</p>
<?php
}

extend('base');
