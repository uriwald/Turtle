//////////////////////////////////////////////////////////////////////////////
// Heading xx /////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

/*global window, CanvasTurtle, LogoInterpreter */

var g_logo;

var activeLesson = 0;

var turtleid = 1 ;

var lastLessonClick = null ;

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
    $("#btn_comment").click(function() {  
        //programid username
        if (username != null)
            {
                var saveCommentUrl  = sitePath + "files/saveProgramComment.php";
                var updateMsgUrl    = sitePath + "files/messages/saveNesMessage.php";
                var cmt = $("#commentTxtArea").val();
                $.ajax({
                    type : 'POST',
                    url : saveCommentUrl,
                    dataType : 'json',
                    data: {
                        comment         : cmt,
                        programid       : programid,
                        username        : username
                    },

                    success : function(data){
                        alert('success');
                        $("#comments").load(sitePath + 'files/comments.php?programid=' + programid);
                    },       
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('fail');  
                    }
                });
                $.ajax({
                    type : 'POST',
                    url : updateMsgUrl,
                    dataType : 'json',
                    data: {
                        programid       : programid,
                        username        : username,
                        programCreator  : programCreator
                    },

                    success : function(data){
                        alert('success');
                        $("#comments").load(sitePath + 'files/comments.php?programid=' + programid);
                    },       
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('fail');  
                    }
                });
            }
         else{
             alert('Only register users can comment');
         }
    });
$(function() {
    // Compile templates used later
    $("#comments").load(sitePath + 'files/comments.php?programid=' + programid);
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
                location.href = sitePath + "/program/lang" + localShort;
            } 
        });
    }); 

  
    
    
    $("#btn_delete").click(function() {    
        deleteprogram();
    });
    $("#btn_update_program").click(function() {    
        saveprogram(false , false);
        alert('Program was successfully Updated');
    });  
    $("#btn_save_program").click(function() {    
        saveprogram(true,true);
    }); 
    $("#program-info-header").editable("click", function(e){
        //alert(e.value);
    });
    
    // Initiate the first prompt.
    handler();
    //Will delete user program
    function deleteprogram()
    {
        jConfirm('Are you sure you want to delete program?'  , 'DeleteProgram program', function(r) {
            if (r)
            {
                var delProgramUrl  = sitePath + "files/delUserProgram.php";
                $.ajax({
                    type : 'POST',
                    url : delProgramUrl,
                    dataType : 'json',
                    data: {
                        programid       :   programid,
                        username : username
                    },

                    success : function(data){
                       
                                location.href = sitePath + "/program/lang/"  + localShort;
                                        
                    },       
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('fail');  
                    }
                });
            }
            else
            {
                location.href = sitePath + "/program/lang/" + locale;
            } 
        });


        
    }
    function saveprogram(isSave , isRedirect)
    {
        var programname     =   $("#program-info-header").text();     
        var programCode     =   editor.getValue();
        var update          =   !isSave;
        var saveProgramUrl  = sitePath + "files/saveUserProgram.php";
        if (typeof username == 'undefined')
        {
            alert("Only register user can save their programs , you must log-in");
            return;
        }
        if (programname == "Program 1")
            var programtitle    =   prompt("Your program name is ",programname);
        else
            var programtitle = programname;
        
        if (programtitle!=null){
                $.ajax({
                type : 'POST',
                url : saveProgramUrl,
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
                            location.href = sitePath + "/program/lang/" + localShort;
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
                //convert 
                $("select").msDropdown();
                //createByJson();
                $("#tech").data("dd");  

  });
 