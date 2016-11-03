<?php
namespace Blog\Views;

use Tiimber\{View, Session};

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
    <div class="row">
      <div class="col s12 center-align">
        <h1>Bienvenue à vous sur Courtcircuit</h1>
        <p>Pour accéder à la map, je vous invite à vous connecter ou vous enregistrez :)</p>
      </div>
    </div>
    <div class="row">
      <div class="col s6 offset-s3">
        <div class="row">
          <div class="btn-index center-align">
            <a class="waves-effect waves-light btn login orange darken-3">Se connecter</a>
            <a class="waves-effect waves-light btn register blue">S'enregistrer</a>
          </div>
          <form class="col s12 form-index login">
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
          
          <form class="col s12 form-index register">
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
    var_dump(Session::load()->has('user'));
    return [
      'user' => Session::load()->has('user')
    ];
  }

}