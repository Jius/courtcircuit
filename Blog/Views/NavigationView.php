<?php
namespace Blog\Views;

use Tiimber\{View, Session};

class NavigationView extends View
{
  const EVENTS = [
    'request::index' => 'navigation'
  ];

    const TPL = <<<HTML
    <nav id="navigation">
      <div class="nav-wrapper light-blue accent-2">
        <a href="/" class="brand-logo">CourtCircuit</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="actions-nav hide-on-med-and-down">
          <li><a href="/producteur">Producteur</a></li>
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
          <li><a href="/producteur">Producteur</a></li>
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