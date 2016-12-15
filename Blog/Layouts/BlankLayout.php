<?php
namespace Blog\Layouts;

use Tiimber\Layout;

class BlankLayout extends Layout
{
  const EVENTS = [
    'request::statics::*',
    'request::ajax::*'
  ];

  const TPL = "{{{content}}}";
}
