<?php
namespace Blog\Actions\Shops;

use Tiimber\{Action, Traits\RedirectTrait, Session};
use RedBeanPHP\R;

class DeleteAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::producer::logged::shop::delete'
  ];
  
  public function call($request, $args) 
  {
    
    $user = Session::load()->get('user');
    
		if ($user) {
			$idShop = $args["id"];
			$bean = R::findOne('shops','id = :idShop AND owner = :idUser', [ ":idShop" => $idShop , ":idUser" => $user["id"] ]);
			if ($bean) {
        R::trash($bean);
				$this->redirect("/pro/tableau-de-bord");
			} else {
				$this->redirect("/pro/tableau-de-bord");
			}
		}
    
  }

}