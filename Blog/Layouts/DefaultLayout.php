<?php
namespace Blog\Layouts;

use Tiimber\Layout;

class DefaultLayout extends Layout
{
  const TPL = <<<HTML
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Court-circuit</title>
  </head>
  <body>
    <div>
      {{{content}}}
    </div>
  </body>
</html>
HTML;
}