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
<div class="container">

  <div class="row welcome">
    <div class="row">
      <div class="col s12 center-align">
        <h1>Bienvenue à vous sur Courtcircuit</h1>
      </div>
    </div>
    
    <div class="row m-t-big">
      <div class="col s8 offset-s2">
        <div class="center-align">
          <form class="search-container">
            <input id="q" class="search-input white" name="q" placeholder="Que recherchez-vous ?" type="text">
            <div class="search-btn">
              <button class="btn-floating btn-large waves-effect waves-light orange darken-4" type="submit" name="action">
                <i class="material-icons">search</i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
HTML;
}