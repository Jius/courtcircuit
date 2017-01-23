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
<div class="gab welcome">
  <div class="row">
    <div class="col s12 center-align">
      <h1>Bienvenue à vous sur Courtcircuit</h1>
    </div>
  </div>
  
  
  <div class="row m-t-big">
    <form class="col s12">
      <p class="title medium">Rechercher des producteurs</p>
      <div class="row">
        <div class="col s5">
          <div class="autocomplete search-input" id="multiple">
            <div class="ac-users"></div>
            <div class="ac-input">
              <input type="text" id="multipleInput" placeholder="Entrez quelques mots-clés" data-activates="multipleDropdown" data-beloworigin="true" autocomplete="off" class="white">
            </div>
            <ul id="multipleDropdown" class="dropdown-content ac-dropdown"></ul>
            <input type="hidden" name="multipleHidden" />
          </div>
        </div>
        <div class="col s5">
          <input id="city" class="search-input white" name="city" placeholder="Autours de ?" type="text">
        </div>
        <div class="col s2">
          <button class="btn-floating btn-large waves-effect waves-light orange darken-4" type="submit" name="action">
            <i class="material-icons">search</i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="gab informations">
  <div class="row">
    <div class="col s12 m12 l4">
      <div class="center promo promo-example">
        <i class="medium indigo-text material-icons">flash_on</i>
        <p class="promo-caption">Développement accéléré</p>
        <p class="light center">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components.</p>
      </div>
    </div>
    <div class="col s12 m12 l4">
      <div class="center promo promo-example">
        <i class="medium red-text material-icons">group</i>
        <p class="promo-caption">Centré sur l'experience utilisateur</p>
        <p class="light center">By utilizing elements and principles of Material Design, we were able to create a framework that focuses on User Experience.</p>
      </div>
    </div>
    <div class="col s12 m12 l4">
      <div class="center promo promo-example">
        <i class="medium orange-text material-icons">settings</i>
        <p class="promo-caption">Facile à prendre en main</p>
        <p class="light center">We have provided detailed documentation as well as specific code examples to help new users get started.</p>
      </div>
    </div>
  </div>
  
  <div class="row center-align">
    <div class="col s12">
      <h2>Comment ça marche ?</h2>
    </div>
  </div>
</div>

  <a class="btn-floating btn-large waves-effect waves-light blue btn-gab tooltipped" data-position="right" data-delay="50" data-tooltip="En savoir plus"><i class="medium material-icons">keyboard_arrow_down</i>En savoir plus</a>
HTML;

  public function render()
  {
  }
}