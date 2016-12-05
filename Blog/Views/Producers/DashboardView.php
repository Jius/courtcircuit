<?php
namespace Blog\Views\Producers;

use Tiimber\{View, Session};

use RedBeanPHP\R;

class DashboardView extends View
{
  const EVENTS = [
    'request::producer::logged::dashboard' => 'content',
  ];
  
  const TPL = <<<HTML
  <div class="center-align head-dash">
    <h2>Tableau de Bord</h2>
    {{#user}}<p class="title medium">Bonjour {{firstname}}</p>{{/user}}
  </div>
  
  <div class="row shop-container">
    <div class="col s12 m6 l6">
      <p class="title big blue-text dash-lab">Vos boutiques</p>
      <a class="btn-floating btn-large waves-effect waves-light red" href="/pro/boutique"><i class="material-icons">add</i></a>
      
      <div class="row shops-card">
      
        {{#shops?}}
          <div class="col s12 m12 l6">
            <div class="card medium">
              <div class="card-image">
                <img src="http://lorempixel.com/640/480">
                <span class="card-title text-shadow">{{title}}</span>
              </div>
              <div class="card-content">
                <p>{{description}}</p>
              </div>
              <div class="card-action">
                <a href="/shop/edit/{{id}}">Modifier</a>
                <a class="red-text alert" href="#modal-delete" alert-href="/shop/delete/{{id}}" alert-title="{{title}}">Supprimer</a>
              </div>
            </div>
          </div>
        {{/shops?}}
        
        {{^shops?}}
          <div class="col s12">
            <p>Aucunes boutiques enregistrées.</p>
          </div>
        {{/shops?}}
        
      </div>
      
    </div>
    
    <div class="col s12 m6 l6">
      <p class="title big blue-text dash-lab">Evénements & Déplacements</p>
      <a class="btn-floating btn-large waves-effect waves-light purple"><i class="material-icons">add</i></a>
      
      <div class="row">
      
        {{#events}}
        {{/events}}
        
        {{^events}}
          <div class="col s12">
            <p>Aucuns déplacements enregistrés.</p>
          </div>
        {{/events}}
        
      </div>
      
    </div>
  </div>
HTML;


  public function render()
  {
    $user = Session::load()->get('user');
    $shops = R::find('shops','owner = ?', [ $user["id"] ]);
    return [
      'user' => $user,
      'shops?' => array_values($shops)
    ];
  }
}