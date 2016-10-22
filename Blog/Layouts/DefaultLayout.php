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
    <style>
      .no-bottom {
        margin-bottom: 0px !important;
      }
      .search {
        -webkit-border-radius: 5px 5px 5px 5px !important;
        border-radius: 5px 5px 5px 5px !important;
        border: 1px solid #e0e0e0  !important;
      }
      .search-btn{
        margin-top: 10px !important;
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
  
    <nav>
      <div class="nav-wrapper light-blue accent-2">
        <a href="#" class="brand-logo">Court-circuit</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="/producteur">Producteur</a></li>
        </ul>
      </div>
    </nav>
        
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