<?php
namespace Blog\Actions;

use Tiimber\{Action, Session, Traits\RedirectTrait};

class LogoutAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::action::logout'
  ];
  

  public function call($request, $args)
  {
    Session::load()->destruct('user');
    $this->redirect('/');
  }
}