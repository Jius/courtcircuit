<?php
namespace Blog\Views\Ajax;

use Tiimber\{View, Session, Traits\RedirectTrait};
use RedBeanPHP\R;

class GetTagsView extends View
{
  const EVENTS = [
    'request::ajax::tag::get' => 'content'
  ];
  
  const TPL = <<<EOS
{{tags}}
EOS;

  public function onGet($request, $args)
  {
    $tags = R::getAll( 'SELECT * FROM tag' );
    $arrayTags = [];

    foreach ($tags as $key=>$tag) {
      $arrayTags[$tag['title']] = $tag['id'];
    }
    
    $arrayTags = json_encode($arrayTags, JSON_UNESCAPED_UNICODE);
    $this->tags = $arrayTags;
  }
  
  public function render()
  {
    return [
      'tags' => $this->tags
    ];
  }
}