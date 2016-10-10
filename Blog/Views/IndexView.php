<?php
namespace Blog\Views;

use Tiimber\View;

class IndexView extends View
{
  const EVENTS = [
    'request::index' => 'content'
  ];

  const TPL = '
    <a href="/carte">Voir les producteurs</a>
    <a href="/producteur">Inscrire un producteurs</a>
  ';
}