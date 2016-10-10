<?php
namespace Blog\Views;

use Tiimber\View;

class ProducerNewView extends View
{
  const EVENTS = [
    'request::producer::new' => 'content'
  ];

  const TPL = '
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
        <input placeholder="Placeholder" id="category" type="text" name="category">
        
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
  ';
}