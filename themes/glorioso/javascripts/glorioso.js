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



// create custom animation algorithm for jQuery called "bouncy"

$.easing.bouncy = function (x, t, b, c, d) {

    var s = 1.70158;

    if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;

    return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;

}



// create custom tooltip effect for jQuery Tooltip

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

  

/*

$.ajaxSetup({

    'beforeSend' : function(xhr) {

      if(xhr.overrideMimeType){

        xhr.overrideMimeType('text/html; charset=ISO-8859-1');

    }}

});

*/



// PARSE THE URL QUERY STRING

function getArgs() {

  var args = new Object();

  var query = location.search.substring(1); 

  var pairs = query.split("&"); 

  for(var i = 0; i < pairs.length; i++) {

    var pos = pairs[i].indexOf('='); 

    if (pos == -1) continue; 

    var argname = pairs[i].substring(0,pos); 

    var value = pairs[i].substring(pos+1);

    args[argname] = unescape(value); 

  }

  return args; 

}

var args = getArgs();





// CLOCK FUNCTIONALITY

var weekday=new Array(7);

weekday[0]="Domenica";

weekday[1]="Lunedì";

weekday[2]="Martedì";

weekday[3]="Mercoledì";

weekday[4]="Giovedì";

weekday[5]="Venerdì";

weekday[6]="Sabato";

var month=new Array(12);

month[0]="Gennaio";

month[1]="Febbraio";

month[2]="Marzo";

month[3]="Aprile";

month[4]="Maggio";

month[5]="Giugno";

month[6]="Luglio";

month[7]="Agosto";

month[8]="Settembre";

month[9]="Ottobre";

month[10]="Novembre";

month[11]="Dicembre";

function checkTime(i) {

	if (i<10){i="0" + i;}

	return i;

}

function startTime(withthistimestamp, withlangset){

  mynewtimestamp=null;

  mylangset=null;

  mynewtimestamp=withthistimestamp;

  mylangset=withlangset;

var today=new Date(mynewtimestamp);

var h=today.getHours();

var m=today.getMinutes();

var s=today.getSeconds();

var dy=today.getDay();

var dt=today.getDate();

var mo=today.getMonth();

var y=today.getFullYear();

var ap="";

if(mylangset=="en"){

	ap = " AM";

	if (h > 11) { ap = " PM"; }

	if (h > 12) { h = h - 12; }

	if (h == 0) { h = 12; }

	if(s==0&&m==0&&h==12){ $("div#currentdate").html(weekday[dy]+', '+month[mo]+' '+dt+', '+y); }

}

else if(s==0&&m==0&&h==0){ $("div#currentdate").html(weekday[dy]+', '+dt+' '+month[mo]+' '+y); }

// add a zero in front of numbers<10

h=checkTime(h);

m=checkTime(m);

s=checkTime(s);

$("div#clock").html(h+":"+m+":"+s+ap);

mynewtimestamp = mynewtimestamp+1000;

t=setTimeout(function(){startTime(mynewtimestamp, mylangset);},1000);

}

// END OF CLOCK FUNCTIONALITY SETUP





AudioPlayer.setup("themes/glorioso/javascripts/1pixeloutplayer/player.swf", {  

	transparentpagebg: "yes",

	width: 200

    });  



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

	

/* ADD A FEW GRADIENTS TO THE PAGE WITH JQUERY GRADIENT PLUGIN */

	$('div#pagetop_leftelement').gradient({ from: 'FFFFFF', to: 'DFDCCD', direction: 'vertical' });

	$('div#pagetop_rightelement').gradient({ from: 'FFFFFF', to: 'DFDCCD', direction: 'vertical' });

	$('div#pagetop_midelement').gradient({ from: 'DFDCCD', to: 'FFFFFF', direction: 'vertical' });

	$('.pagetop_topmargin').gradient({ from: 'FFFFFF', to: 'DBDCE3' });

	$('.pagetop_bottommargin').gradient({ from: 'DBDCE3', to: 'FFFFFF' });

	$("#pagetop_bottommargin1").hide();



/* ADD A SILLY ANIMATION FOR NO REASON TO THE JQUERY LOGO AT THE BOTTOM OF THE DOCUMENT */

	$('#jqueryfooter').hover(function(){

			$(this).effect("bounce", { times:3 }, 100);

		},

		function(){

			$(this).animate({

			    width: '587px'

			  }, 500,'easeOutBounce', function() {

			  	$(this).animate({

				    width: '287px'

				  }, 500,'easeInOutElastic');

			  });

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

	$("#toolbar-hide").click(function(){

		$("#toolbar-wrapper").hide();

		$("div#toolbar-show").show();

	});

	$("#toolbar-show").click(function(){

		$("div#toolbar-show").hide();

		$("#toolbar-wrapper").show();

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

      var jpck_css = document.createElement('link');

      jpck_css.rel = 'stylesheet';

      jpck_css.type = 'text/css';

      jpck_css.href = '/themes/glorioso/css/jPicker.css';

      document.getElementsByTagName('head')[0].appendChild(jpck_css);

      

      var jpck_css = document.createElement('link');

      jpck_css.rel = 'stylesheet';

      jpck_css.type = 'text/css';

      jpck_css.href = '/themes/glorioso/css/jPicker-1.1.5.min.css';

      document.getElementsByTagName('head')[0].appendChild(jpck_css);

      

      var jpck = document.createElement('script');

      jpck.type = 'text/javascript';

      jpck.async = true;

      jpck.src = '/themes/glorioso/javascripts/jpicker-1.1.5.min.js';

      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(jpck);

    }

    $.get("/themes/glorioso/ajax/flopt.php",{opindex:"true",file:"themes/glorioso/config.php"},function(data){

       $("div#theme_edit_dialog").html(data).dialog({

				modal: true,

				autoOpen: true,

				show: {effect:'easeIn',speed:1000},

				hide: {effect:'easeOut',speed:1000},

        width:'98%',

        title:'Configurazione Tema Glorioso',

        position:[5,5]

        });

       $("input.cfg_colorpicker").jPicker({images:{clientPath:'/themes/glorioso/images/jPicker/'},color:{alphaSupport:true}}).attr("size","8"); 

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

      location.reload();

      } else {

        // user is not logged in

      }

    }, {perms:'email,user_birthday,status_update,read_stream,publish_stream,create_event,rsvp_event,sms'});  

  });

  $('#fb_logout').click(function(){

    if($("#logoutmsg").length==0){

      $("body").append("<div id='logoutmsg'></div>");

      $("div#logoutmsg").dialog({

  					modal: true,

  					autoOpen: false,

  					show: {effect:'bounce',speed:1000},

  					hide: {effect:'bounce',speed:1000}

      });

    }

    $("div#logoutmsg").html("Stai uscendo sia da facebook che dal sito parrocchiale...").dialog("open");

    FB.logout(function(response) { location.href='index.php?mod=login&op=logout'; });

  });

}



if ($("div#gfc-button").length!=0){

  $("div#gfc-button").click(function(){

    google.friendconnect.requestSignIn(function(response){

      alert(response);

    });

  });

  $('#gfc_logout').click(function(){

    if($("#logoutmsg").length==0){

      $("body").append("<div id='logoutmsg'></div>");

      $("div#logoutmsg").dialog({

  					modal: true,

  					autoOpen: false,

  					show: {effect:'bounce',speed:1000},

  					hide: {effect:'bounce',speed:1000}

      });

    }

    $("div#logoutmsg").html("Stai uscendo sia da google friend connect che dal sito parrocchiale...").dialog("open");

    google.friendconnect.requestSignOut();

    location.href='index.php?mod=login&op=logout';

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

    $(this).animate({"margin-top":"-60px"})

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

				$(".subsection").not(mysubsection).slideUp(1000,"easeInBounce");

				}

			//Else all subsections will be closed

			else { $(".subsection").slideUp(1000,"easeInBounce"); }

			}

		//else if I click on a subsection button, then all other subsections but its own will be closed;

		if($(this).parent('div').hasClass('subsection')==true){

			if( $(this).next('div').hasClass('subsection') ) { 

				mysubsection = $(this).next('div');

				$(this).siblings('.subsection').not(mysubsection).slideUp(1000,"easeInBounce");

				}

			else {

				$(this).siblings('.subsection').slideUp(1000,"easeInBounce");

			}

			

			}

		//any subsection of the section / subsection will be toggled (open or close)

		

		if( $(this).next('div').hasClass('subsection') && $(this).next('div').html()!="" ) {

			$(this).next('div').slideToggle(3000,"easeOutElastic");

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

  	show: {effect:'bounce',speed:1000},

  	hide: {effect:'bounce',speed:1000}

});



/* SE E' IMPOSTATO UN FEED DI GOOGLE CALENDAR */

gcalfeedurl = $("input#gcal-feed").val();

if(gcalfeedurl!=""){

  $("div#calendarviewer").fullcalendar({

    events: $.fullCalendar.gcalFeed(gcalfeedurl,

          {

            className:       'gcal-event',

            editable:        true,

            currentTimezone: 'Europe/Rome'

          }

    ),

    eventClick: function(event) {

            // opens events in a popup window

            window.open(event.url, 'gcalevent', 'width=700,height=600');

            return false;

    }  

  });

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

		left: "5px"

		}, 20,function(){

			$(thisimg).animate({

				left: "-5px"

				}, 20,function(){

					$(thisimg).animate({

						left: "5px"

						}, 20,function(){

							$(thisimg).animate({

								left: "-5px"

								}, 20)

						});

				});

		}); },

	function(){

	thisimg = this;

	$(thisimg).animate({

		left: "5px"

		}, 20,function(){

			$(thisimg).animate({

				left: "-5px"

				}, 20,function(){

					$(thisimg).animate({

						left: "5px"

						}, 20,function(){

							$(thisimg).animate({

								left: "-5px"

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