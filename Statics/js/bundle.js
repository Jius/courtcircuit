var $ = window.$ || {};
$(document).ready(function() {
  
  $('#calendar').monthly({
    mode: 'event',
		jsonUrl: '/statics/json/events.json',
		dataType: 'json'
  });
  
  $('.datepicker').pickadate({
    monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'Le dddd dd mmmm yyyy',
    formatSubmit: 'yyyy-mm-dd',
    onSet: function( arg ){
      if ( 'select' in arg ){ //prevent closing on selecting month/year
          this.close();
      }
    }
  });
  /*
  * MAP LEAFLET + MAPZEN INIT
  *
  */
  
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
          placeholder: 'Adresse de votre boutique *',
          title: 'search-map',
          expanded: true
        },
        geocoder = L.control.geocoder('mapzen-aX1TAnZ', options);
    
    geocoder.addTo(adressMap);
    
    //Add required attr to input search
    $('input[title="search-map"]').prop('required', true);
    
    geocoder.on('select', onSelect);
    
    adressMap.on('locationfound', onLocationFound);
    adressMap.on('locationerror', onLocationError);
    
  }
  
  //END MAP INIT
  
  $('.timetable').timetable();
  $('.tooltipped').tooltip({delay: 50});
  $(".button-collapse").sideNav();
  $('select').material_select();
  $('.modal').modal();
  
  
  $(document).on ("click", "#submit-adress", function () {
    var text = ($(this).text() == 'Sélectionner' ? 'Désélectionner' : 'Sélectionner');
    
    $(this).text(text);
    $(this).toggleClass('pink');
    $(this).prev().toggleClass('pink-text');
    
    $("input[title='search-map']").prop('disabled', function (_, val) { return ! val; });
    
    $('#adress').attr('value', $(this).attr('adress'));
    $('#zipcode').attr('value', $(this).attr('zipcode'));
    $('#city').attr('value', $(this).attr('city'));
    $('#coordinates').attr('value', $(this).attr('coordinates'));
  });
  
  
  $('input#email.check-exist').blur(function() {
    var emailVal = $(this).val(),
        emailValid = $(this).hasClass('valid'),
        tableVal = $('input#role').val(),
        target = $(this);
        console.log(emailVal);
        console.log(emailValid);
    if (emailValid) {
      $.ajax({
       url : '/check-email-exist',
       type : 'GET',
       data : {email : emailVal, table : tableVal} ,
       dataType : 'text',

       complete : function(response){
         if (response.responseText == 'OK') {
           msg_input(target, 'Email disponible');
         } else {
           msg_input(target, response.responseText, 'error');
         }
       }
      });
    } else {
      msg_input(target, 'Email incorrect', 'error');
    }
  });
  
  //Init step form producer
  $('.step-prev').hide();
  $('.submit-producer-container').hide();
  
  var cpt=1, 
      steps = $('.step').length;
  
  if (cpt == steps) {
    $('.submit-producer-container').fadeToggle();
  }
  
  $('.step-indicator .active').html(cpt);
  $('.step-indicator .total').html(steps);
  
  $('.step').each(function() {
  
    $(this).attr('data-step', cpt);
    
    if (cpt>1) {
      $(this).fadeOut();
    }
    
    if (cpt == steps) {
      var stepTitle = $('.step[data-step=1]').attr('data-title');
      $('.step-title').html("<b>"+stepTitle+"</b>");
    }
    
    cpt++;
    
  });
  
  if (steps>1) {
    $('.step-next').attr('link-step', 2);
  }
  
  
  //END INIT
   
   $('.step-next').click(function() {
   
    var target = parseInt($('.step-next').attr('link-step'), 10),
        step = target - 1,
        stepTitle = $('.step[data-step='+(target)+']').attr('data-title');
    
    if (validateStep(step)) {
      
      $('.step-indicator .active').html(target);
      $('.step-title').html("<b>"+stepTitle+"</b>");
      
      if (target - 1 > 0) {
        $('.step-prev').fadeIn();
      }
      
      $('.step-prev').attr('link-step', target-1);
      $('.step[data-step='+(target - 1)+']').hide();
      $('.step[data-step='+(target)+']').fadeIn();
      
      
      if (target + 1 <= steps) {
        $('.step-next').attr('link-step', target+1);
      } else {
        $('.step-next').hide();
        $('.submit-producer-container').fadeToggle();
      }
      
    }
    
   });
   
   $('.step-prev').click(function() {
    var target=parseInt($('.step-prev').attr('link-step'), 10),
        stepTitle = $('.step[data-step='+(target)+']').attr('data-title');
    
    $('.step-indicator .active').html(target);
    $('.step-title').html("<b>"+stepTitle+"</b>");
    
    if (target - 1 <= 0) {
      $('.step-prev').hide();
    } else {
      $('.step-prev').attr('link-step', target-1);
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
   
  $("input[name=itinerant]").change(function() {
      $(this).parents('.adress-container').find('#adress-map').fadeToggle();
      
      //Toggle Required field (input adress search)
      $( "input[title='search-map']" ).prop( "required", function( i, val ) {
        return !val;
      });
  });
   
   /*
   * INIT PICKDATE
   *
   */
    $('.timepicker.am').pickatime({
      format: 'H!hi',
      min: [6,0],
      max: [15,0]
    })
    $('.timepicker.pm').pickatime({
      format: 'H!hi',
      min: [11,0],
      max: [20,0]
    })
    $('.timepicker.full').pickatime({
      format: 'H!hi',
      min: [6,0],
      max: [20,0]
    })
   
    /*
    * MODALS ADDING DYNAMIC INFOS
    *
    */
    $('.alert').click(function() {
      var  idModal = $(this).attr("href"),
          hrefModal = $(this).attr("alert-href"),
          titleModal = $(this).attr("alert-title"),
          title = "Supprimer " + titleModal;
      console.log($(this));
      $(idModal).find("h4").text(title);
      $(idModal).find(".modal-confirm").attr("href", hrefModal);
    });
   
   
   /*
    * CUSTOM FUNCTION 
    *
    */
   
    function validateStep(target) {
      var valide = false,
          pos_error = 0,
          margin_error = 50;
      
      $('.step[data-step='+(target)+'] :input').each(function(e) {
        if (!verifyInput($(this))) {
          valide = false;
          pos_error = $(this).offset().top;
          return false;
        } else {
          valide = true;
        }
      });
     
      if (!valide) {
       $('html, body').animate({scrollTop:pos_error - margin_error});
      }
     
      return valide;
    }
    
    
    
    function verifyInput(obj)
    {
      var nSearchMap = "search-map";
      
      if (obj.prop('required')) {
        if (obj.val()) {
          if (obj.attr('name') == 'siret') {
            if (EstSiretValide(obj.val())) {
              return true;
            } else {
              msg_input(obj, "Le SIRET n'est pas correct, veuillez le vérifier.", "error");
              return false;
            }
            
          } else {
            
            obj.removeClass('invalid');
            obj.addClass('valid');
            
            return true;
            
          }
        } else if (obj.attr('title') == nSearchMap) {
        
          if ($("input[name=itinerant]").prop("checked")) {
            return true;
          } else {
            msg_input(obj, "Veuillez renseigner ce champs.", "error");
            return false;
          }
        
        } else {
          msg_input(obj, "Veuillez renseigner ce champs.", "error");
          return false;
        }
      } else {
        return true;
      }
    }
    
    
    /*
    * msg_input: print a message for input (valid or error)
    *
    * @target: the input
    * @msg: message to print
    * @pos: class for position text ("left" / "right")
    */
    function msg_input(target, msg, type, pos) {
      removePreviousMsg(target);
      type = (type == 'error' ? 'invalid' : 'valid') || 'valid';
      pos = (pos == 'left' ? 'to-left' : 'to-right') || 'to-right';
      var color = (type == 'valid' ? ' green-text' : ' red-text');
      
      target.removeClass(reverseClass(type));
      target.addClass(type);
      
      target.after("<div class='input-msg " + pos + color + "'>" + msg  + "</div>");
      
      target.next('label').addClass('active');
    }
    
    function reverseClass(val) {
      return (val == 'valid' ? 'invalid' : 'valid')
    }
    
    function removePreviousMsg(target) {
      target.nextAll('.input-msg').remove();
    }
   
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
    console.log(e.feature);
    $('<a class="waves-effect waves-light btn submit-adress" id="submit-adress" coordinates="'+e.feature.geometry.coordinates+'" adress="'+e.feature.properties.label+'" zipcode="'+e.feature.properties.postalcode+'" city="'+e.feature.properties.locality+'">Sélectionner</a>').insertAfter('.leaflet-popup-content');
  }
  
  /**
   * @name EstSiretValide
   *
   * @param   Le code SIRET dont on veut vérifier la validité.
   *
   * @return   Un booléen qui vaut 'true' si le code SIRET passé en
   *                           paramètre est valide, false sinon.
   */
  function EstSiretValide(siret) {
    var estValide;
    if ( (siret.length != 14) || (isNaN(siret)) )
      estValide = false;
    else {
       // Donc le SIRET est un numérique à 14 chiffres
       // Les 9 premiers chiffres sont ceux du SIREN (ou RCS), les 4 suivants
       // correspondent au numéro d'établissement
       // et enfin le dernier chiffre est une clef de LUHN. 
      var somme = 0;
      var tmp;
      for (var cpt = 0; cpt<siret.length; cpt++) {
        if ((cpt % 2) == 0) { // Les positions impaires : 1er, 3è, 5è, etc... 
          tmp = siret.charAt(cpt) * 2; // On le multiplie par 2
          if (tmp > 9) 
            tmp -= 9;	// Si le résultat est supérieur à 9, on lui soustrait 9
        }
       else
         tmp = siret.charAt(cpt);
         somme += parseInt(tmp);
      }
      if ((somme % 10) == 0)
        estValide = true; // Si la somme est un multiple de 10 alors le SIRET est valide 
      else
        estValide = false;
    }
    return estValide;
  }
});