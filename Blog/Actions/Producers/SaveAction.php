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
    $this->producer->name = $request->post->get('name');
    $this->producer->slogan = $request->post->get('slogan');
    $this->producer->description = $request->post->get('description');
    $this->producer->category = $request->post->get('category');
    $this->producer->phone = $request->post->get('phone');
    $this->producer->email = $request->post->get('email');
    $this->producer->website = $request->post->get('website');
    $this->producer->adress = $request->post->get('adress');
    $this->producer->zipcode = $request->post->get('zipcode');
    $this->producer->city = $request->post->get('city');
    $this->producer->posLat = $request->post->get('posLat');
    $this->producer->posLong = $request->post->get('posLong');

    $id = R::store($this->producer);
    
   $this->redirect('/');
 }
}