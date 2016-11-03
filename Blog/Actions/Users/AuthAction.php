<?php
namespace Blog\Actions\Users;

use Tiimber\{Action, Session, Traits\RedirectTrait};
use RedBeanPHP\R;

class AuthAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::user::auth'
  ];


  public function onPost($request, $args)
  {
    //SI le formcorrespond a un user, alors ok pour le mettre en session.
    $post = (array) $request->post;
    $post = array_shift($post);
    
    if ($post->email !== null || $post->email !== '') {
        $userExist  = R::findOne( 'user', ' email = ? ', [$post->email] );
        
        if ($userExist) {
            if ($userExist->password == $post->password) {
                Session::load()->set('user', $userExist->id);
                $this->redirect('/');
            } else {
                var_dump('Mot de passe incorrect');
            }
        }
    }
  }
}