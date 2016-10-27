<?php
namespace Blog\Views;

use Tiimber\View;

class IndexView extends View
{
  const EVENTS = [
    'request::index' => 'content'
  ];
  
  const TPL = <<<HTML
<div id="map"></div>
<!-- <a class="btn-floating btn-large waves-effect waves-light white my-location"><i class="material-icons">my_location</i></a> -->
HTML;

}