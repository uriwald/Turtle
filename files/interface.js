//////////////////////////////////////////////////////////////////////////////
// Heading xx /////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

/*global window, CanvasTurtle, LogoInterpreter */

var g_logo;

var activeLesson = 0;

var lastLessonClick = null ;

$.extend({
  getUrlVars: function(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    return $.getUrlVars()[name];
  }
});

//////////////////////////////////////////////////////////////////////////////
// Load selected lesson into accordion ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

function loadLesson(lessonID)
{
    //Set the activeLesson
    activeLesson = lessonID;
    //Clear the accordion
    $( "#accordion" ).replaceWith('<div id="accordion" style="color:#4aa329">');

    // Render the template with the lessons data
    $.tmpl( "lessonTemplate", lessons[lessonID], {}).appendTo( "#accordion" );

    $( "#accordion" ).accordion({
        //      icons: icons,
        icons : true ,
        autoHeight: false,
        heightStyle: "content"
    });
    
    $('button').click(function () {
        $(this).next().show('slow');
    });

    //
    $('#prevlesson').show();
    $('#nextlesson').show();    
    if (activeLesson == 0) $('#prevlesson').hide();
    if (activeLesson == (lessons.length -1)) $('#nextlesson').hide();

}

// TODO - doc
function comparecommands (command, solution) {
    var parsedcmd = g_logo.parse(command),
    parsedsol = g_logo.parse(solution);
    function compcmdarrays(cmdarray, solarray) {
        if (cmdarray.length != solarray.length) return false;
        while (cmdarray.length) {
            var cmdpart = cmdarray.pop();
            var solpart = solarray.pop();
            if (typeof cmdpart == 'object') {
                if (compcmdarrays(cmdpart, solpart)) {
                    continue
                } else {
                    return false
                };
            }
            if (solpart == 'XXXXX') continue;
            if (cmdpart == solpart) continue;
            if (g_logo.routines[cmdpart] != undefined && g_logo.routines[cmdpart] == g_logo.routines[solpart]) continue;
            return false;
        }
        return true;
    }
    return compcmdarrays(parsedcmd, parsedsol);
}

$(function() {
    // Compile templates used later
    // The header template
    
    var gt = new Gettext({'domain' : 'messages'});
    //var locale = $.getUrlVar('locale'); 
    var localeWithPrefix = 'locale_' + locale;
    
    var markup =
    '{{each lessons}}'
    + '<li>'
    + '<div>'
    + '<a href="#" data-lesson="${$index}" id="lucio${$index}" name="lucio${$index}" class="lucio">'
    + '{{if $index == 0}}'
        + '<span style="color:#eb8f00">'
    + '{{else}}'
        + '<span>'
    + '{{/if}}'
  //  + '<span>'
    + '<b>${$index+1}. ${title}</b>'
    + '</a>'
    + '</span>'
    + '</div>'
    + '</li>'
    + '{{/each}}';
    
    $.template( "headTemplate", markup );

    // The lesson template
    var ltr ='';
    if (locale != "he_IL") 
        ltr = ' style="margin-left: 250px; margin-top : -10px"';
    else
        ltr = ' style="margin-right: 260px; margin-top : -12px"';
    markup =
    '{{each steps}}' 
     // + '{{if '+  localeWithPrefix + '}}'  
          +  '<h3><a href="#"> ${$index}. ${title}'
          +  '{{if $.Storage.get("q(" + activeLesson + ")" + ($index +1)) == "true"}}'
              +  '<span class="ui-icon ui-icon-check"'+ltr+'></span>'  
          +  '{{/if}}'
          + '</a></h3>'
          + '<div data-sol="${solution}" data-qid="${$index +1}">'
              + '<p>{{html explanation}}</p> <p>{{html action}}</p>'
              + '{{if hint.length > 0}}'
                  +  '<button class="btn">' + gt.gettext("hint") + '</button>' 
                  +  '<p id="(${Id})" style="display: none">{{html hint}}</p>'
              + '{{/if}}'
              +'<p id="' + activeLesson+'${$index +1}"> </p>'
          + '</div>'
      
    //  +  '{{/if}}'

    /*
    + '{{if locale_he_IL}}'
      +  '<h3><a href="#">${$index +1}. ${locale_he_IL.title}'
      +  '{{if $.Storage.get("q(" + activeLesson + ")" + ($index +1)) == "true"}}'
    
          +  '<span class="ui-icon ui-icon-check"'+ltr+'></span>'  
  
      +  '{{/if}}'

    
      + '</a></h3>'

      + '<div data-sol="${locale_he_IL.solution}" data-qid="${$index +1}">'
      + '<p>{{html locale_he_IL.explanation}}</p> <p>{{html locale_he_IL.action}}</p>'
      + '{{if locale_he_IL.hint.length > 0}}'
      +  '<button>' + gt.gettext("hint") + '</button>'
      +  '<p id="(${Id})" style="display: none">{{html locale_he_IL.hint}}</p>'
      + '{{/if}}'
      + '</div>'
    
    
    + '{{else}}'


      + '<h3><a href="#">${$index +1}. ${title}'
        +  '{{if $.Storage.get("q(" + activeLesson + ")" + ($index +1)) == "true"}}'
    
          +  '<span class="ui-icon ui-icon-check"'+ltr+'></span>'  
  
       +  '{{/if}}'

      + '</a></h3>'

      + '<div data-sol="${solution}" data-qid="${$index +1}">'
      + '<p>{{html explanation}}</p> <p>{{html action}}</p>'
      + '{{if hint.length > 0}}'
        +  '<button>' + gt.gettext("hint") + '</button>'
        +  '<p id="(${Id})" style="display: none">{{html hint}}</p>'
      + '{{/if}}'
      + '</div>'
    
    +  '{{/if}}'
    
    */
    + '{{/each}}'
    ;

    $.template( "lessonTemplate", markup );

    // Render the header with the lessons data
    $.tmpl( "headTemplate", lessons[0],{} ).appendTo( "#header" );

    // Attach the loadlesson on click action
    $("#header a.lucio").click(function() {
       
         $(this).children().css("color","#eb8f00");
         //$( "#lucio" ).children().css("background","#00FF00")
         if (lastLessonClick != null)
         {
             lastLessonClick.children().css("color","#1c94c4");
         }
         else
         {
            $( "#lucio0" ).children().css("color","#1c94c4");
         }
        
         loadLesson($(this).data('lesson'));
         lastLessonClick = $(this);
         return false;
    });
    
    // attach the next/prev movement
    $("#nextlesson").click(function() {
        loadLesson(activeLesson +1);
    });
    
    $("#prevlesson").click(function() {
        loadLesson(activeLesson -1);
    })

    // load DOC in dialog
    $('#doc').each(function() {
            if (locale != "he_IL")
		var $dialog = $('<div dir="ltr"></div>');
            else
                var $dialog = $('<div dir="rtl"></div>');
		var $link = $(this).one('click', function() {
			$dialog
				.load($link.attr('href'))
				.dialog({
					title: $link.attr('title'),
                                        width: 700
                                      
					//width: 500,
					//height: 300
				});

			$link.click(function() {
				$dialog.dialog('open');

				return false;
			});

			return false;
		});
	});
    // Render the first lesson
    loadLesson(0);

    //////////////////////////////////////////////////////////////////////////////
    // Console ///////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////

    // Creating the console.
    var welcome = 'Hello\nWelcome to the world of the turtle\n';
    
    window.jqconsole = $('#console').jqconsole(gt.gettext("Hi") + "\n" + gt.gettext("Welcome to the Turtle world"), '> ');
    //window.jqconsole = $('#console').jqconsole(gt.gettext("Hi \nWelcome to the Turtle world"), '> ');
    //        window.jqconsole = $('#console').jqconsole(gt.gettext("welcome"), '> ');
   
   //This is more elegant code but still not working
   /*
   var ltrDirection ='';
    if (locale == "he_IL") ltrDirection = ".css('direction','rtl')"; 
     $('#console').find(".jqconsole").height('200px') + ltrDirection;   
     */
    
    if (locale == "he_IL") //Should be check comparing to array contaning all RTL languages
        {
        // chk
        $('#console').find(".jqconsole").height('200px').css('direction','rtl');
       
            }
    else
        {
         $('#console').find(".jqconsole").height('200px');   
        }
 
     $('#console').find(".jqconsole-cursor").css('position','relative');    
    // Abort prompt on Ctrl+Z.
    jqconsole.RegisterShortcut('Z', function() {
        jqconsole.AbortPrompt();
        handler();
    });

    // Move to line start Ctrl+A.
    jqconsole.RegisterShortcut('A', function() {
        jqconsole.MoveToStart();
        handler();
    });

    // Move to line end Ctrl+E.
    jqconsole.RegisterShortcut('E', function() {
        jqconsole.MoveToEnd();
        handler();
    });

    jqconsole.RegisterMatching('{', '}', 'brace');
    jqconsole.RegisterMatching('(', ')', 'paran');
    jqconsole.RegisterMatching('[', ']', 'bracket');

    // Load console history from localStorage for consistant console
    if ($.Storage.get("logo-history")) jqconsole.history = JSON.parse($.Storage.get("logo-history"));

    // Handle a command.
    var handler = function(command) {
        if (command) {
            try {
                // Allow the logo vm to run the command
                g_logo.run(command);
                // Assuming the command ran, we can store the history for later usage
                if (typeof jqconsole.history != 'undefined') $.Storage.set('logo-history',JSON.stringify(jqconsole.history.slice(jqconsole.history.length-10)));

                // Now we evaluate the command against the one we were expecting
                if (comparecommands(command, $(".ui-accordion-content-active").data('sol')))
                {
                    // If this was correct, we add a checkmark and remember this for later, than progress to the next question of the lesson
                    //Only if a not contain
                    var selectorMatches = $('.ui-state-active a').is( ':has(span.ui-icon)');
                    if(selectorMatches == false) 
                        $(".ui-state-active a").append('<span class="ui-icon ui-icon-check"'+ltr+'></span>' );
                    $.Storage.set("q(" + activeLesson + ")" + $(".ui-accordion-content-active").data('qid'), "true");
                    //After setting new local storage value we will save user data if exist
                    var lclStorageValue="";
                    for (var i=0;i<8;i++)
                        for (var j=1;j<9;j++)
                            {
                                if ($.Storage.get("q(" + i +  ")" + j + "1" ))
                                {
                                    //alert ("q(" + i +  ")" + j + "1");
                                    lclStorageValue += "q(" + i +  ")" + j + "1,";
                                }
                            }
                    $.ajax({
                        type : 'POST',
                        url : 'files/saveLocalStorage.php',
                        dataType : 'json',
                        data: {
                            lclStoragevalues  :   lclStorageValue
                        },
                        success: function(data) { 
                            var rdata;
                        } ,
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert('en error occured');
                        }
                    });
                    //End of saving user data
                    $("#accordion").accordion( "option", "active", $("#accordion").accordion( "option", "active" ) + 1);

                }
            } catch (e) {
                // Write the failure to our console
                jqconsole.Write(gt.gettext('Error') +': ' + e + '\n');
            }
        }
        jqconsole.Prompt(true, handler, function(command) {
            // Continue line if can't compile the command.
            try {
            //Function(command);
            } catch (e) {
                if (/[\[\{\(]$/.test(command)) {
                    return 1;
                } else {
                    return 0;
                }
            }
            return false;
        });
    };

    // Initiate the first prompt.
    handler();

    ////////////////////////////////////
    // Create the logo interperter
    ////////////////////////////////////

    var stream = {
        read: function(s) {
            return window.prompt(s ? s : "");
        },
        write: function() {
            for (var i = 0; i < arguments.length; i += 1) {
                jqconsole.Write(arguments[i]);
            }
        },
        clear: function() {
            // TODO - maybe clear the console?
        }
    };

    var canvas_element = document.getElementById("sandbox");
    var turtle_element = document.getElementById("turtle");
    var turtle = new CanvasTurtle(
        canvas_element.getContext('2d'),
        turtle_element.getContext('2d'),
        canvas_element.width, canvas_element.height);

    g_logo = new LogoInterpreter(turtle, stream);
                function do_logo(id ,cmd) {
                $('#'+id).css('width', '50px').css('height', '50px').append('<canvas id="'+id+'c" width="50" height="50" style="position: absolute; z-index: 0;"></canvas>' +
                    '<canvas id="'+id+'t" width="50" height="50" style="position: absolute; z-index: 1;"></canvas>');
                var canvas_element2 = document.getElementById(id+"c");
                var turtle_element2 = document.getElementById(id+"t");
                var turtle2 = new CanvasTurtle(
                canvas_element2.getContext('2d'),
                turtle_element2.getContext('2d'),
                canvas_element2.width, canvas_element2.height);

                g_logo2 = new LogoInterpreter(turtle2, null);
                g_logo2.run(cmd);
            } 
            do_logo ('011', 'fd 100');
            do_logo ('021', 'repeat 8 [fd 10 rt 360/8]');
            //do_logo ('logo3', 'repeat 10 [repeat 8 [fd 10 rt 360/8] rt 360/10]');
            //do_logo ('logo4', 'repeat 10 [fd repcount*8 rt 90] ht');
            //do_logo ('logo5', 'window repeat 10 [fd 3 * repcount repeat 3 [fd 15 rt 360/3] rt 360/10] ht');
            //do_logo ('logo6', 'window pu home repeat 20 [ setlabelheight 20-repcount fd repcount label "HTML5Fest bk repcount rt 18 ] ht');
});
