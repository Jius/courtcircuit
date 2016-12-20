<?php
namespace Blog\Views\Ajax;

use Tiimber\{View, Session, Traits\RedirectTrait};
use RedBeanPHP\R;

class GetTagsView extends View
{
  const EVENTS = [
    'request::ajax::tag::get' => 'content'
  ];
  
  const TPL = <<<HTML
{{response}}
HTML;

  public function onGet($request, $args)
  {
    $tags = R::getAll( 'SELECT * FROM tag' );
    $arrayTags = [];
    
    //By letter
    foreach ($tags as $key=>$tag) {
      for ($i = 1; $i <= strlen($tag['title']); $i++) {
        $l = substr($tag['title'], 0, $i);
        $arrayTags[$l][] = array(
          'id' => $tag['id'],
          'text' => $tag['title']
        );
      }
    }
    
    $this->tags = $arrayTags;
  }
}