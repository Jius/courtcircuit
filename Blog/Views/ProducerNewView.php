<?php
namespace Blog\Views;

use Tiimber\View;

use RedBeanPHP\R;

class ProducerNewView extends View
{
  const EVENTS = [
    'request::producer::new' => 'content'
  ];
  
  const TPL = <<<HTML
<div class="row">
  <form action="/pro/create" method="post" class="col s6 offset-s3 producer-form">
    <p class="hook center-align">INSCRIPTION</p>
    <p class="step-indicator center-align">Etape <span class="active">1</span> / <span class="total">3</span></p>
            
    <div class="step">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="name" type="text" name="name" class="validate">
          <label for="name">Nom de l entreprise: </label>
        </div>
        
        <div class="input-field col s6">
          <select name="category">
            <option value="" disabled selected>Choisissez une catégorie</option>
            {{#categories}}
              <option value="{{id}}">{{title}}</option> 
            {{/categories}}
            {{^categories}}
              <p>Aucune catégorie n'a été ajoutée</p>
            {{/categories}}
          </select>
          <label for="category">Catégorie: </label>
        </div>
      </div>
      
      <div class="row">
        <div class="input-field col s12">
          <textarea  id="description" name="description" class="materialize-textarea"></textarea>
          <label for="description">Que proposez vous en produits locaux ? </label>
        </div>
      </div>
      
      <div class="row">
        <div class="input-field col s12">
          <select multiple name="labels[]">
            <option value="" disabled selected>Possèdez vous des labels ?</option>
            {{#labels}}
              <option value="{{id}}">{{title}}</option> 
            {{/labels}}
            {{^labels}}
              <p>Aucun label n'a été ajoutée</p>
            {{/labels}}
          </select>
          <label for="labels">Label(s): </label>
        </div>
      </div>
      
      <p class="caption">Insérer des mots-clés pour mieux vous retrouver, par les internautes</p>
      <div class="chips chips-placeholder"></div>
      <input id="hiddentags" type="hidden" name="tags">
    </div>
    
    <div class="step">
      <div class="row">
        <div class="input-field col s12">
          <textarea  id="owner" name="owner" class="materialize-textarea"></textarea>
          <label for="owner">Nom(s) du ou des propriétaire(s): </label>
        </div>
      </div>
      
      <div class="row">
      <div class="col s12">
        <p class="caption">Rechercher sur la carte, l'adresse de votre boutique</p>
        <div id="adress-map"></div>
      </div>
      </div>
      
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="adress" type="text" name="adress" class="validate">
          <label for="adress">Adresse (de la boutique): </label>
        </div>
        
        <div class="input-field col s3">
          <input placeholder="Placeholder" id="zipcode" type="text" name="zipcode" class="validate">
          <label for="zipcode">Code postal: </label>
        </div>
        
        <div class="input-field col s3">
          <input placeholder="Placeholder" id="city" type="text" name="city" class="validate">
          <label for="city">Ville: </label>
        </div>
      </div>
      
      <input id="coordinates" type="hidden" name="coordinates">
      
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Placeholder" id="slogan" type="text" name="slogan" class="validate">
          <label for="slogan">Avez vous un slogan ou un phrase d'accroche ? (qui sera présent sur votre page de présentation de votre boutique)</label>
        </div>
      </div>
      
    </div>
    
    <div class="step">
      <div class="row">
        <div class="input-field col s5">
          <input placeholder="Placeholder" id="email" type="text" name="email" class="validate">
          <label for="email">Email: </label>
        </div>
        
        <div class="input-field col s3">
          <input placeholder="Placeholder" id="phone" type="text" name="phone" class="validate">
          <label for="phone">Téléphone: </label>
        </div>
        
        
        <div class="input-field col s4">
          <input placeholder="Placeholder" id="website" type="text" name="website" class="validate">
          <label for="website">Site web: </label>
        </div>
      </div>
      
      <div class="row">
        <div class="col s4 offset-s8">
          <button class="btn waves-effect waves-light" type="submit" name="action" id="submit-producer">Enregistrer
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
    </div>
    <a class="waves-effect waves-light btn step-prev step-btn blue lighten-1"><i class="material-icons left">keyboard_arrow_left</i>Retour</a>
    <a class="waves-effect waves-light btn step-next step-btn blue lighten-1"><i class="material-icons right">keyboard_arrow_right</i>Suivant</a>
  </form>
</div>
HTML;


  public function render()
  {
    $categories = R::findAll('category','ORDER BY title');
    $labels = R::findAll('labels','ORDER BY title');
    return ['categories' => array_values($categories), 'labels' => array_values($labels)];
  }
}