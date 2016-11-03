<?php
namespace Blog\Views;

use Tiimber\{View, Session};
use RedBeanPHP\R;

class IndexView extends View
{
  const EVENTS = [
    'request::index' => 'content'
  ];
  
  const TPL = <<<HTML
{{#user}}
  <div id="map"></div>
{{/user}}
{{^user}}
  <div class="container">
  
    <div class="row welcome">
      <div class="col s12 center-align">
        <h1>Bienvenue à vous sur Courtcircuit</h1>
        <p>Pour accéder à la map, je vous invite à vous connecter ou vous enregistrez :)</p>
        <div class="center-align">
          <a class="waves-effect waves-light btn-large login orange darken-3">Se connecter</a>
          <a class="waves-effect waves-light btn-large register blue">S'enregistrer</a>
        </div>
      </div>
    </div>
    
    <div class="row form-container-index">
      <div class="col s6 offset-s3">
        <div class="row">
          <form class="col s12 form-index login" action="login" method="post">
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
              <div class="col s6 left-align">
                <a class="waves-effect waves-light btn light-blue accent-3 return">Retour<i class="material-icons right">reply</i></a>
              </div>
              <div class="col s6 right-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">Se connecter
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </div>
          </form>
          
          <form class="col s12 form-index register" action="user/create" method="post">
            <div class="row">
              <div class="input-field col s6">
                <input id="firstname" name="firstname" type="text" class="validate">
                <label for="firstname">Prénom</label>
              </div>
              <div class="input-field col s6">
                <input id="lastname" name="lastname" type="text" class="validate">
                <label for="lastname">Nom</label>
              </div>
            </div>
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
              <div class="col s6 left-align">
                <a class="waves-effect waves-light btn light-blue accent-3 return">Retour<i class="material-icons right">reply</i></a>
              </div>
              <div class="col s6 right-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">S'enregistrer
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
{{/user}}
HTML;

  public function render()
  {
    return [
      'user' => Session::load()->has('user')
    ];
  }
}