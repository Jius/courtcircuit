<?php
namespace Blog\Views\Navigations;

use Tiimber\{View, Session};

class DefaultView extends View
{
  const EVENTS = [
    'request::*' => 'navigation'
  ];

    const TPL = <<<HTML
    <div class="header">
      <div class="container">
        <div class="row hide-on-med-and-down">
          <div class="col s6">
            <h1 class="logo">
              <a href="/">Courtcircuit</a>
            </h1>
          </div>
          
          <div class="col s6">
            <ul class="nav right">
              {{#user?}}
                <li>
                  <a href="/pro/tableau-de-bord" class="tab black-text right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Aller au tableau de bord"><i class="material-icons">work</i>{{email}}</a>
                  <a class="btn-floating btn waves-effect waves-light red logout"><i class="material-icons">clear</i></a>
                </li>
              {{/user?}}
              
              {{^user?}}
                <li>
                  <a href="/espace-producteur" class="tab black-text right"><i class="material-icons">work</i>Espace Producteur</a>
                </li>
              {{/user?}}
              
            </ul>
            <a href="/proposition" class="propal right">Proposer une boutique ou événement local</a>
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
          'user?' => Session::load()->get('user')
        ];
        
    }
}