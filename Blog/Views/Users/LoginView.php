<?php
namespace Blog\Views\Users;

use Tiimber\{View, Session};

class LoginView extends View
{
  const EVENTS = [
    'request::user::auth' => 'content'
  ];

    const TPL = <<<HTML
    <div class="container">
        {{{userLogin}}}
    </div>
HTML;
}