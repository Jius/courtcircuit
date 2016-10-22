<?php
namespace Blog\Views;

use Tiimber\View;

class IndexView extends View
{
  const EVENTS = [
    'request::index' => 'content'
  ];

  const TPL = '
  <div class="row">
    <form class="col s12">
      <div class="row m-t-med">
        <div class="col s4 hide-on-med-and-down"></div>
        <div class="input-field col s12 m12 l4">
          <input id="q" name="q" class="search white" placeholder="Que recherchez-vous ?" type="text">
        </div>
        <div class="input-field search-btn col s12 m12 l4">
          <button class="btn-floating btn-large waves-effect waves-light orange darken-4" type="submit" name="action">
            <i class="material-icons">search</i>
          </button>
          <a class="btn-floating btn-large waves-effect waves-light white my-location"><i class="material-icons">my_location</i></a>
        </div>
      </div>
    </form>
  </div>
  ';
}