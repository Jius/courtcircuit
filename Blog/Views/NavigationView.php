<?php
namespace Blog\Views;

use Tiimber\{View, Session};

class NavigationView extends View
{
  const EVENTS = [
    'request::*' => 'navigation'
  ];

    const TPL = <<<HTML
    <div class="header">
      <div class="container">
        <div class="row hide-on-med-and-down">
          <div class="col s8">
            <h1 class="logo">
              <a href="/">Courtcircuit, <span class="reduce">découvrez les produits locaux.</span></a>
            </h1>
          </div>
          <div class="col s3 offset-s1">
            <ul class="nav right">
              <li>
                <a href="/authentification" class="tab"><i class="material-icons">home</i>Se connecter / S'inscrire</a>
              </li>
              <li>
                <a href="/pro/login" class="tab"><i class="material-icons">work</i>Espace Producteur</a>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="row hide-on-large-only">
          <div class="col s8">
            <h1 class="logo">
              <a href="/">Courtcircuit</a>
            </h1>
          </div>
        </div>
      </div>
    </div>
HTML;

    public function render() {
        return [
          'user' => Session::load()->get('user')
        ];
        
    }
}