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
    <div class="col s12">
      <p class="title big blue-text dash-lab">Vos boutiques</p>
      <a class="btn-floating btn-large waves-effect waves-light red" href="/pro/boutique"><i class="material-icons">add</i></a>
      
      <div class="row shops-card">
      
        {{#shops?}}
          <div class="center-align col s3">
            <div class="shop white z-depth-3">
              <a href="/shop/{{id}}">{{title}}</a>
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
    
  </div>
  
  <div class="row event-container">
    <div class="col s12">
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