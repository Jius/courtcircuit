<?php
namespace Blog\Actions;

use Tiimber\{Action, Session, Traits\RedirectTrait};
use RedBeanPHP\R;

class LoginAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::action::login'
  ];
  
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

  public function onPost($request, $args)
  {
    $post = $request->post;
    $table = $post->get('role');

    if (!empty((array) $post) && $table !== '') {
      
      if ($post->get('email') !== NULL && $post->get('email') !== '') {
        
        $user  = R::findOne( $table , ' email = ? ', [$post->get('email')] );
        
        if ($user) {
          
          if ($user->password == $post->get('password')) {
            
              $userSession = $this->prepareUserSession($user);
              Session::load()->set('user', $userSession);
              $this->redirect('/');
              
          } else {
              $this->info('Mot de passe erroné');
              
          }
        } else {
          
          $this->info("Aucun utilisateur enregistré à cette adresse mail");
          
        }
      }
    }
  }
}