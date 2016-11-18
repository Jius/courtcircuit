<?php
namespace Blog\Views\Shared;

use Tiimber\{View, Session};

class LoginView extends View
{
  const EVENTS = [
    'request::user::auth' => 'content',
    'request::producer::auth' => 'content'
  ];

    const TPL = <<<HTML
    {{{formLogin}}}
HTML;
}