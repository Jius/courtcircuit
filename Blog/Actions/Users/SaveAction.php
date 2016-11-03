<?php

namespace Blog\Actions\Users;

use Tiimber\{Action, Session, Traits\RedirectTrait};
use RedBeanPHP\R;

class SaveAction extends Action
{
 use RedirectTrait;

 const EVENTS = [
   'request::user::create'
 ];
 
 private function createUser ($user) 
 {
   $userExist  = R::find( 'user', ' email = ? ', [$user->email] );
   
   if ($userExist == null || empty($userExist)) {
    $id = R::store($user);    
    return $id;
   } else {
    return false;
   }
 }
 
 private function prepareUser($post) 
 {
  $user = R::dispense('user');
  foreach (array_shift($post) as $key=>$value)
   {
      $user->$key = $value;
   }
   return $user;
 }
 
 public function onPost($request, $args)
 {
    $post = (array) $request->post;
    
    $user = $this->prepareUser($post);
    
    if (isset($user) && !empty($user)) {
     $created = $this->createUser($user);
    }
    
    if ($created) {
     Session::load()->set('user', $created);
     $this->redirect('/');
    }
 }
}