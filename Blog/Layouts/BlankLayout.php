<?php
namespace Blog\Layouts;

use Tiimber\Layout;

class BlankLayout extends Layout
{
  const EVENTS = [
    'request::statics'
  ];

  const TPL = "{{{content}}}";
}
