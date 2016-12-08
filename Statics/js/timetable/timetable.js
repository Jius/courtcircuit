(function($) {
  $.fn.timetable = function(paramètres)
  {
  	this.html(htmlConstruct());
  	initialize();
  };
  
  function htmlConstruct(week)
  {
  	var html = '',
  			days = '',
  			week = (typeof week !== 'undefined') ?  week : ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
  			
  			titleDay = '',
  			fullView = '',
  			checkSplit = '',
  			splitView = '';
  	
  	$.each(week, function( index, day ) {
  		titleDay = day;
  		day = day.toLowerCase();
			fullView = '<div class="all"><div class="row"><div class="col s6"><input placeholder="De" id="hour-start-' + day + '" type="text" class="validate hour" name="hour-start-' + day + '"></div><div class="col s6"><input placeholder="À" id="hour-end-' + day + '" type="text" class="validate hour" name="hour-end-' + day + '"></div></div></div>';
			checkSplit = '<p><input type="checkbox" class="filled-in check-split" id="split-' + day + '" name="split-' + day + '"/><label for="split-' + day + '">Interruption</label></p>';
			splitView = '<div class="split">Matin:<div class="row"><div class="col s6"><input placeholder="De" id="hour-start-am-' + day + '" type="text" class="validate hour" name="hour-start-am-' + day + '"></div><div class="col s6"><input placeholder="À " id="hour-end-am-' + day + '" type="text" class="validate hour" name="hour-end-am-' + day + '"></div></div>Après-midi:<div class="row"><div class="col s6"><input placeholder="De " id="hour-start-pm-' + day + '" type="text" class="validate hour" name="hour-start-pm-' + day + '"></div><div class="col s6"><input placeholder="À " id="hour-end-pm-' + day + '" type="text" class="validate hour" name="hour-end-pm-' + day + '"></div></div></div>';
					
  		days = days + '<div class="col s2 day"><p class="label center-align">' + titleDay + '</p><div class="opening"><p class="caption">Horaires</p>' + fullView + checkSplit + splitView + '</div></div>';
		});
		
		html = '<div class="row"><div class="col s12"><p class="caption medium">Horaires et jours d"ouvertures</p><div class="row daytable">' + days + '</div></div><input type="hidden" name="daytable"></div>';
		
		return html;
  }
  
  function initialize()
  {
  	var   memoryInput = $('input[name="daytable"]').val(), //If user reload navigator
					allDay = $('input[name="all-day"]').prop('checked');
    
  /*
  * DAYTABLE
  */
    $('.daytable .day').each(function() {
      var day = $(this).find('p.label').text().toLowerCase();
      
      $(this).find('.opening').hide();
      if ($(this).find('.opening .check-split').prop('checked')) {
        $(this).find('.opening .all').hide();
        $(this).find('.opening .split').show();
      } else {
        $(this).find('.opening .all').show();
        $(this).find('.opening .split').hide();
      }
      
      if (memoryInput.includes(day)) {
        $(this).toggleClass('selected');
      }
      
    });
    
		$('.daytable .day p.label').click(function() {
			var day = $(this).text().toLowerCase();
			
			$(this).next('.opening').slideToggle( "slow" );
			          
			addOrDeleteDay(day);
			
			$(this).parent('.day').toggleClass('selected');
		
		});
    
	/*
	* OPENNING HOURS
	*/
		//CHECKBOX LISTENNER (FULL DAY OR SPLIT)
    $('input.check-split').change(function() {
        $(this).parents('.opening').find('.all').slideToggle();
        $(this).parents('.opening').find('.split').slideToggle();
    });
   
  }
  
  function addOrDeleteDay(day, nameInput)
	{
		var nameInput = nameInput || "daytable";
		
		$('input[name=' + nameInput + ']').val(function(i,val) { 
		  if (!val.includes(day)) {
		    val = (val.length == 0 ? day : val + ',' + day);
		  } else {
		    if (val.includes(',')) {
		      val = (val.indexOf(day) == 0 ? val.replace(day + ',' , '') : val.replace(',' + day , ''));
		    } else {
		      val = val.replace(day , '');
		    }
		    
		  }
		  
	  	return val;
		});
	}
	
})(jQuery);