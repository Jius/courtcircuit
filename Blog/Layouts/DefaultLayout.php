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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    
  </head>
  <body>
    <div class="container">
      {{{content}}}
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <script>
      $(document).ready(function() {
        $('select').material_select();
        
        //Init step form producer
        $('.step-prev').fadeOut();
        
        var cpt=1, steps = $('.step').length;
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
      });
    </script>
  </body>
</html>
HTML;
}