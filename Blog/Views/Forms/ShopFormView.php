<?php
namespace Blog\Views\Forms;

use Tiimber\{View, Session};
use RedBeanPHP\R;

class ShopFormView extends View
{
  const EVENTS = [
    'request::producer::shop::new' => 'content'
  ];

    const TPL = <<<HTML
    <div class="row">
      <form class="form-container col s6 offset-s3" action="/shop/create" method="post">
          <p class="title big">Inscription de votre <b>boutique</b></p>
          <p class="step-title center-align"></p>
          <p class="step-indicator center-align">Etape <span class="active">1</span> / <span class="total">3</span></p>
          
          <div class="step" data-title="Numéro de SIRET">
            <div class="row">
              <div class="input-field col s12">
                <input id="siret" name="siret" type="text" class="validate" required>
                <label for="siret">Numéro de SIRET</label>
              </div>
            </div>
          </div>
          
          <div class="step" data-title="Informations sur votre superbe Boutique">
          
            <div class="row">
              <div class="input-field col s12">
                <input id="title" name="title" type="text" class="validate" required>
                <label for="title">Nom de la boutique</label>
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s6">
                <input id="phone" name="phone" type="tel" class="validate">
                <label for="phone">Téléphone</label>
              </div>
              <div class="input-field col s6">
                <input id="email" name="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
            </div>
            
            <div class="row adress-container">
              <div class="col s12">
                <p class="caption">Rechercher sur la carte, l'adresse de votre boutique</p>
                <div id="adress-map"></div>
              </div>
              
              <div class="indicator-adress">
                  <p class="title small grey-text">Votre sélection sur la map</p>
                  <input placeholder="Adresse" id="adress" type="text" name="adress" class="validate" disabled>
                  <input placeholder="Code Postal" id="zipcode" type="text" name="zipcode" class="validate" disabled>
                  <input placeholder="Ville" id="city" type="text" name="city" class="validate" disabled>
              </div>
              
              <input id="coordinates" type="hidden" name="coordinates">
              
            </div>
            
          </div>
          
          <div class="step" data-title="Mieux connaître vos produits">
          
            <div class="row">
              <div class="input-field col s12">
                <select name="category">
                  <option value="" disabled selected>Choisissez une catégorie</option>
                  {{#categories}}
                    <option value="{{id}}">{{title}}</option> 
                  {{/categories}}
                  {{^categories}}
                    <p>Aucune catégorie n'a été ajoutée</p>
                  {{/categories}}
                </select>
                <label for="category">Catégorie de produits: </label>
              </div>
            </div>
          
            <div class="row">
              <div class="input-field col s12">
                <textarea  id="description" name="description" class="materialize-textarea"></textarea>
                <label for="description">Quelques mots sur votre boutiques et vos produits ? </label>
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
            
            <div class="row">
              <div class="col s12">
                <button class="btn waves-effect waves-light right" type="submit" name="action" id="submit-producer">Enregistrer la boutique
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </div>
            
          </div>
          
          <div class="step-btn-container">
            <a class="waves-effect waves-light btn step-prev step-btn blue lighten-1"><i class="material-icons left">keyboard_arrow_left</i>Retour</a>
            <a class="waves-effect waves-light btn step-next step-btn blue lighten-1"><i class="material-icons right">keyboard_arrow_right</i>Suivant</a>
          </div>
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