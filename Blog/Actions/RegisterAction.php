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
        
        if (!empty($id)) {
          
          $userSession = $this->prepareUserSession($registration);
          Session::load()->set('user', $userSession);
          
          $this->redirect('/pro/tableau-de-bord');
          
        } else {
          
          $this->info("Une erreur s'est produite lors de l'enregistrement dans la base de données");
          
        }
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