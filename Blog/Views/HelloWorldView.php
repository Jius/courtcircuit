<?php
namespace Blog\Views;

use Tiimber\View;

class HelloWorldView extends View
{
  const EVENTS = [
    'request::hello' => 'content'
  ];

  const TPL = 'Hello world.';
}