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
      <a href="#" data-activates="mobile-nav" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>
      <div class="container">
        <div class="row">
          <div class="col s6">
            <h1 class="logo">
              <a href="/">Courtcircuit</a>
            </h1>
          </div>
          
          <div class="col s6 hide-on-med-and-down">
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
          
          <ul class="side-nav" id="mobile-nav">
          
            {{#user?}}
              <li>
                <a href="/pro/tableau-de-bord" class="black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Aller au tableau de bord"><i class="material-icons">work</i>{{email}}</a>
                <a class="btn-floating btn-large waves-effect waves-light red logout-mobile"><i class="tiny material-icons">clear</i></a>
              </li>
            {{/user?}}
            
            {{^user?}}
              <li>
                <a href="/espace-producteur" class="black-text"><i class="material-icons">work</i>Espace Producteur</a>
              </li>
            {{/user?}}
            
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">Javascript</a></li>
            <li><a href="mobile.html">Mobile</a></li>
          </ul>
          
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