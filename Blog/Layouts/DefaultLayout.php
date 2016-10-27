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
    <style>
      .no-bottom {
        margin-bottom: 0px !important;
      }
      .actions-nav {
        position: absolute;
        right: 0;
        z-index: 2;
      }
      .search-container {
        position: absolute;
        text-align: center;
        width: 100%;
        z-index: 1;
      }
      .search-input {
        -webkit-border-radius: 5px 5px 5px 5px !important;
        border-radius: 5px 5px 5px 5px !important;
        border: 1px solid #e0e0e0  !important;
        color: black;
        margin: 0 !important;
        max-width: 400px;
      }
      .search-btn{
        display: inline;
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
      
      /**Margin Top**/
      .m-t-med {
        margin-top: 20px !important;
      }
    </style>
  </head>
  <body class="blue-grey lighten-5">
    <nav id="navigation">
      <div class="nav-wrapper light-blue accent-2">
        <a href="/" class="brand-logo">CourtCircuit</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="actions-nav hide-on-med-and-down">
          <li><a href="/producteur">Producteur</a></li>
        </ul>
        <form class="search-container">
          <input id="q" class="search-input white" name="q" placeholder="Que recherchez-vous ?" type="text">
          <div class="search-btn">
            <button class="btn-floating btn-large waves-effect waves-light orange darken-4" type="submit" name="action">
              <i class="material-icons">search</i>
            </button>
          </div>
        </form>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="/producteur">Producteur</a></li>
        </ul>
      </div>
    </nav>
          
    {{{content}}}
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    
    <script>
    //Geolocation + LeafletJs
    if (document.getElementById("map")) {
      var map = L.map('map').fitWorld();
      
      L.tileLayer('https://api.mapbox.com/styles/v1/jius/ciuqvha7f00q22hpbyev81n7n/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoiaml1cyIsImEiOiJjaXVxdjh5OWswMDJtMnhuMGZzZjRvZnRkIn0.iXdjtUptlh_daJ8CdpqvVw', {
          attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
          maxZoom: 18
      }).addTo(map);
      
      map.locate({setView: true, maxZoom: 14});
      
      map.on('locationfound', onLocationFound);
      map.on('locationerror', onLocationError);
    }
    
    function onLocationFound(e) {
        var radius = e.accuracy / 2;
    
        L.marker(e.latlng).addTo(map)
            .bindPopup("You are within " + radius + " meters from this point").openPopup();
    
        L.circle(e.latlng, radius).addTo(map);
    }
    
    function onLocationError(e) {
        console.info(e.message);
    }

    function initMapHeight() {
      var body = document.body,
          html = document.documentElement;
      
      var height = Math.max( body.scrollHeight, body.offsetHeight, 
                             html.clientHeight, html.scrollHeight, html.offsetHeight );
      var heightMap = height - document.getElementById('navigation').clientHeight;
      document.getElementById("map").style.height = heightMap + "px";
    }
    
      $(document).ready(function() {
        
        if ($('#map').length > 0) {
          $(window).resize();
          $(window).resize(function() {
              initMapHeight();
          });
        }
        
        
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
         
      });
    </script>
  </body>
</html>
HTML;
}