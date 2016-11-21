<?php
namespace Blog\Views\Forms;

use Tiimber\{View, Session};

class LoginFormView extends View
{
  const EVENTS = [
    'request::user::auth' => 'formLogin',
    'request::producer::auth' => 'formLogin'
  ];

    const TPL = <<<HTML
    <div class="row form-container">
      <div class="col s6">
        <form class="register-pro" action="/login" method="post">
            <input type="hidden" name="role" value="{{role}}">
            <p class="title big">Connectez vous à votre compte</p>
            <div class="row">
              <div class="input-field col s12">
                <input id="email" name="email" type="email" class="validate" required>
                <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate" required>
                <label for="password">Password</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action">Se connecter
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </div>
        </form>
      </div>
      
      <div class="col s6">
        <div class="row">
          <div class="col s12">
            <p class="title big left no-margin">Pas encore inscrit ?</p>
            <a class="waves-effect waves-light btn register left light-blue" href="/{{role_t}}/nouveau">Je m'inscris</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col s4">
            <div class="center promo promo-example">
              <i class="medium indigo-text material-icons">flash_on</i>
              <p class="promo-caption">Développement accéléré</p>
              <p class="light center">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components.</p>
            </div>
          </div>
          <div class="col s4">
            <div class="center promo promo-example">
              <i class="medium red-text material-icons">group</i>
              <p class="promo-caption">Centré sur l'experience utilisateur</p>
              <p class="light center">By utilizing elements and principles of Material Design, we were able to create a framework that focuses on User Experience.</p>
            </div>
          </div>
          <div class="col s4">
            <div class="center promo promo-example">
              <i class="medium orange-text material-icons">settings</i>
              <p class="promo-caption">Facile à prendre en main</p>
              <p class="light center">We have provided detailed documentation as well as specific code examples to help new users get started.</p>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col s12">
            <a class="waves-effect waves-light btn big register left light-blue" href="/{{role_t}}/nouveau">Je m'inscris</a>
          </div>
        </div>
        
      </div>
    </div>
    
HTML;

    function onGet($request, $args) {
      $this->role = strstr($args["_route"], '::', true);
    }
    
    public function render()
    {
      
      $role_t = ($this->role == 'user') ? 'utilisateur' : 'producteur';
      return  [ 'role' => $this->role,
                'role_t' => $role_t ];
    }
}