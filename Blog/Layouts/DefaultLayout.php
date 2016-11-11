<?php
namespace Blog\Layouts;

use Tiimber\Layout;

class DefaultLayout extends Layout
{
  const TPL = <<<HTML
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Court-circuit</title>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.7.1/leaflet-geocoder-mapzen.css">
    
    <style>
      .header {
        background: #fcfcfc;
        height: 100px;
        -webkit-box-shadow: 0 0 10px 1px #4F4F4F;
        box-shadow: 0 0 10px 1px #4F4F4F;
      }
      .logo {
        font-size: 35px;
        height: 100px;
        line-height: 75px;
        margin: 0;
        padding: 0;
      }
      .logo .reduce {
        font-size: 25px;
      }
      .nav {
        margin: 0;
        padding: 0;
        width: 100%;
      }
      .nav .tab {
        display: inline-block;
        height: 50px;
        line-height: 45px;
        text-align: center;
        width: 100%;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
      }
      .nav .tab i {
        position: relative;
        right: 5px;
        top: 5px;
      }
      
      .no-bottom {
        margin-bottom: 0px !important;
      }
      .welcome {
        margin-top: 10%;
      }
      .welcome .login {
        margin: 0 20px 0 0;
      }
      .welcome .producer {
        margin-top: 5%;
      }
      .form-container-index {
        margin-top: 10%;
      }
      .actions-nav {
        position: absolute;
        right: 0;
        z-index: 2;
      }
      .search-container {
        position: relative;
      }
      .search-input {
        -webkit-border-radius: 5px 5px 5px 5px !important;
        border-radius: 5px 5px 5px 5px !important;
        border: 1px solid #e0e0e0  !important;
        color: black;
        margin: 0 !important;
        font-size: 25px !important;
        height: 4rem !important;
        padding-left: 10px !important;
      }
      .search-btn{
        position: absolute;
        right: -70px;
        top: 3px;
      }
      .my-location {
        margin: 0 0 0 30px;
      }
      .my-location i{
        color: #9e9e9e !important;
      }
      .submit-search i{
        font-size: 2rem !important;
      }
      .producer-form {
        margin-top: 20px;
      }
      .producer-form .hook{
        font-size: 26px;
      }
      .step-indicator {
        margin-bottom: 30px;
      }
      .step .caption {
        color: #9e9e9e;
        font-size: 1rem;
      }
      
      #map {
        height:180px;
        width: 100%;
      }
      
      #adress-map {
        height: 500px;
      }
      
      .adress-map-location {
        position: absolute;
        left: 5px;
        bottom: 5px;
        z-index: 1000;
      }
      
      #adress-map .leaflet-pelias-input {
        box-sizing: border-box !important;
        border-style: none !important;
        height: 100% !important;
        padding-left: 26px;
        width: 100%;
      }
      #adress-map .leaflet-pelias-input:focus {
        border-style: none none solid!important;
      }
      
      .leaflet-popup-content-wrapper {
        padding-bottom: 30px;
      }
      
      #submit-adress {
        bottom: 5px;
        color: white;
        margin: 0 0 5px 0;
        height: 30px;
        line-height: 30px;
        left: 25px;
        position: absolute;
      }
      
      ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        color: #767570 !important;
      }
      ::-moz-placeholder { /* Firefox 19+ */
        color: #767570 !important;
      }
      :-ms-input-placeholder { /* IE 10+ */
        color: #767570 !important;
      }
      :-moz-placeholder { /* Firefox 18- */
        color: #767570 !important;
      }
      
      .title {
        font-size: 14px;
      }
      .title.medium {
        font-size: 24px;
      }
      .title.big {
        font-size: 34px;
        margin: 0 0 20px;
      }
      
      /**Margin Top**/
      .m-t-med {
        margin-top: 20px !important;
      }
      .m-t-big {
        margin-top: 40px !important;
      }
    </style>
  </head>
  <body class="blue-grey lighten-5">
    {{{navigation}}}
          
    {{{content}}}
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.7.1/leaflet-geocoder-mapzen.js"></script>
    
    <script>
      
      $(document).ready(function() {
        //MAP INIT
        
        //Primary Map, on Index (map)
        if ($('#map').length > 0)
        {
          initMapHeight();
          var map = L.map('map').fitWorld();
          
          L.tileLayer('https://api.mapbox.com/styles/v1/jius/ciuqvha7f00q22hpbyev81n7n/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoiaml1cyIsImEiOiJjaXVxdjh5OWswMDJtMnhuMGZzZjRvZnRkIn0.iXdjtUptlh_daJ8CdpqvVw', {
              attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
              maxZoom: 18
          }).addTo(map);
          
          map.locate({setView: true, maxZoom: 14});
          
          map.on('locationfound', onLocationFound);
          map.on('locationerror', onLocationError);
          
          //AUTO RESIZE
          $(window).resize();
            $(window).resize(function() {
                initMapHeight();
            });
        }
        
        //Secondary map, in help when producer register.
        if ($('#adress-map').length > 0) 
        {
          var adressMap = L.map('adress-map').fitWorld();
          
          L.tileLayer('https://api.mapbox.com/styles/v1/jius/ciuqvha7f00q22hpbyev81n7n/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoiaml1cyIsImEiOiJjaXVxdjh5OWswMDJtMnhuMGZzZjRvZnRkIn0.iXdjtUptlh_daJ8CdpqvVw', {
              attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
              maxZoom: 18
          }).addTo(adressMap);
          
          adressMap.locate({setView: true, maxZoom: 14});
          
            var options = {
              position: 'topright',
              placeholder: 'Adresse de votre boutique',
              title: 'Rechercher',
              expanded: true
              },
                geocoder = L.control.geocoder('mapzen-aX1TAnZ', options);
          
          geocoder.addTo(adressMap);
          
          geocoder.on('select', onSelect);
          
          adressMap.on('locationfound', onLocationFound);
          adressMap.on('locationerror', onLocationError);
          
        }
        
        
        //END MAP INIT
        
        
        $('.tooltipped').tooltip({delay: 50});
        
        
        $(document).on ("click", "#submit-adress", function () {
          $('#adress').attr('value', $(this).attr('adress'));
          $('#zipcode').attr('value', $(this).attr('zipcode'));
          $('#city').attr('value', $(this).attr('city'));
          $('#coordinates').attr('value', $(this).attr('coordinates'));
        });
        
        $('select').material_select();
        $(".button-collapse").sideNav();
        
        
        //Init step form producer
        $('.step-prev').fadeOut();
        
        var cpt=1, steps = $('.step').length;
        $('.step-indicator .active').html(cpt);
        $('.step-indicator .total').html(steps);
        
        $('.step').each(function() {
          $(this).attr('data-step', cpt);
          if (cpt>1) {
            $(this).fadeOut();
          }
          cpt++;
        });
        if (steps>1) {
          $('.step-next').attr('link-step', 2);
        }
        
        //END INIT
         
         $('.step-next').click(function() {
          var target=parseInt($(this).attr('link-step'), 10);
          $('.step-indicator .active').html(target);
          if (target - 1 > 0) {
            $('.step-prev').fadeIn();
          }
          
          $('.step-prev').attr('link-step', target-1);
          $('.step[data-step='+(target - 1)+']').hide();
          $('.step[data-step='+(target)+']').fadeIn();
          
          
          if (target + 1 <= steps) {
            $(this).attr('link-step', target+1);
          } else {
            $(this).hide();
          }
         });
         
         $('.step-prev').click(function() {
          var target=parseInt($(this).attr('link-step'), 10);
          $('.step-indicator .active').html(target);
          
          if (target - 1 <= 0) {
            $(this).hide();
          } else {
            $(this).attr('link-step', target-1);
          }
          
          $('.step-next').attr('link-step', target + 1);
          $('.step[data-step='+(target + 1)+']').hide();
          $('.step[data-step='+(target)+']').fadeIn();
          
          if (target + 1 <= steps && $('.step-next').not(":visible")) {
            $('.step-next').fadeIn();
          }
          
         });
         
         //TAGS
          $('.chips-placeholder').material_chip({
            placeholder: 'Entrer un mot-clé',
            secondaryPlaceholder: '+Mot-clé',
          });
         
         //SUBMIT FORM PRODUCER
         $('#submit-producer').click(function () {
           var tags = '';
           $('.chips .chip').each(function() {
              var tag = $(this).text();
              if(tag.indexOf('close') >= 0){
                tag = tag.replace('close', '');
                tags = tags + tag + ';';
              } else {
                tags = tags + tag + ';';
              }
           });
           
          $('#hiddentags').val(tags);
         });
         
         //Login btn on HOMEPAGE
         $('.form-index').hide();
         $('a.login, a.register').click(function() {
          $(this).parents('.welcome').hide();
          if ($(this).hasClass('login')) {
            $('.form-index.login').fadeIn();
          } else if ($(this).hasClass('register')) {
            $('.form-index.register').fadeIn();
          }
         });
         
         $('.form-index a.return').click(function() {
           $('.form-index').hide();
           $('.welcome').fadeIn();
         });
         
         
         function onLocationFound(e) {
            var radius = e.accuracy / 2;
        
            L.marker(e.latlng).addTo(this)
                .bindPopup("Vous êtes ici, dans un rayon de " + radius + " mètres").openPopup();
        
            L.circle(e.latlng, radius).addTo(this);
        }
        
        
        function onLocationError(e) {
            console.info(e.message);
        }
    
    
        function initMapHeight() {
          var body = document.body,
              html = document.documentElement;
          
          var height = Math.max( body.scrollHeight, body.offsetHeight, 
                                 html.clientHeight, html.scrollHeight, html.offsetHeight );
                                 
          var heightMap = height - $('.header').height();
          $('#map').css('height', heightMap + 'px');
        }
        
        
        function onSelect(e) {
          //Create btn submit if don't exist
          $('<a class="waves-effect waves-light btn" id="submit-adress" coordinates="'+e.feature.geometry.coordinates+'" adress="'+e.feature.properties.name+'" zipcode="'+e.feature.properties.postalcode+'" city="'+e.feature.properties.locality+'">Valider</a>').insertAfter('.leaflet-popup-content');
        }
      });
    </script>
  </body>
</html>
HTML;
}