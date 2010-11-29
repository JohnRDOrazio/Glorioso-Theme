/* function useful for social sessions verification */
function opensocialregistration(params){
  $.get("themes/glorioso/ajax/social_registration_form.php",params,function(htmlcontent){
    if( $("div#socialregistration").length==0){
      $("body").prepend("<div id='socialregistration'></div>");
      $("div#socialregistration").dialog({
					width: 600,
          modal: true,
					autoOpen: false,
					show: {effect:'easeInQuad',speed:1000},
					hide: {effect:'easeOutQuad',speed:1000}      
      });
    }
    $("div#socialregistration").html(htmlcontent);
    $("div#socialregistration").dialog("open");  
  });
}

/* Function for disabling text selection on given elements (useful when using the sortable plugin) */
jQuery(function(){
	$.extend($.fn.disableTextSelect = function() {
		return this.each(function(){
			if($.browser.mozilla){//Firefox
				$(this).css('MozUserSelect','none');
			}else if($.browser.msie){//IE
				$(this).bind('selectstart',function(){return false;});
			}else{//Opera, etc.
				$(this).mousedown(function(){return false;});
			}
		});
	});
});

/* create custom animation algorithm for jQuery called "bouncy" */
$.easing.bouncy = function (x, t, b, c, d) {
    var s = 1.70158;
    if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
    return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
}

/* create custom tooltip effect for jQuery Tooltip */
$.tools.tooltip.addEffect("bouncy",
	// opening animation
	function(done) {
		this.getTip().animate({top: '+=15'}, 500, 'bouncy', done).show();
	},
	// closing animation
	function(done) {
		this.getTip().animate({top: '-=15'}, 500, 'bouncy', function()  {
			$(this).hide();
			done.call();
		});
	}
);

/* Italian initialisation for the jQuery UI date picker plugin. */
/* Written by Antonello Pasella (antonello.pasella@gmail.com). */
jQuery(function($){
	$.datepicker.regional['it'] = {
		closeText: 'Chiudi',
		prevText: '&#x3c;Prec',
		nextText: 'Succ&#x3e;',
		currentText: 'Oggi',
		monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno',
			'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
		monthNamesShort: ['Gen','Feb','Mar','Apr','Mag','Giu',
			'Lug','Ago','Set','Ott','Nov','Dic'],
		dayNames: ['Domenica','Luned&#236','Marted&#236','Mercoled&#236','Gioved&#236','Venerd&#236','Sabato'],
		dayNamesShort: ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'],
		dayNamesMin: ['Do','Lu','Ma','Me','Gi','Ve','Sa'],
		weekHeader: 'Sm',
		//dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['it']);
});

/*	ATTENTION! MAKE SURE YOU DO ALL AJAX CALLS ON DOCUMENT READY 
	OTHERWISE AJAXSTART WON'T BE ABLE TO FIND THE DIV TO SHOW
	AND WILL RETURN AN ERROR! */
  $(document).ajaxStop(function(event, request, settings) {
    $("#debuglog").append("<li style='font-weight:bold;'>Ajax requests have all finished.</li>");
    $("div#loading").hide();
	  if($("div#adminonoff").length!=0){
		  $("div#adminonoff").hide();
	  }
	  if(typeof(FB)!="undefined"){ FB.XFBML.parse(); }
	});
  $(document).ajaxStart(function(event, request, settings) {
    $("#debuglog").append("<li style='font-weight:bold;'>Ajax requests queuing...</li>");
  	$("div#loading").show();
	});

/* the following is simply for debugging ajax requests, to see if al requests go through successfully... */  
/*
$(document).ajaxError(function(event, request, settings){
     $("#debuglog").append("<li style='color:Red;>Error requesting page " + settings.url + "</li>");
  });
  $(document).ajaxComplete(function(event, request, settings){
     settings = (settings===undefined) ? {url:""} : settings;
     settings.url = (settings.url===undefined) ? "" : settings.url;
     $("#debuglog").append("<li style='color:Orange;';>Request Complete. "+settings.url+"</li><hr />");
  });
  $(document).ajaxSend(function(event, request, settings){
    $("#debuglog").append("<li style='color:Blue;'>Starting request at " + settings.url + "</li><hr />");
  });
  $(document).ajaxSuccess(function(event, request, settings){
     $("#debuglog").append("<li style='color:Green;'>Successful Request! "+ settings.url +"</li>");
  });
*/
/*
$.ajaxSetup({
    'beforeSend' : function(xhr) {
      if(xhr.overrideMimeType){
        xhr.overrideMimeType('text/html; charset=ISO-8859-1');
    }}
});
*/

/* FUNCTION THAT PARSES THE URL QUERY STRING */
function getArgs() {
  var argsobj,query,pairs,i,pos,argname,value; 
  argsobj = new Object();
  query = location.search.substring(1); 
  pairs = query.split("&"); 
  for(i = 0; i < pairs.length; i++) {
    pos = pairs[i].indexOf('='); 
    if (pos == -1) continue; 
    argname = pairs[i].substring(0,pos); 
    value = pairs[i].substring(pos+1);
    argsobj[argname] = unescape(value); 
  }
  return argsobj; 
}

/* CLOCK FUNCTIONALITY */

/* Add a "0" in front of numbers 0-9 */
function checkTime(i) {
	if (i<10){i="0" + i;}
	return i;
}

function startTime(withthistimestamp, withlangset){
  var mynewtimestamp=null,mylangset=null,mynewtimestamp=withthistimestamp,mylangset=withlangset,today=new Date(mynewtimestamp),h=today.getHours(),m=today.getMinutes(),s=today.getSeconds(),dy=today.getDay(),dt=today.getDate(),mo=today.getMonth(),y=today.getFullYear(),ap="";

  if(mylangset=="en"){
  	ap = " AM";
  	if (h > 11) { ap = " PM"; }
  	if (h > 12) { h = h - 12; }
  	if (h == 0) { h = 12; }
  	if(s==0&&m==0&&h==12){ $("div#currentdate").html(weekday.en[dy]+', '+month.en[mo]+' '+dt+', '+y); }
  }
  else if(mylangset=="it"){ 
    if(s==0&&m==0&&h==0){ $("div#currentdate").html(weekday.it[dy]+', '+dt+' '+month.it[mo]+' '+y); }
  }

  // add a zero in front of numbers<10
  h=checkTime(h);
  m=checkTime(m);
  s=checkTime(s);

  $("div#clock").html(h+":"+m+":"+s+ap);
  mynewtimestamp += 1000;
  t = setTimeout(function(){startTime(mynewtimestamp, mylangset);},1000);
}

/* Initialize 1pixeloutAudioPlayer */
AudioPlayer.setup("themes/glorioso/javascripts/1pixeloutplayer/player.swf", {  
	transparentpagebg: "yes",
	width: 200
    });  

/* DECLARE GLOBAL VARIABLES */

var weekday={
  "it":["Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato"],
  "en":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
  "es":["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
  "de":["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
  "fr":["Dimanche", "Lundi", "mardi", "mercredi", "Jeudi", "Vendredi", "Saturday"],
  "ru":["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]
},month={
  "it":["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],
  "en":["January","February","March","April","May","June","July","August","September","October","November","December"],
  "es":["Enero", "Febrero", "Marzo", "Abril", "May", "junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
  "de":["Januar", "Februar", "März", "April", "könnte", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
  "fr":["Janvier", "Février", "Mars", "Avril", "May", "Juin", "Juillet", "août", "Septembre", "Octobre", "Novembre", "Décembre"],
  "ru":["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"]
},args = getArgs(),t=null;

/********************
 ** DOCUMENT READY **
 ********************/
$(document).ready(function(){
/* MAKE THE SIDE COLUMNS SORTABLE ! */
	$(".side-column").sortable({
							containment:'body',
							connectWith: '.side-column',
							helper: 'clone',
							forceHelperSize: true,
							handle: '.ui-widget-header',
							start: function(event, ui) { $("body,body *").disableSelection(); },
							stop: function(event, ui) { $("body,body *").enableSelection(); }
							});
/* MAKE THE SIDE BLOCKS COLLAPSABLE */	
	$(".flatnux-block-header .ui-icon").click(function() {
		$(this).toggleClass("ui-icon-minusthick").toggleClass("ui-icon-plusthick");
		$(this).parents(".flatnux-block:first").find(".flatnux-block-content").slideToggle(500,"easeOutElastic");
		});
/****************************************************************
 *          TOP USERPANEL CONFIGURATION                         *
 ***************************************************************/
/*
$(".jqtooltip").tooltip({
    effect: 'bouncy',
    offset: [10, 2],
    tipClass: 'tooltip',
    position: 'top center'
    }).dynamic({ bottom: { direction: 'down', bounce: true } });
*/
$(".jqtooltip-dx").tooltip({
    effect: 'fade',
    offset: [-2, 10],
    tipClass: 'tooltip-dx',
    position: 'center right',
    opacity: 0.7
}).dynamic();
/* HIDE THE "ADMINONOFF" BUTTON BECAUSE WE ALREADY HAVE IT ON THE TOOLBAR	*/
	if($("div#adminonoff").length!=0){
		$("div#adminonoff").hide();
	}
/* ACTIVATE TOOLBAR HIDE - SHOW BUTTON */
	$("div#toolbar-hide").click(function(){
    $("div#toolbar-wrapper").slideUp();
		$("div#toolbar-show").show();
	});
	$("div#toolbar-show").click(function(){
    $("div#toolbar-show").hide();
		$("div#toolbar-wrapper").slideDown();
	});
/* MAKE PANEL BUTTONS */
$("button#CTRLPAN_SEARCH").button({
      icons: {
				primary: "ui-icon-search"
			},
			label: false
});
$("#userbuttonset").buttonset();
$("#CTRLPAN_ADMIN").button('option',{icons:{primary: "ui-icon-wrench"},label:false});
$("#THEME_CFG").button('option',{icons:{primary: "ui-icon-gear"},label:false});
$("#CTRLPAN_FILEMNGR").button('option',{icons:{primary: "ui-icon-folder-open"},label:false});
$("#glorioso_adminonoff").button('option',{icons:{primary: "ui-icon-pencil"},label:false});
$("input#CTRLPAN_ADMIN").click(function(){
  location.href="controlcenter.php?mod=Control_Center";
});
$("input#CTRLPAN_FILEMNGR").click(function(){
  window.open('filemanager.php?dir=sections/'+args.mod+'/','filemanager','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=640,height=480');
});
$("input#glorioso_adminonoff").click(function(){
  query = location.search;
  query = (args.fneditmode===undefined) ? query : query.replace(/.fneditmode../g,"");
  query = (query!="") ? query+="&" : "?";
  ($(this).attr("rel")=='glorioso_adminon') ? location.href="index.php"+query+"fneditmode=0" : location.href="index.php"+query+"fneditmode=1";
});
/* ACTIVATE THEME CONFIGURATION BUTTON ON TOOLBAR */
  $("#THEME_CFG").click(function(){
    if($.jPicker===undefined){
 var jpck_css,jpck;     
 jpck_css = document.createElement('link');
      jpck_css.rel = 'stylesheet';
      jpck_css.type = 'text/css';
      jpck_css.href = 'themes/glorioso/css/jPicker.css';
      document.getElementsByTagName('head')[0].appendChild(jpck_css);
      jpck_css.href = 'themes/glorioso/css/jPicker-1.1.5.min.css';
      document.getElementsByTagName('head')[0].appendChild(jpck_css);
      jpck = document.createElement('script');
      jpck.type = 'text/javascript';
      jpck.async = true;
      jpck.src = 'themes/glorioso/javascripts/jpicker-1.1.5.min.js';
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(jpck);
    }
    $.get("themes/glorioso/ajax/flopt.php",{opindex:"true",file:"themes/glorioso/config.php"},function(data){
       $("div#theme_edit_dialog").html(data).dialog({
				modal: true,
				autoOpen: true,
				show: {effect:'explode',speed:1000},
				hide: {effect:'explode',speed:1000},
        width:'98%',
        title:'Configurazione Tema Glorioso',
        position:[5,5]
        });
       $("input.cfg_colorpicker").jPicker({images:{clientPath:'themes/glorioso/images/jPicker/'},color:{alphaSupport:true}}).attr("size","8"); 
    });
  });
/* LOGIN / LOGOUT FUNCTIONALITY */
$("div#flatnuxlogin").click(function(){
   location.href = $(this).find("a").attr("href");
});
if ($("div#facebooklogin").length!=0){
  $("div#facebooklogin").click(function(){
    FB.login(function(response) {
      if (response.session) {
        if (response.perms) {
          // user is logged in and granted some permissions.
          // perms is a comma separated list of granted permissions
        } else {
          // user is logged in, but did not grant any permissions
        }
        ( args['opmod']=='profile' ) ? location.reload() : location.href="index.php?mod=login&opmod=profile";

      } else {
        // user is not logged in
      }
    }, {perms:'email,user_birthday,status_update,read_stream,publish_stream,create_event,rsvp_event,sms'});  
  });
}
if ($("span#fb_logout").length!=0){
  $('span#fb_logout').click(function(){
    if($("#logoutmsg").length==0){
      $("body").append("<div id='logoutmsg'></div>");
      $("div#logoutmsg").dialog({
  					modal: true,
  					autoOpen: false,
  					show: {effect:'fadeIn',speed:1000},
  					hide: {effect:'fadeOut',speed:1000}
      });
    }
    $("div#logoutmsg").html("Stai uscendo sia da facebook che da questo sito...").dialog("open");
    FB.logout(function(response) { location.href='index.php?mod=login&op=logout'; });
  });
}
if ($("div#gfc-button").length!=0){
  $("div#gfc-button").click(function(){
    google.friendconnect.requestSignIn();
  });
}
if ($("span#gfc_logout").length!=0){
  $("span#gfc_logout").click(function(){
    if($("div#logoutmsg").length==0){
      $("body").append("<div id='logoutmsg'></div>");
      $("div#logoutmsg").dialog({
  					modal: true,
  					autoOpen: false,
  					show: {effect:'fadeIn',speed:1000},
  					hide: {effect:'fadeOut',speed:1000}
      });
    }
    $("div#logoutmsg").html("Stai uscendo sia da google friend connect che da questo sito...").dialog("open");
    google.friendconnect.requestSignOut();
  });
}
$("div#userlogin").hover(function(){
  $(this).toggleClass("ui-state-hover");
});
$("div#userlogin-dropdown div").hover(function(){
  $(this).toggleClass("ui-state-hover");
});
$("div#userlogin").click(function(){
  $("div#userlogin-dropdown").slideToggle();
  $("div#login-span-wrapper").toggleClass("userloginspan");
});
$("div#userlogin").toggle(
  function(){
    $(this).animate({"margin-top":"-20px"})
  },
  function(){
    $(this).animate({"margin-top":"-5px"})
  }
);
/* TURN THE LANGUAGE SELECT INTO A JQUERY-UI STYLE DROPDOWN USING THE SELECTMENU PLUGIN*/
	$('select#select_langs').selectmenu({
				style:'dropdown',
				icons: [
					{find: '.it'},
					{find: '.en'},
					{find: '.es'},
					{find: '.fr'},
					{find: '.de'},
					{find: '.ru'}
				]
			});
/* TURN THEMESWITCHER DIV INTO THEMESWITCHER */
	$('#gloriosothemeswitcher').themeswitcher();
/****************************************************************
* 					MENU NAVIGATIONAL / SECTION AJAX LOAD SCRIPTS  			*
****************************************************************/
	$("div#userprofile").click(function(){
		$("div#floptdiv").load("/themes/glorioso/ajax/flopt.php",{vmod:"none_Login"});
		return false;
	});
	// HIJACK THE HORIZONTAL MENUS LINKS TO AJAX MODE
	$(".fn-menu div").click(function(){
		myhref = $(this).find("a").attr("title");
    //ajax load the section corresponding to the the anchor's title
		$("div#floptdiv").load("/themes/glorioso/ajax/flopt.php",{ vmod: myhref } );
		// active and disabled classes are first removed from all menu items
		$(".fn-menu div").removeClass("ui-state-disabled ui-state-active");
		//the menu item who's anchor's title corresponds to the href clicked
		//will receive active and disabled classes
		$(".fn-menu a[title="+myhref+"]").parent("div").addClass("ui-state-disabled ui-state-active");
		//if I click on a main section button, then any subsection other than its own will be closed;
		if($(this).parent('div').hasClass('subsection')!=true) {
			//If the main div has its own subsection, then all subsections but its own will be closed
			if( $(this).next('div').hasClass('subsection') ) { 
				mysubsection = $(this).next('div');
				$(".subsection").not(mysubsection).slideUp(1000,"easeInQuint");
				}
			//Else all subsections will be closed
			else { $(".subsection").slideUp(1000,"easeInQuint"); }
			}
		//else if I click on a subsection button, then all other subsections but its own will be closed;
		if($(this).parent('div').hasClass('subsection')==true){
			if( $(this).next('div').hasClass('subsection') ) { 
				mysubsection = $(this).next('div');
				$(this).siblings('.subsection').not(mysubsection).slideUp(1000,"easeInQuint");
				}
			else {
				$(this).siblings('.subsection').slideUp(1000,"easeInQuint");
			}
			}
		//any subsection of the section / subsection will be toggled (open or close)
		if( $(this).next('div').hasClass('subsection') && $(this).next('div').html()!="" ) {
			$(this).next('div').slideToggle(1000,"easeOutBack");
			}
		//do not follow any anchors hrefs
		return false;
		});
////////////////////////////////////////////////////////////////////
//****************************************************************//
// Begin updating clock div according to server time              //
////////////////////////////////////////////////////////////////////
currenttimestamp = parseFloat($("input#current_timestamp").val() );
currentlangset =($("input#current_langset").val() );
currenttimestamp=currenttimestamp*1000;
startTime(currenttimestamp, currentlangset);
////////////////////////////////////////////////////////////////////
// END OF BEGIN UPDATING CLOCK ACCORDING TO SERVER TIME           //
//****************************************************************//
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// CALENDARIO                                                     //
////////////////////////////////////////////////////////////////////
$('#calendarviewer').fullCalendar({
    header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
            },
    monthNames: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio',
                'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
    monthNamesShort: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu',
                     'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
    dayNames: ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì',
              'Giovedì', 'Venerdì', 'Sabato'],
    dayNamesShort: ['Dom', 'Lun', 'Mart', 'Merc', 'Giov', 'Ven', 'Sab'],
    allDayText: 'tutto il giorno',
   	axisFormat: 'H:mm',
    titleFormat: {
                 month: "MMM '&#039;'yy",                             // September 2009
                 week: "d [MMM] ['&#039;'yy]{ '&#8211;' d MMM '&#039;'yy}", // Sep 7 - 13 2009
                 day: "ddd d MMM '&#039;'yy"                  // Tuesday, Sep 8, 2009
                 },
    buttonText: {
                today:    'oggi',
                month:    'mese',
                week:     'sett.',
                day:      'giorno'
                },
    timeFormat: {
                // for agendaWeek and agendaDay
                agenda: 'H:mm{ - H:mm}', // 5:00 - 6:30
                // for all other views
                '': 'H(:mm)'            // 7p
                },
    columnFormat: {
                  month: 'ddd',    // Mon
                  week: 'ddd d/M', // Mon 9/7
                  day: 'dddd d/M'  // Monday 9/7
                  },
    theme:           true,
    eventClick: function(event) {
            // opens events in a popup window
            window.open(event.url, 'gcalevent', 'width=700,height=600');
            return false;
    },  
    loading: function(bool) {
            if (bool) {
                    $('#loading').show();
            }else{
                    $('#loading').hide();
            }
    },
		aspectRatio: 2.5
}).dialog({
  	width: 500,
  	modal: true,
  	autoOpen: false,
  	show: {effect:'explode',speed:1000},
  	hide: {effect:'explode',speed:1000}
});
/* SE E' IMPOSTATO UN FEED DI GOOGLE CALENDAR */
gcalfeedurl = $("input#gcal-feed").val();
if(gcalfeedurl!=""){
  $("div#calendarviewer").fullCalendar( 'addEventSource', $.fullCalendar.gcalFeed(gcalfeedurl,
          {
            className:       'gcal-event',
            editable:        true,
            currentTimezone: 'Europe/Rome'
          }
    ));
}
/* SE L'UTENTE E' AMMINISTRATORE DELLE NEWS, ALLORA PUO' INSERIRE EVENTI */
$.get("themes/glorioso/ajax/ajax_fc.php",function(data){
  if(MD5(data)=="cf4b1a648e5405fba687ee67934725e2"){ 
    $('#calendarviewer').dialog("option","buttons",{
		"Aggiorna": function() {
			$('#calendarviewer').fullCalendar('refetchEvents');
			$('#calendarviewer').fullCalendar('rerenderEvents');
			},
		"Aggiungi evento": function() {
			$("div#create_cal_event_wrapper").slideDown("slow");
			}
		});
	}
});
$("img#gloriosocal").click(function(){
  $('#calendarviewer').dialog('open');
  $('#calendarviewer').fullCalendar('render');
  return false;
  });
$("#create_cal_event_wrapper").draggable({ handle: '#create_cal_event_handle', containment: 'document' });
$("button#btn_cancel_create_event").click(function(){
	$("div#create_cal_event_wrapper").slideUp("slow");
});
$("img#gloriosocal").hover(function(){
	thisimg = this;
	$(thisimg).animate({
		left: "+=5px"
		}, 20,function(){
			$(thisimg).animate({
				left: "-=5px"
				}, 20,function(){
					$(thisimg).animate({
						left: "+=5px"
						}, 20,function(){
							$(thisimg).animate({
								left: "-=5px"
								}, 20)
						});
				});
		}); },
	function(){
	thisimg = this;
	$(thisimg).animate({
		left: "+=5px"
		}, 20,function(){
			$(thisimg).animate({
				left: "-=5px"
				}, 20,function(){
					$(thisimg).animate({
						left: "+=5px"
						}, 20,function(){
							$(thisimg).animate({
								left: "-=5px"
								}, 20)
						});
				});
		});
	});
////////////////////////////////////////////////////////////////////
// CALENDAR EVENT CREATION                                        //
////////////////////////////////////////////////////////////////////
$("button#btn_cal_create_event").click(function(){
  $("div#create_cal_event_wrapper").slideUp("slow");
  formdata = $("form#create_cal_event").serialize();
  $.ajax({
    type: "POST",
    url: "/themes/glorioso/ajax/createEvent.php",
    data: formdata,
    success: function(data) {
	  $("div#TIP").html("<span>Evento creato con successo</span>").fadeIn("fast").fadeTo(5000, 1).fadeOut("slow");
	  $('#calendarviewer').fullCalendar('refetchEvents');
	  $('#calendarviewer').fullCalendar('rerenderEvents');
    }
  });
});
$("input#startDate,input#endDate").datepicker({changeYear: true,changeMonth: true,dateFormat: 'yy-mm-dd',yearRange: '-10:+3'});
$.datepicker.setDefaults($.datepicker.regional['']);
$("input#startDate,input#endDate").datepicker('option', $.extend($.datepicker.regional['it']));
////////////////////////////////////////////////////////////////////
// END OF CALENDAR EVENT CREATION                                 //
//****************************************************************//
////////////////////////////////////////////////////////////////////
//$(".fc-sun .fc-content").addClass("ui-highlight");
//I can't quite seem to figure out how to change the text color on sundays
});