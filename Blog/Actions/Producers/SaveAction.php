<?php

namespace Blog\Actions\Producers;

use Tiimber\Action;
use Tiimber\Traits\RedirectTrait;

use RedBeanPHP\R;

class SaveAction extends Action
{
 use RedirectTrait;

 const EVENTS = [
   'request::producer::create'
 ];
 
 
 public function onPost($request, $args)
 {
    $this->producer = R::dispense('producer');
    
    $post = (array) $request->post;
    
    foreach (array_shift($post) as $key=>$value)
    {
     $this->producer->$key = $value;
    }
    
    $id = R::store($this->producer);
    
   $this->redirect('/');
 }
}