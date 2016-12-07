<?php

namespace Blog\Views\Server;

use Tiimber\{View, Memory, Traits\FolderResolverTrait};

use const Tiimber\Consts\{Http\HEADER, Scopes\HTTP, Folder\DS};

class StaticsView extends View
{
  use FolderResolverTrait;

  const EVENTS = [
    'request::statics::*' => 'content'
  ];

  const TPL = '{{{file}}}';

  private $content;

  public function onGet($request, $args)
  {
    $dir = $this->getBaseDir() . DS . 'Statics' . DS;

    if ($args['folder'] == 'css') {
      Memory::get(HTTP)->set(HEADER, ['content-type:text/css; charset=utf-8']);
    }
    
    unset($args['_route']);
    $uri = $dir.implode(DS, $args);
    if (file_exists($uri)) {
      $this->content = file_get_contents($uri);
    }
  }

  public function render()
  {

    return [
      'file' => $this->content
    ];
  }
}
