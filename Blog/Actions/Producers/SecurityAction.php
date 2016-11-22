<?php
namespace Blog\Actions\Producers;

use Tiimber\{Action, Session, Traits\RedirectTrait};

class SecurityAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::producer::logged::*'
  ];
  
  public function call ($request, $args)
  {
    if (!Session::load()->get('user')) {
      $this->redirect('/espace-producteur');
    }
  }

}