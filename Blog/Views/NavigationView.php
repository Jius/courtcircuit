<?php
namespace Blog\Views;

use Tiimber\{View, Session};

class NavigationView extends View
{
  const EVENTS = [
    'request::*' => 'navigation'
  ];

    const TPL = <<<HTML
    <nav id="navigation">
      <div class="nav-wrapper brown darken-1">
        <a href="/" class="brand-logo">CourtCircuit</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="actions-nav hide-on-med-and-down">
          {{#user}}
            <li><a href="/user/{{id}}" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="{{email}}"><i class="material-icons left">home</i>Mon compte</a></li>
          {{/user}}
            <li><a href="/producteur"><i class="material-icons left">account_circle</i>Espace Producteur</a></li>
        </ul>
        {{#user}}
          <form class="search-container">
            <input id="q" class="search-input white" name="q" placeholder="Que recherchez-vous ?" type="text">
            <div class="search-btn">
              <button class="btn-floating btn-large waves-effect waves-light orange darken-4" type="submit" name="action">
                <i class="material-icons">search</i>
              </button>
            </div>
          </form>
        {{/user}}
        <ul class="side-nav" id="mobile-demo">
          {{#user}}
            <li><a href="/user/{{id}}"><i class="material-icons left">account_circle</i>Mon compte</a></li>
          {{/user}}
        </ul>
      </div>
    </nav>
HTML;

    public function render() {
        return [
          'user' => Session::load()->get('user')
        ];
        
    }
}