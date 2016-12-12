<?php
namespace Blog\Views\Producers;

use Tiimber\{View, Session};

use RedBeanPHP\R;

class EventNewView extends View
{
  const EVENTS = [
    'request::producer::logged::event::new' => 'content',
  ];
  
  const TPL = <<<HTML
  <h1>Evenements & Déplacements</h1>
  <form>
    <div class="row">
      <div class="input-field col s6">
        <input type="date" class="datepicker" name="from_date" id="from_date">
        <label for="from_date">Quand ?</label>
      </div>
      <div class="input-field col s6">
        <input type="date" class="datepicker" name="to_date" id="to_date">
        <label for="to_date">Jusqu'à ?</label>
      </div>
    </div>
    
    <div class="row">
      <div class="input-field col s12">
        <input type="text" class="validate" name="title" id="title">
        <label for="title">Titre de l'événement</label>
      </div>
    </div>
    
    <div class="row">
      <div class="input-field col s12">
        <textarea id="description" class="materialize-textarea" name="description"></textarea>
        <label for="description">Description de l'événement</label>
      </div>
    </div>
    
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
      <i class="material-icons right">send</i>
    </button>
  </form>
HTML;


  public function render()
  {
  }
}