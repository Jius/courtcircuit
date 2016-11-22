<?php
namespace Blog\Actions\Producers;

use Tiimber\{Action, Session, Traits\RedirectTrait};
use RedBeanPHP\R;

class ShopSaveAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::producer::logged::shop::create'
  ];
  
  public function onPost($request, $args)
  {
    $post = $request->post;
    
    var_dump($post);
    
  }
  
  private function preparePost($post) 
  {
    
    $table = $post->get('role');
    $r = R::dispense($table);
    
    foreach($post as $key=>$value) {
      
      if ($key !== 'role') {
        
        $r->$key = $value;
        
      }
      
    }
    
    return $r;
  }
  
  
  /*
  * prepareUserSession()
  * Rec in session all infos about user without the password and action field.
  */
  
  private function prepareUserSession($datas) {
    
    $user = [];
    
    foreach ($datas as $key=>$value) {
      
      if ($key !== 'password' && $key !== 'action') {
        
        $user[$key] = $value;
        
      }
      
    }
    
    return $user;
    
  }


}