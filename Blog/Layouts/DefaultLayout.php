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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.7.1/leaflet-geocoder-mapzen.css">
    <link rel="stylesheet" href="/statics/css/pickdate/default.css">
    <link rel="stylesheet" href="/statics/css/pickdate/default.date.css">
    <link rel="stylesheet" href="/statics/css/pickdate/default.time.css">
    <link rel="stylesheet" href="/statics/css/monthly/monthly.css">
    <link rel="stylesheet" href="/statics/css/bundle.css">
  </head>
  <body>
    
    {{{navigation}}}
    
    <div class="container">
      {{{content}}}
    </div>
    
    {{{modal}}}
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geocoder-mapzen/1.7.1/leaflet-geocoder-mapzen.js"></script>
    <script src="/statics/js/pickdate/picker.js"></script>
    <script src="/statics/js/pickdate/picker.date.js"></script>
    <script src="/statics/js/pickdate/picker.time.js"></script>
    <script src="/statics/js/timetable/timetable.js"></script>
    <script src="/statics/js/monthly/monthly.js"></script>
    <script src="/statics/js/bundle.js"></script>
  </body>
</html>
HTML;
}