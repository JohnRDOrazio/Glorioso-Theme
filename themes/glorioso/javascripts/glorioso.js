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
jQuery(function(){$.extend($.fn.disableTextSelect=function(){return this.each(function(){if($.browser.mozilla){$(this).css("MozUserSelect","none")}else{if($.browser.msie){$(this).bind("selectstart",function(){return false})}else{$(this).mousedown(function(){return false})}}})})});

/* create custom animation algorithm for jQuery called "bouncy" */
$.easing.bouncy=function(e,f,a,i,h){var g=1.70158;if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+a}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+a};

/* create custom tooltip effect for jQuery Tooltip */
$.tools.tooltip.addEffect("bouncy",function(a){this.getTip().animate({top:"+=15"},500,"bouncy",a).show()},function(a){this.getTip().animate({top:"-=15"},500,"bouncy",function(){$(this).hide();a.call()})});

/* Italian initialisation for the jQuery UI date picker plugin. */
/* Written by Antonello Pasella (antonello.pasella@gmail.com). */
jQuery(function(a){a.datepicker.regional.it={closeText:"Chiudi",prevText:"&#x3c;Prec",nextText:"Succ&#x3e;",currentText:"Oggi",monthNames:["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],monthNamesShort:["Gen","Feb","Mar","Apr","Mag","Giu","Lug","Ago","Set","Ott","Nov","Dic"],dayNames:["Domenica","Luned&#236","Marted&#236","Mercoled&#236","Gioved&#236","Venerd&#236","Sabato"],dayNamesShort:["Dom","Lun","Mar","Mer","Gio","Ven","Sab"],dayNamesMin:["Do","Lu","Ma","Me","Gi","Ve","Sa"],weekHeader:"Sm",firstDay:1,isRTL:false,showMonthAfterYear:false,yearSuffix:""};a.datepicker.setDefaults(a.datepicker.regional.it)});

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
function getArgs(){var b,f,e,c,g,a,d;b=new Object();f=location.search.substring(1);e=f.split("&");for(c=0;c<e.length;c++){g=e[c].indexOf("=");if(g==-1){continue}a=e[c].substring(0,g);d=e[c].substring(g+1);b[a]=unescape(d)}return b};

/* JQCLOCK PLUGIN */
(function($){$.clock={version:"2.0.1",locale:{}};t=[];$.fn.clock=function(d){var c={it:{weekdays:["Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato"],months:["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"]},en:{weekdays:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],months:["January","February","March","April","May","June","July","August","September","October","November","December"]},es:{weekdays:["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"],months:["Enero","Febrero","Marzo","Abril","May","junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]},de:{weekdays:["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag"],months:["Januar","Februar","März","April","könnte","Juni","Juli","August","September","Oktober","November","Dezember"]},fr:{weekdays:["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"],months:["Janvier","Février","Mars","Avril","May","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"]},ru:{weekdays:["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],months:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"]}};return this.each(function(){$.extend(c,$.clock.locale);d=d||{};d.timestamp=d.timestamp||"z";y=new Date().getTime();d.sysdiff=0;if(d.timestamp!="z"){d.sysdiff=d.timestamp-y}d.langSet=d.langSet||"en";d.format=d.format||((d.langSet!="en")?"24":"12");d.calendar=d.calendar||"true";if(!$(this).hasClass("jqclock")){$(this).addClass("jqclock")}var e=function(g){if(g<10){g="0"+g}return g},f=function(j,n){var r=$(j).attr("id");if(n=="destroy"){clearTimeout(t[r])}else{m=new Date(new Date().getTime()+n.sysdiff);var p=m.getHours(),l=m.getMinutes(),v=m.getSeconds(),u=m.getDay(),i=m.getDate(),k=m.getMonth(),q=m.getFullYear(),o="",z="",w=n.langSet;if(n.format=="12"){o=" AM";if(p>11){o=" PM"}if(p>12){p=p-12}if(p==0){p=12}}p=e(p);l=e(l);v=e(v);if(n.calendar!="false"){z=((w=="en")?"<span class='clockdate'>"+c[w].weekdays[u]+", "+c[w].months[k]+" "+i+", "+q+"</span>":"<span class='clockdate'>"+c[w].weekdays[u]+", "+i+" "+c[w].months[k]+" "+q+"</span>")}$(j).html(z+"<span class='clocktime'>"+p+":"+l+":"+v+o+"</span>");t[r]=setTimeout(function(){f($(j),n)},1000)}};f($(this),d)})};return this})(jQuery);


/* Initialize 1pixeloutAudioPlayer */
AudioPlayer.setup("themes/glorioso/javascripts/1pixeloutplayer/player.swf", {  
	transparentpagebg: "yes",
	width: 200
    });  

/* OPEN CONFIGURATION FILES IN DIALOG */
function opencfg(e,b){if($.jPicker===undefined){var a=document.createElement("link"),d=document.createElement("script"),c=document.getElementsByTagName("head")[0];a.rel="stylesheet";a.type="text/css";a.href="themes/glorioso/css/jPicker.css";c.appendChild(a);a.href="themes/glorioso/css/jPicker.min.css";c.appendChild(a);d.type="text/javascript";d.src="themes/glorioso/javascripts/jpicker.min.js";c.appendChild(d)}$.get("themes/glorioso/ajax/flopt.php",{opindex:"true",file:e},function(f){$("div#theme_edit_dialog").html(f).dialog({modal:true,autoOpen:true,show:{effect:"explode",speed:1000},hide:{effect:"explode",speed:1000},title:"Configurazione "+b,position:[5,5]});$("input.cfg_colorpicker").jPicker({images:{clientPath:"themes/glorioso/images/jPicker/"},color:{alphaSupport:true}}).attr("size","8")})};

/* DECLARE GLOBAL VARIABLES */
var args = getArgs();

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
	$(".flatnux-block-header .ui-icon-minusthick,.ui-icon-plusthick").click(function() {
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
cfgfile = "themes/glorioso/config.php";
cfgtitle = "Tema Glorioso";
$("#THEME_CFG").click(function(){
  opencfg(cfgfile,cfgtitle);
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

/* Initialize clock */
currenttimestamp = parseFloat($("input#current_timestamp").val() );
currentlangset =($("input#current_langset").val() );
currenttimestamp=currenttimestamp*1000;
$("#clock").clock({"timestamp":currenttimestamp, "langSet":currentlangset});

// CALENDARIO
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

// CALENDAR EVENT CREATION
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

//$(".fc-sun .fc-content").addClass("ui-highlight");
//I can't quite seem to figure out how to change the text color on sundays

});
/* There seem to be lots of cache errors in github lately, this should take care of it */