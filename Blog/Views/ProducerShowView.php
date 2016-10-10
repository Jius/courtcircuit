<?php
namespace Blog\Views;

use Tiimber\View;

class ProducerShowView extends View
{
  const EVENTS = [
    'request::producer::show' => 'content'
  ];

  const TPL = '
    Voila le producteur...
  ';
}