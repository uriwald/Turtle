//////////////////////////////////////////////////////////////////////////////
// Heading xx /////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

/*global window, CanvasTurtle, LogoInterpreter */

var g_logo;

var activeLesson = 0;

var turtleid = 1 ;

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

    var handler = function(command) {
        if (command) {
            try {
                // Allow the logo vm to run the command 
                g_logo.run("cs");
                g_logo.run(command);
            } catch (e) {
                // Write the failure to our console
                var i = $("#err-msg").val();
                $("#err-msg").css('visibility', 'visible');
                $("#err-msg").val(e + '\n');
            }
        }
    };
$(function() {
    // Compile templates used later
    // The header template
     
    
    var gt = new Gettext({
        'domain' : 'messages'
    });

    $("#runbtn").click(function() {  
        $("#err-msg").val('');
        handler(editor.getValue());
    });  
    $("#btn_clear").click(function() {    
        jConfirm('Clear will clean will arase your code line and draweing  '  , 'Are you sure ?', function(r) {
            if (r)
            {
                editor.setValue('');
                handler('cs');
                $("#err-msg").val('');
                $("#err-msg").css('visibility', 'hidden');
                
            }
        });
    });  
    $("#btn_create").click(function() {    
        jConfirm('Do you want to save existing program changes?'  , 'New program', function(r) {
            if (r)
            {
                saveprogram(false,true);
            }
            else
            {
                location.href = sitePath + "/files/newProgram.php";
            } 
        });
    }); 
    
    
    $("#btn_update_program").click(function() {    
        saveprogram(true , false);
    });  
    $("#btn_save_program").click(function() {    
        saveprogram(true,true);
    }); 
    $("#program-info-header").editable("click", function(e){
        //alert(e.value);
    });
    
    // Initiate the first prompt.
    handler();
    function saveprogram(isSave , isRedirect)
    {
        var programname     =   $("#program-info-header").text();
        var programtitle    =   prompt("Your program name is ",programname);
        var programCode     =   editor.getValue();
        var username        =   $.Storage.get('username');
        var update          =   !isRedirect;
        if (typeof username == 'undefined')
            username = "TestUser" ;
        
        if (programtitle!=null){
        var x="Hello " + programtitle + "! How are you today?";
                $.ajax({
                type : 'POST',
                url : 'saveUserProgram.php',
                dataType : 'json',
                data: {
                    programtitle    :   programtitle ,
                    programCode     :   programCode , 
                    update          :   update ,
                    programid       :   programid,
                    username : username
                },

                success : function(data){
                    if (isRedirect)
                    {
                        var pathname = window.location.pathname;
                        if (isSave)
                            {
                                var temppath = sitePath + "/files/updateProgram.php";
                                location.href = temppath + "?programid=" + data.programId.$id + "&username=" + data.username ;
                            }
                        else
                            location.href = sitePath + "/files/newProgram.php";
                    }                 
                },       
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('fail');  
                }
            });
        }
    }

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
    //Runing the TO commands
   

});
//
 $( document ).ready(function() {
     var editorVal = replaceAll("↵", "\n" , editor.getValue());
     handler(editorVal);
     editor.setValue(editorVal);
     
    function replaceAll(find, replace, str) 
    {
      while( str.indexOf(find) > -1)
      {
        str = str.replace(find, replace);
      }
      return str;
    }
  });
 