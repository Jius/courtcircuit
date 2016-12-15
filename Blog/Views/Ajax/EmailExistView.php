<?php
namespace Blog\Views\Ajax;

use Tiimber\{View, Session, Traits\RedirectTrait};
use RedBeanPHP\R;

class EmailExistView extends View
{
  const EVENTS = [
    'request::ajax::email::exist' => 'content'
  ];
  
  const TPL = <<<HTML
{{response}}
HTML;

  public function onGet($request, $args)
  {
    $query = $request->getQuery();
    
    $findEmail = R::count( $query['table'], ' email = ? ', [ $query['email'] ] );
    var_dump($findEmail);
    
    $this->findEmail = ($findEmail >= 1 ? 'Email déjà enregistré dans notre base de données' : 'OK');
  }
  
  public function render() 
  {
    //If doesn't find email in database, send true to ajax response
    return [
      'response' => $this->findEmail
    ];
  }
}