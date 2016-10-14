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
<form action="/pro/create" method="post">
  <label for="name">Nom de l entreprise: </label>
  <input placeholder="Placeholder" id="name" type="text" name="name">
  
  <br/>
  <label for="slogan">Slogan: </label>
  <input placeholder="Placeholder" id="slogan" type="text" name="slogan">
  
  <br/>
  <label for="description">Quelques mots sur l entreprise: </label>
  <textarea  id="description" name="description"></textarea>
  
  <br/>
  <label for="category">Catégorie: </label>
  <select name="category">
    <option value="" disabled selected>Choississez une catégorie</option>
    {{#categories}}
      <option value="{{id}}">{{title}}</option> 
    {{/categories}}
    {{^categories}}
      <p>Aucune catégorie n'a été ajoutée</p>
    {{/categories}}
  </select>
  
  <br/>
  <label for="labels">Label(s): </label>
  <select name="labels">
    <option value="" disabled selected>Choississez un ou des labels</option>
    {{#labels}}
      <option value="{{id}}">{{title}}</option> 
    {{/labels}}
    {{^labels}}
      <p>Aucun label n'a été ajoutée</p>
    {{/labels}}
  </select>
  <br/>
  
  <label for="tags">Tags (séparé par un ;) : </label>
  <input placeholder="Placeholder" id="tags" type="text" name="tags">
  
  <br/>
  <label for="phone">Téléphone: </label>
  <input placeholder="Placeholder" id="phone" type="text" name="phone">
  
  <br/>
  <label for="email">Email: </label>
  <input placeholder="Placeholder" id="email" type="text" name="email">
  
  <br/>
  <label for="website">Site web: </label>
  <input placeholder="Placeholder" id="website" type="text" name="website">
  
  <br/>
  <label for="owner">Nom(s) propriétaire(s): </label>
  <textarea  id="owner" name="owner"></textarea>
  
  <br/>
  <label for="adress">Adresse: </label>
  <input placeholder="Placeholder" id="adress" type="text" name="adress">
  
  <br/>
  <label for="zipcode">Code postal: </label>
  <input placeholder="Placeholder" id="zipcode" type="text" name="zipcode">
  
  <br/>
  <label for="city">Ville: </label>
  <input placeholder="Placeholder" id="city" type="text" name="city">
  
  <br/>
  <label for="posLat">Position Latitude: </label>
  <input placeholder="Placeholder" id="posLat" type="text" name="posLat">
  
  <br/>
  <label for="posLong">Position Longitudinal: </label>
  <input placeholder="Placeholder" id="posLong" type="text" name="posLong">
  
  <br/>
  <button type="submit" name="action">Submit</button
</form>
HTML;


  public function render()
  {
    $categories = R::findAll('category','ORDER BY title');
    $labels = R::findAll('labels','ORDER BY title');
    return ['categories' => array_values($categories), 'labels' => array_values($labels)];
  }
}