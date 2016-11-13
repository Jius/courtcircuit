<?php
namespace Blog\Views\Forms;

use Tiimber\{View, Session};

class UserLoginFormView extends View
{
  const EVENTS = [
    'request::user::auth' => 'userLogin'
  ];

    const TPL = <<<HTML
    <form class="form-login" action="login" method="post">
        <input type="hidden" name="role" value="user">
        <p class="title big">Connectez vous à votre compte</p>
        <div class="row">
          <div class="input-field col s12">
            <input id="email" name="email" type="email" class="validate">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="password" name="password" type="password" class="validate">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12 right-align">
            <button class="btn waves-effect waves-light" type="submit" name="action">Se connecter
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
    </form>
HTML;
}