<?php
namespace Blog\Views;

use Tiimber\View;

class IndexView extends View
{
  const EVENTS = [
    'request::index' => 'content'
  ];

  const TPL = '
  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s4 offset-s4">
          <input id="q" name="q" class="search grey lighten-4" placeholder="Que recherchez-vous ?" type="text">
        </div>
        <div class="input-field col s2">
          <button class="btn waves-effect waves-light cyan submit-search" type="submit" name="action">
            <i class="material-icons">search</i>
          </button>
        </div>
        <div class="input-field col s2">
          <a href="/producteur">Inscrire un producteurs</a>
        </div>
      </div>
    </form>
  </div>
  ';
}