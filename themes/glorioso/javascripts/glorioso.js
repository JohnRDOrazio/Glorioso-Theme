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
    if($("#debuglog").length!=0){
      $("#debuglog").append("<li style='font-weight:bold;'>Ajax requests have all finished.</li>");
    }
    $("#loading").hide();
	  if($("#adminonoff").length!=0){
		  $("#adminonoff").hide();
	  }
	  if(typeof(FB)!="undefined"){ FB.XFBML.parse(); }
	});
  $(document).ajaxStart(function(event, request, settings) {
    if($("#debuglog").length!=0){
      $("#debuglog").append("<li style='font-weight:bold;'>Ajax requests queuing...</li>");
    }
  	$("#loading").show();
	});

/* the following is simply for debugging ajax requests, to see if all requests go through successfully... */  
/*
$(document).ajaxError(function(event, request, settings){
    if($("#debuglog").length!=0){
      $("#debuglog").append("<li style='color:Red;>Error requesting page " + settings.url + "</li>");
    }
  });
  $(document).ajaxComplete(function(event, request, settings){
    settings = (settings===undefined) ? {url:""} : settings;
    settings.url = (settings.url===undefined) ? "" : settings.url;
    if($("#debuglog").length!=0){
      $("#debuglog").append("<li style='color:Orange;';>Request Complete. "+settings.url+"</li><hr />");
    }
  });
  $(document).ajaxSend(function(event, request, settings){
    if($("#debuglog").length!=0){
      $("#debuglog").append("<li style='color:Blue;'>Starting request at " + settings.url + "</li><hr />");
    }
  });
  $(document).ajaxSuccess(function(event, request, settings){
    if($("#debuglog").length!=0){
      $("#debuglog").append("<li style='color:Green;'>Successful Request! "+ settings.url +"</li>");
    }
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
function opencfg(e,b){if($.jPicker===undefined){var a=document.createElement("link"),g=document.createElement("link"),d=document.createElement("script"),c=document.getElementsByTagName("head")[0];a.rel="stylesheet";g.rel="stylesheet";a.type="text/css";g.type="text/css";a.href="themes/glorioso/css/jPicker.css";g.href="themes/glorioso/css/jPicker.min.css";c.appendChild(a);c.appendChild(g);d.type="text/javascript";d.src="themes/glorioso/javascripts/jpicker.min.js";c.appendChild(d);}$.get("themes/glorioso/ajax/flopt.php",{opindex:"true",file:e},function(f){hgt=Math.floor($(window).height()*.80);$("#theme_edit_dialog").html(f).dialog({modal:true,autoOpen:false,show:{effect:"fade",speed:3000},hide:{effect:"explode",speed:1000},close:function(ev, ui) { $(this).dialog("destroy"); },title:"Configurazione "+b,width:$("#theme_edit_dialog").width(),height:hgt});$("input.cfg_colorpicker").jPicker({images:{clientPath:"themes/glorioso/images/jPicker/"},color:{alphaSupport:true}}).attr("size","8");$("#theme_edit_dialog").dialog('option','position',$("#theme_edit_dialog").dialog('option','position')).dialog("open");});}

/* LOAD THEMESWITCHER SCRIPT */
$.getScript("/themes/glorioso/javascripts/themeswitcher.js",{async:false});

/* LOAD COOKIE SCRIPT */
$.getScript("/themes/glorioso/javascripts/cookie.js",{async:false});

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
/*
if ($("div#gfc-button").length!=0){
  $("div#gfc-button").click(function(){
    google.friendconnect.requestSignIn();
  });
}
*/
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
usrlogheight = $("#userlogin").outerHeight()+3;
usrlogwidth = $("#userlogin").outerWidth()-2;
usrlogxy = $("#userlogin").offset();
usrlogdropheight = $("#userlogin-dropdown").outerHeight();
$("#userlogin-dropdown").css({top:usrlogheight,left:-1,width:usrlogwidth});
$("#dropdown-shadow").css({top:usrlogheight+10,left:-1,width:usrlogwidth,height:usrlogdropheight});

$("#userlogin").hover(function(elem){  
  el = this;
  $(el).removeClass("ui-corner-all").addClass("ui-corner-top").add("#userlogin-dropdown").toggleClass("ui-state-hover");  
  $(el).find(".ui-icon-carat-1-s").removeClass("ui-icon-carat-1-s").addClass("ui-icon-carat-1-n").css({cursor:"pointer"}).click(function(){ 
    $("#userlogin-dropdown").add("#dropdown-shadow").slideUp();
    $(el).removeClass("ui-corner-top").addClass("ui-corner-all");
    $(this).removeClass("ui-icon-carat-1-n").addClass("ui-icon-carat-1-s"); 
    });
  $("#userlogin-dropdown").add("#dropdown-shadow").slideDown();
  },
  function(elem){
    $(this).add("#userlogin-dropdown").toggleClass("ui-state-hover");
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
switch($("#current_langset").val()){
  case "en":
    swtheme = "Switch Theme";
    btnpretext = "Theme: ";
    msg = "Glorioso Theme Message";
    msgbdy = "A new theme has been applied.";
    break;
  case "it":
    swtheme = "Cambia Tema";
    btnpretext = "Tema: ";
    msg = "Messaggio Tema Glorioso";
    msgbdy = "E' stato applicato un nuovo Tema.";
    break;
  case "fr":
    swtheme = "Changer le Thème";
    btnpretext = "Thème: ";
    msg = "Message Theme Glorioso";
    msgbdy = "Un nouveau Thème a été appliqué.";
    break;
  case "de":
    swtheme = "Schalter Thema";
    btnpretext = "Thema: ";
    msg = "Nachricht Thema Glorioso";
    msgbdy = "Ein neues Thema wurde übernommen.";
    break;
  case "es":
    swtheme = "Cambiar el Tema";
    btnpretext = "Tema: ";
    msg = "Mensaje Tema Glorioso";
    msgbdy = "Un nuevo tema se ha aplicado.";
    break;
  case "ru":
    swtheme = "Переключатель тему";
    btnpretext = "тему: ";
    msg = "Сообщение тема Glorioso";
    msgbdy = "новая тема была применена.";
    break;
  default:
    swtheme = "Switch Theme";
    btnpretext = "Theme: ";
    msg = "Glorioso Theme Message";
    msgbdy = "A new theme has been applied.";
}
	$('#gloriosothemeswitcher').themeswitcher({initialText:swtheme,buttonPreText:btnpretext,onSelect: function(){$('<div id="effect" class="ui-widget-content ui-corner-all" style="display:none;position:absolute;height:100px;width:200px;top:50%;margin-top:-50px;left:50%;margin-left:-100px;text-align:center;"><h3 class="ui-widget-header ui-corner-all">'+msg+'</h3><p>'+msgbdy+'</p></div>').appendTo('body').fadeIn(1000).fadeTo(1000,1).fadeOut(1000,function(){ $(this).remove(); }); }});

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
hgt=Math.floor($(window).height()*.90);
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
                 month: "MMMM yyyy",                             // September 2009
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
        height: hgt,
  	modal: true,
  	autoOpen: false,
  	show: {effect:'fade',speed:3000},
  	hide: {effect:'explode',speed:1000},
        resize: function(event, ui) { $('#calendarviewer').fullCalendar('render'); }
});

/* SE E' IMPOSTATO UN FEED DI GOOGLE CALENDAR */
gcalfeedurl = $("#gcal-feed").val();
if(gcalfeedurl!=""){
  gcalfeedurl = gcalfeedurl.split(";");
  colorlist = ["#00CC66","#0000CC","#FF66FF","#6666FF","#99CCFF","#FFCCFF","#FFCC99"];
  for(var i in gcalfeedurl){
    $("#calendarviewer").fullCalendar( 'addEventSource', $.fullCalendar.gcalFeed(gcalfeedurl[i],
            {
              className:       'gcal-event'+i,
              editable:        true,
              currentTimezone: 'Europe/Rome',
              color: colorlist[i]
            }
      ));
  }
}


/* SE L'UTENTE E' AMMINISTRATORE DELLE NEWS, ALLORA PUO' INSERIRE EVENTI */
// if user is news administrator then create_cal_event_wrapper will exist;
// in such a case apply jquery-UI formatting and automation to it and its elements
if($("#create_cal_event_wrapper").length!=0){
    $("#create_cal_event_wrapper").dialog({
					width: 600,
          modal: true,
					autoOpen: false,
					show: {effect:'fade',speed:2000},
					hide: {effect:'drop',speed:1000},
          buttons: {
            "Crea evento":function(){
                    formdata = $("#create_cal_event").serialize();
                    $.ajax({
                      type: "POST",
                      url: "/themes/glorioso/ajax/createEvent.php",
                      data: formdata,
                      success: function(data) {
                    	  $("#create_cal_event_wrapper").dialog("close");
                        $("#TIP").html("<span>Evento creato con successo.</span><br /><br />ID evento: <span style='word-wrap: break-word;color:DarkGreen;font-weight:bold;'>"+data+"</span>").fadeIn("fast").fadeTo(5000, 1).fadeOut("slow");
                    	  $('#calendarviewer').fullCalendar('refetchEvents');
                    	  $('#calendarviewer').fullCalendar('rerenderEvents');
                      }
                    });            
            },
            "Annulla":function(){$(this).dialog("close");}
          }      
    });
    $("#fc_ev_startDate.datepicker","#create_cal_event").datepicker({
                                                  changeYear: true,
                                                  changeMonth: true,
                                                  dateFormat: 'yy-mm-dd',
                                                  yearRange: '-10:+3',
                                                  onSelect: function(dateText, inst){ $("#fc_ev_endDate").datepicker("option","minDate",dateText) }
                                              });
    $("#fc_ev_endDate.datepicker","#create_cal_event").datepicker({
                                                  changeYear: true,
                                                  changeMonth: true,
                                                  dateFormat: 'yy-mm-dd',
                                                  yearRange: '-10:+3',
                                                  onSelect: function(dateText, inst){ $("#fc_ev_startDate").datepicker("option","maxDate",dateText) }
                                              });
    $.datepicker.setDefaults($.datepicker.regional['']);
    $(".datepicker","#create_cal_event").datepicker('option', $.extend($.datepicker.regional['it']));    
    // if html5 is being used (determined by php), then we will have an {input type=time|date} element for time|date
    if($("input#fc_ev_startTime").length!=0){  

      $("#fc_ev_endDate").focus(function(){ 
        $(this).attr("min",$("#fc_ev_startDate").val());
        $(this).datepicker("option","minDate",$("#fc_ev_startDate").val()); 
      });
      $("#fc_ev_startDate").focus(function(){ 
        $(this).attr("max",$("#fc_ev_endDate").val()); 
        $(this).datepicker("option","maxDate",$("#fc_ev_endDate").val()); 
      });

      $("#fc_ev_endTime").focus(function(){
        if($("#fc_ev_endDate").val() == $("#fc_ev_startDate").val() && $("#fc_ev_endDate").val()!=""){
          $(this).attr("min",$("#fc_ev_startTime").val());
        }
        else{ $(this).removeAttr("min"); }
      });
      $("#fc_ev_startTime").focus(function(){
        if($("#fc_ev_endDate").val() == $("#fc_ev_startDate").val() && $("#fc_ev_endDate").val()!=""){
          $(this).attr("max",$("#fc_ev_endTime").val());
        }
        else{ $(this).removeAttr("max"); }
      });
    }
    // if xhtml11 is being used (determined by php), then we will have a {select} element for time|date
    if($("select#fc_ev_startTime").length!=0){  
      $("#fc_ev_endTime").change(function(){
        currentvalue = $("#fc_ev_startTime").val();
        if($("#fc_ev_endDate").val() == $("#fc_ev_startDate").val() && $("#fc_ev_endDate").val()!=""){
          maximumvalue = $(this).val();
          $.ajax({
            type: "POST",
            url: "/themes/glorioso/ajax/fillselectoptions.php",
            data: {maxval:maximumvalue,selected:currentvalue},
            success: function(data){ $("#fc_ev_startTime").children().remove().end().append(data).val(currentvalue); }
          });
        }        
        else{
          $.ajax({
            type: "POST",
            url: "/themes/glorioso/ajax/fillselectoptions.php",
            data: {selected:currentvalue},
            success: function(data){ $("#fc_ev_startTime").children().remove().end().append(data).val(currentvalue); }
          });
        }
      });
      $("#fc_ev_startTime").change(function(){
        currentvalue = $("#fc_ev_endTime").val();
        if($("#fc_ev_endDate").val() == $("#fc_ev_startDate").val() && $("#fc_ev_endDate").val()!=""){
          minimumvalue = $(this).val();
          $.ajax({
            type: "POST",
            url: "/themes/glorioso/ajax/fillselectoptions.php",
            data: {minval:minimumvalue,selected:currentvalue},
            success: function(data){ $("#fc_ev_endTime").children().remove().end().append(data).val(currentvalue); }
          });
        }
        else{
          $.ajax({
            type: "POST",
            url: "/themes/glorioso/ajax/fillselectoptions.php",
            data: {selected:currentvalue},
            success: function(data){ $("#fc_ev_endTime").children().remove().end().append(data).val(currentvalue); }
          });
        }
      });
    }
}
// end jquery-UI formatting and automation of create_cal_event_wrapper elements

// md5 verification if user really is news admin
// if so then add administrative buttons to calendar dialog
$.get("themes/glorioso/ajax/ajax_fc.php",function(data){
  data = $.trim(data);
  if(MD5(data)=="cf4b1a648e5405fba687ee67934725e2"){ 
    $('#calendarviewer').dialog("option","buttons",{
  		"Aggiorna": function() {
  			$('#calendarviewer').fullCalendar('refetchEvents');
  			$('#calendarviewer').fullCalendar('rerenderEvents');
  			},
  		"Aggiungi evento": function() {
  			$("#create_cal_event_wrapper").dialog("open");  
        }                			
		});
	}
});

$(".fc-sun").css({color:"DarkRed"});

$("#gloriosocal").click(function(){
  $('#calendarviewer').dialog('option','position','top').dialog("open"); 
  $('#calendarviewer').fullCalendar('render');
  return false;
  });

$("#gloriosocal").hover(function(){
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
$("#btn_cal_create_event").click(function(){
  $("#create_cal_event_wrapper").slideUp("slow");
  formdata = $("#create_cal_event").serialize();
  $.ajax({
    type: "POST",
    url: "/themes/glorioso/ajax/createEvent.php",
    data: formdata,
    success: function(data) {
	  $("#TIP").html("<span>Evento creato con successo</span>").fadeIn("fast").fadeTo(5000, 1).fadeOut("slow");
	  $('#calendarviewer').fullCalendar('refetchEvents');
	  $('#calendarviewer').fullCalendar('rerenderEvents');
    }
  });
});

});