<?php
namespace Blog\Views\Shared;

use Tiimber\{View, Session};

class RegisterView extends View
{
  const EVENTS = [
    'request::user::new' => 'content',
    'request::producer::new' => 'content'
  ];

    const TPL = <<<HTML
    <div class="container">
        {{{formRegister}}}
    </div>
HTML;
}