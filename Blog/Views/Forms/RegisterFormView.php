<?php
namespace Blog\Views\Forms;

use Tiimber\{View, Session};

class RegisterFormView extends View
{
  const EVENTS = [
    'request::user::new' => 'formRegister',
    'request::producer::new' => 'formRegister'
  ];

    const TPL = <<<HTML
    <form class="form-container" action="/register" method="post">
        <p class="title big">Création de votre compte <b>{{role_t}}</b></p>
        <div class="row">
          <div class="input-field col s6">
            <input id="fn" name="firstname" type="text" class="validate" required>
            <label for="fn">Prénom</label>
          </div>
          <div class="input-field col s6">
            <input id="ln" name="lastname" type="text" class="validate" required>
            <label for="ln">Nom</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input id="email" name="email" type="email" class="validate check-exist" required>
            <label for="email">Email</label>
          </div>
          <div class="input-field col s6">
            <input id="phone" name="phone" type="tel" class="validate" required>
            <label for="phone">Téléphone</label>
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
            <button class="btn waves-effect waves-light" type="submit">Se connecter
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
        
        <input type="hidden" name="role" value="{{role}}" id="role">
        {{#pro?}}
          <input type="hidden" name="approved_pro" value="false">
        {{/pro?}}
        <input type="hidden" name="email_validate" value="false">
        <input type="hidden" name="created" value="{{date}}">
    </form>
HTML;

    function onGet($request, $args) {
      $this->role = strstr($args["_route"], '::', true);
    }
    
    public function render()
    {
      
      $role_t = ($this->role == 'user') ? 'utilisateur' : 'producteur';
      $pro = ($this->role == 'producer') ? true : false;
      return  [ 'role' => $this->role,
                'role_t' => $role_t,
                'date' => date('d/m/Y'),
                'pro?' => $pro        
              ];
    }
}