//////////////////////////////////////////////////////////////////////////////
// Heading xx /////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

/*global window, CanvasTurtle, LogoInterpreter */

var g_logo;

var activeLesson = 0;

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
    $( "#accordion" ).replaceWith('<div id="accordion">');

    // Render the template with the lessons data
    $.tmpl( "lessonTemplate", lessons[lessonID], {}).appendTo( "#accordion" );

    $( "#accordion" ).accordion({
        //      icons: icons,
        icons : false ,
        autoHeight: false
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
    + '<a href="#" data-lesson="${$index}" id="lucio" name="lucio">'
    + '<span>'
    + '<b>${$index+1}. ${title}</b>'
    + '</a>'
    + '</span>'
    + '</div>'
    + '</li>'
    + '{{/each}}';

    var  buri = 
    '{{each lessons}}'
    + '<li>'
    + '<div>'
    + '<a href="#" data-lesson="${$index}" id="lucio" name="lucio">'
    + '<span>'
/*
   // + '{{if locale_he}}'
   if (locale == "he_IL")
        + '<b>${$index+1}. ${title.locale_he_IL}</b>'
   // + '{{else}}'
   else
        + '<b>${$index+1}. ${title.locale_en_US}</b>'
    +  '{{/if}}'
 */
    + '<b>${$index+1}. ${title.' + localeWithPrefix + ' }</b>'
    + '</a>'

    + '<a href="http://10.0.0.4/test2/lessons.php?lesson=${id}" >' //data-lucio="${$index}">'
    + 'edit'    //'<b><span>${$index+1}. ${id} </span></b><em></em>'
    + '</a>'
    + '</span>'
    + '</div>'
    + '</li>'
    + '{{/each}}';
    
    $.template( "headTemplate", markup );

    // The lesson template
    var ltr ='';
    if (locale != "he_IL") ltr = ' style="left: 270px"';
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
                  +  '<button>' + gt.gettext("hint") + '</button>'
                  +  '<p id="(${Id})" style="display: none">{{html hint}}</p>'
              + '{{/if}}'
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
    $("#header a#lucio").click(function() {
        loadLesson($(this).data('lesson'));
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
		var $dialog = $('<div dir="rtl"></div>');
		var $link = $(this).one('click', function() {
			$dialog
				.load($link.attr('href'))
				.dialog({
					title: $link.attr('title'),
					width: 500,
					height: 300
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
 
     $('#console').find(".jqconsole-cursor").css('position','');    
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
                    $(".ui-state-active a").append('<span class="ui-icon ui-icon-check"'+ltr+'></span>' );
                    $.Storage.set("q(" + activeLesson + ")" + $(".ui-accordion-content-active").data('qid'), "true");
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
    
});
