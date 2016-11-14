<?php
namespace Blog\Actions;

use Tiimber\{Action, Session, Traits\RedirectTrait};
use RedBeanPHP\R;

class RegisterAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::action::register'
  ];
  
  public function onPost($request, $args)
  {
    $post = $request->post;

    if (!empty((array) $post) && $table !== '') {
      
      if ($post->get('email') !== '') {
        
        $registration = $this->preparePost($post);
        
        $id = R::store($registration);
        
        $this->redirect('/espace-producteur');
      }
      
    }
    
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

}