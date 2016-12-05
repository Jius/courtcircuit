<?php
namespace Blog\Views\Modals;

use Tiimber\{View, Session};
use RedBeanPHP\R;

class AlertsView extends View
{
  const EVENTS = [
    'request::*' => 'modal'
  ];
  
  const TPL = <<<HTML
  <div id="modal-delete" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>Êtes-vous sûr de vouloir le supprimer ?</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-close">Annuler</a>
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-confirm">Confirmer</a>
    </div>
  </div>
HTML;
}