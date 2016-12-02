<?php
namespace Blog\Views\Producers;

use Tiimber\{View, Session};

use RedBeanPHP\R;

class EditShopView extends View
{
  const EVENTS = [
    'request::producer::logged::shop::edit' => 'content',
  ];
  
  const TPL = <<<HTML
  	{{#shop}}
			<div class="row">
			  <form class="col s12">
			    <div class="row">
			      <div class="input-field col s6">
			        <input id="title" type="text" class="validate" name="title" value="{{title}}">
			        <label for="title">Nom de la boutique</label>
			      </div>
			      <div class="input-field col s6">
			        <input id="siret" type="text" class="validate" name="siret" value="{{siret}}">
			        <label for="siret">Siret</label>
			      </div>
			    </div>
			  </form>
			</div>
  	{{/shop}}
HTML;
	
	public function onGet($request, $args) 
	{
		$user = Session::load()->get('user');
		if ($user) {
			$idShop = $args["id"];
			$shop = R::findOne('shops','id = :idShop AND owner = :idUser', [ ":idShop" => $idShop , ":idUser" => $user["id"] ]);
			if ($shop) {
				$this->shop = $shop;
			} else {
				$this->redirect("/pro/tableau-de-bord");
			}
		}
	}

  public function render()
  {
  	return [
      'shop' => array($this->shop)
    ];
  }
}