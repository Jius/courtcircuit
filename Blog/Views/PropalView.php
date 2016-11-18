<?php
namespace Blog\Views;

use Tiimber\{View};
use RedBeanPHP\R;

class PropalView extends View
{
  const EVENTS = [
    'request::propal' => 'content'
  ];
  
  const TPL = <<<HTML
<p class="title medium">Super ! Vous allez nous aider à faire avancer la communauté Courtcircuit ! <br/>Vous êtes formidable</p>
<p class="title small">Vous pouvez ajouter, une <b>boutique de produits locaux</b>, ou encore un <b>événement</b> (<b>marché</b>, <b>roulotte</b>, ...)</p>

<div class="row">
  <form class="col s12">
    <div class="input-field col s6">
      <select name="type">
        <option value="" disabled selected>Choissisez le type d'ajout</option>
        <option value="place">Boutique producteur</option>
        <option value="event">Evénement</option>
      </select>
      <label>Ajouter au réseau Courtcircuit</label>
    </div>
  </form>
</div>
HTML;
}