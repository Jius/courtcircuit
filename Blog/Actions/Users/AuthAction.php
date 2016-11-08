<?php
namespace Blog\Actions\Users;

use Tiimber\{Action, Session, Traits\RedirectTrait};
use Tiimber\Loggers\SysLogger as Logger;
use RedBeanPHP\R;

class AuthAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::user::auth'
  ];
  
  private function prepareUser($datas) {
    $user = [];
    foreach ($datas as $key=>$value) {
      if ($key !== 'password' && $key !== 'action') {
        $user[$key] = $value;
      }
    }
    return $user;
  }

  public function onPost($request, $args)
  {
    var_dump('Passé dans le onPost');
    var_dump($request->post);
    
    $tmp = (array) $request->post;
    $post = array_shift($tmp);
    
    if (!empty((array) $post)) {
      
      if ($post->email !== NULL && $post->email !== '') {
        
        $userExist  = R::findOne( 'user', ' email = ? ', [$post->email] );
        
        if ($userExist) {
          
          if ($userExist->password == $post->password) {
            
              $user = $this->prepareUser($userExist);
              Session::load()->set('user', $user);
              
          } else {
            
              var_dump('Mot de passe incorrect');
              
          }
        } else {
          
          var_dump("Identifiants mail / mot de passe incorrect");
          
        }
      }
    }
    $this->redirect('/');
  }
}