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
    /////////////////////////////////////////////////////////////
    // Console ///////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    var gt = new Gettext({'domain' : 'messages'});
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

});
