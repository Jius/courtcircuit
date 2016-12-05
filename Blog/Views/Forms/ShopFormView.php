<?php
namespace Blog\Views\Forms;

use Tiimber\{View, Session};
use RedBeanPHP\R;

class ShopFormView extends View
{
  const EVENTS = [
    'request::producer::logged::shop::new' => 'content'
  ];

    const TPL = <<<HTML
    <div class="row">
      <form class="form-container col s10 offset-s1" action="/shop/create" method="post">
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
                <label for="title">Nom de la boutique <span class="required">*</span></label>
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s12">
                <input id="slogan" name="slogan" type="text" class="validate">
                <label for="slogan">Phrase d'accroche / Votre slogan</label>
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s4">
                <input id="phone" name="phone" type="tel" class="validate">
                <label for="phone">Téléphone</label>
              </div>
              <div class="input-field col s8">
                <input id="email" name="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s8">
                <input id="web" name="web" type="text" class="validate">
                <label for="web">Site web</label>
              </div>
            </div>
            
            <div class="row adress-container">
              <div class="col s12">
                <p class="caption medium">Adresse</p>
                <div class="hero">
                  <p class="caption no-margin">
                    L'adresse correspond à votre vitrine, ou le lieu où vous pouvez vendre vos produit. <br/> 
                    Il se peut que vous n'en avez pas (que vous êtes nomades), dans ce cas là, veuillez cocher la case suivante, puis à la fin de l'inscription je vous invite à rentrer les dates de vos déplacements.
                  </p>
                  <p>
                    <input type="checkbox" class="filled-in" id="itinerant" name="itinerant"/>
                    <label for="itinerant">Vous n'avez pas de vitrine pour vendre chez vous ?</label>
                  </p>
                </div>
                <div id="adress-map" class="m-t-med"></div>
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
                <textarea  id="description" name="description" class="materialize-textarea" required></textarea>
                <label for="description">Quelques mots sur votre boutiques et vos produits ? </label>
              </div>
            </div>
            
            <div class="row">
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
                <label for="category">Catégorie de produits: </label>
              </div>
              
              <div class="input-field col s6">
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
          
          <div class="step" data-title="Horaires et jours d'ouvertures">
            <div class="row timetable">
              <div class="col s12">
                <p class="caption medium">Horaires et jours d'ouvertures</p>
                
                <div class="row daytable">
                
                  <div class="col s2 day">
                    <p class="label center-align">Lundi</p>
                    
                    <div class="opening">
                      <p class="caption">Horaires</p>
                      
                      <div class="all">
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-lundi" type="text" class="validate hour" name="hour-start-lundi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À" id="hour-end-lundi" type="text" class="validate hour" name="hour-end-lundi">
                          </div>
                        </div>
                      </div>
                      
                      <p>
                        <input type="checkbox" class="filled-in check-split" id="split-lundi" name="split-lundi"/>
                        <label for="split-lundi">Interruption</label>
                      </p>
                      
                      <div class="split">
                        Matin:
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-am-lundi" type="text" class="validate hour" name="hour-start-am-lundi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-am-lundi" type="text" class="validate hour" name="hour-end-am-lundi">
                          </div>
                        </div>
                        
                        Et l'après-midi:
                        
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De " id="hour-start-pm-lundi" type="text" class="validate hour" name="hour-start-pm-lundi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-pm-lundi" type="text" class="validate hour" name="hour-end-pm-lundi">
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  
                  <div class="col s2 day">
                    <p class="label center-align">Mardi</p>
                    
                    <div class="opening">
                      <p class="caption">Horaires</p>
                      
                      <div class="all">
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-mardi" type="text" class="validate hour" name="hour-start-mardi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À" id="hour-end-mardi" type="text" class="validate hour" name="hour-end-mardi">
                          </div>
                        </div>
                      </div>
                      
                      <p>
                        <input type="checkbox" class="filled-in check-split" id="split-mardi" name="split-mardi"/>
                        <label for="split-mardi">Interruption</label>
                      </p>
                      
                      <div class="split">
                        Matin:
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-am-mardi" type="text" class="validate hour" name="hour-start-am-mardi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-am-mardi" type="text" class="validate hour" name="hour-end-am-mardi">
                          </div>
                        </div>
                        
                        Et l'après-midi:
                        
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De " id="hour-start-pm-mardi" type="text" class="validate hour" name="hour-start-pm-mardi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-pm-mardi" type="text" class="validate hour" name="hour-end-pm-mardi">
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  
                  <div class="col s2 day">
                    <p class="label center-align">Mercredi</p>
                    
                    <div class="opening">
                      <p class="caption">Horaires</p>
                      
                      <div class="all">
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-mercredi" type="text" class="validate hour" name="hour-start-mercredi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À" id="hour-end-mercredi" type="text" class="validate hour" name="hour-end-mercredi">
                          </div>
                        </div>
                      </div>
                      
                      <p>
                        <input type="checkbox" class="filled-in check-split" id="split-mercredi" name="split-mercredi"/>
                        <label for="split-mercredi">Interruption</label>
                      </p>
                      
                      <div class="split">
                        Matin:
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-am-mercredi" type="text" class="validate hour" name="hour-start-am-mercredi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-am-mercredi" type="text" class="validate hour" name="hour-end-am-mercredi">
                          </div>
                        </div>
                        
                        Et l'après-midi:
                        
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De " id="hour-start-pm-mercredi" type="text" class="validate hour" name="hour-start-pm-mercredi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-pm-mercredi" type="text" class="validate hour" name="hour-end-pm-mercredi">
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  
                  <div class="col s2 day">
                    <p class="label center-align">Jeudi</p>
                    
                    <div class="opening">
                      <p class="caption">Horaires</p>
                      
                      <div class="all">
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-jeudi" type="text" class="validate hour" name="hour-start-jeudi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À" id="hour-end-jeudi" type="text" class="validate hour" name="hour-end-jeudi">
                          </div>
                        </div>
                      </div>
                      
                      <p>
                        <input type="checkbox" class="filled-in check-split" id="split-jeudi" name="split-jeudi"/>
                        <label for="split-jeudi">Interruption</label>
                      </p>
                      
                      <div class="split">
                        Matin:
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-am-jeudi" type="text" class="validate hour" name="hour-start-am-jeudi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-am-jeudi" type="text" class="validate hour" name="hour-end-am-jeudi">
                          </div>
                        </div>
                        
                        Et l'après-midi:
                        
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De " id="hour-start-pm-jeudi" type="text" class="validate hour" name="hour-start-pm-jeudi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-pm-jeudi" type="text" class="validate hour" name="hour-end-pm-jeudi">
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  
                  <div class="col s2 day">
                    <p class="label center-align">Vendredi</p>
                    <div class="opening">
                      <p class="caption">Horaires</p>
                      
                      <div class="all">
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-vendredi" type="text" class="validate hour" name="hour-start-vendredi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À" id="hour-end-vendredi" type="text" class="validate hour" name="hour-end-vendredi">
                          </div>
                        </div>
                      </div>
                      
                      <p>
                        <input type="checkbox" class="filled-in check-split" id="split-vendredi" name="split-vendredi"/>
                        <label for="split-vendredi">Interruption</label>
                      </p>
                      
                      <div class="split">
                        Matin:
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De" id="hour-start-am-vendredi" type="text" class="validate hour" name="hour-start-am-vendredi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-am-vendredi" type="text" class="validate hour" name="hour-end-am-vendredi">
                          </div>
                        </div>
                        
                        Et l'après-midi:
                        
                        <div class="row">
                          <div class="col s6">
                            <input placeholder="De " id="hour-start-pm-vendredi" type="text" class="validate hour" name="hour-start-pm-vendredi">
                          </div>
                          <div class="col s6">
                            <input placeholder="À " id="hour-end-pm-vendredi" type="text" class="validate hour" name="hour-end-pm-vendredi">
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row daytable weekend">
              <div class="col s2 day">
                <p class="label center-align">Samedi</p>
                
                <div class="opening">
                  <p class="caption">Horaires</p>
                  
                  <div class="all">
                    <div class="row">
                      <div class="col s6">
                        <input placeholder="De" id="hour-start-samedi" type="text" class="validate hour" name="hour-start-samedi">
                      </div>
                      <div class="col s6">
                        <input placeholder="À" id="hour-end-samedi" type="text" class="validate hour" name="hour-end-samedi">
                      </div>
                    </div>
                  </div>
                  
                  <p>
                    <input type="checkbox" class="filled-in check-split" id="split-samedi" name="split-samedi"/>
                    <label for="split-samedi">Interruption</label>
                  </p>
                  
                  <div class="split">
                    Matin:
                    <div class="row">
                      <div class="col s6">
                        <input placeholder="De" id="hour-start-am-samedi" type="text" class="validate hour" name="hour-start-am-samedi">
                      </div>
                      <div class="col s6">
                        <input placeholder="À " id="hour-end-am-samedi" type="text" class="validate hour" name="hour-end-am-samedi">
                      </div>
                    </div>
                    
                    Et l'après-midi:
                    
                    <div class="row">
                      <div class="col s6">
                        <input placeholder="De " id="hour-start-pm-samedi" type="text" class="validate hour" name="hour-start-pm-samedi">
                      </div>
                      <div class="col s6">
                        <input placeholder="À " id="hour-end-pm-samedi" type="text" class="validate hour" name="hour-end-pm-samedi">
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              
              <div class="col s2 day">
                <p class="label center-align">Dimanche</p>
                
                <div class="opening">
                  <p class="caption">Horaires</p>
                  
                  <div class="all">
                    <div class="row">
                      <div class="col s6">
                        <input placeholder="De" id="hour-start-dimanche" type="text" class="validate hour" name="hour-start-dimanche">
                      </div>
                      <div class="col s6">
                        <input placeholder="À" id="hour-end-dimanche" type="text" class="validate hour" name="hour-end-dimanche">
                      </div>
                    </div>
                  </div>
                  
                  <p>
                    <input type="checkbox" class="filled-in check-split" id="split-dimanche" name="split-dimanche"/>
                    <label for="split-dimanche">Interruption</label>
                  </p>
                  
                  <div class="split">
                    Matin:
                    <div class="row">
                      <div class="col s6">
                        <input placeholder="De" id="hour-start-am-dimanche" type="text" class="validate hour" name="hour-start-am-dimanche">
                      </div>
                      <div class="col s6">
                        <input placeholder="À " id="hour-end-am-dimanche" type="text" class="validate hour" name="hour-end-am-dimanche">
                      </div>
                    </div>
                    
                    Et l'après-midi:
                    
                    <div class="row">
                      <div class="col s6">
                        <input placeholder="De " id="hour-start-pm-dimanche" type="text" class="validate hour" name="hour-start-pm-dimanche">
                      </div>
                      <div class="col s6">
                        <input placeholder="À " id="hour-end-pm-dimanche" type="text" class="validate hour" name="hour-end-pm-dimanche">
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <input type="hidden" name="daytable">
          </div>
          
          <div class="row submit-producer-container">
            <div class="col s12">
              <button class="btn waves-effect waves-light right orange" type="submit" name="action" id="submit-producer">Enregistrer la boutique
                <i class="material-icons right">send</i>
              </button>
            </div>
          </div>
          
          <div class="step-btn-container">
            <a class="waves-effect waves-light btn step-prev step-btn blue lighten-1"><i class="material-icons left">keyboard_arrow_left</i>Retour</a>
            <a class="waves-effect waves-light btn step-next step-btn blue lighten-1"><i class="material-icons right">keyboard_arrow_right</i>Suivant</a>
          </div>
          
          <input type="hidden" name="validate_shop" value="false">
          <input type="hidden" name="owner" value="{{producerId}}">
      </form>
    </div>
    
HTML;

    public function render()
    {
      $categories = R::findAll('category','ORDER BY title');
      $labels = R::findAll('labels','ORDER BY title');
      $user = Session::load()->get('user');
      return ['categories' => array_values($categories), 'labels' => array_values($labels), "producerId" => $user["id"]];
    }
}