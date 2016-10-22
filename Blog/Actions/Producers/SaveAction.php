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
    $post = (array) $request->post;
    
    $this->producer = R::dispense('producer');
    foreach (array_shift($post) as $key=>$value)
    {
      if ($key === 'tags' && $value !== '') {
       $datas = explode(';',$value);
       $tags = array();
       foreach ($datas as $i=>$tag) {
        if (!empty($tag)) {
         array_push($tags, $tag);
        }
       }
       R::addTags( $this->producer, $tags);
       
      } else {
       $this->producer->$key = $value;
      }
    }
    $id = R::store($this->producer);
    
   $this->redirect('/');
 }
}