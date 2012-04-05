(function(window,undefined){
    var editorElement=$("#editor");
    var consoleElement=$("#console");
    var exercisesListElement=$("#exercises_list");
    var largeConsoleHeight="220px";
    var smallConsoleHeight="120px";
    var reservedCommands=["clear"];
    var SKIP_TEST_COMMAND="SKIP_TEST_COMMAND";
    $(document).ready(function(){
        init()
        });
    var init=function(){
        initConsole();
        initEditor();
        initExercises()
        };
        
    var initEditor=function(){
        if(editorElement.length>0){
            window.editor=CodeMirror(editorElement.find(".scratch")[0],{
                mode:"text/javascript",
                lineNumbers:true,
                matchBrackets:true,
                indentWithTabs:false,
                indentUnit:2,
                tabMode:"shift"
            });
            editorElement.find("button.save").click(saveEditor);
            editorElement.find("button.reset").click(resetEditor);
            editorElement.find("button.run").click(evalConsole)
            }
        };
    
var saveEditor=function(){
    var exercise=getCurrentExercise();
    if(exercise){
        exercise.saveSubmission(window.editor.getValue(),null,renderSubmissions)
        }
    };

var resetEditor=function(){
    var exercise=getCurrentExercise();
    if(exercise){
        window.editor.setValue(exercise.defaultCode)
        }
    };

var renderSubmissions=function(){
    var exercise=getCurrentExercise();
    if(cc.utils.isUnset(exercise)){
        return
    }
    var submissionListElement=$("#submissions ol");
    submissionListElement.empty();
    $.each(exercise.submissions,function(index,submission){
        var updatedAt=new Date(submission.updated_at);
        var liElement=$("<li>"+updatedAt.toTimeString()+"</li>");
        liElement.click(function(e){
            submissionListElement.find("li").removeClass("active");
            liElement.addClass("active");
            var submission=exercise.submissions[$(this).index()];
            if(cc.utils.isSet(submission)&&cc.utils.isSet(submission.entry)){
                window.editor.setValue(submission.entry)
                }
            });
    submissionListElement.append(liElement);
        $(submissionListElement.find("li").get(0)).addClass("active")
        });
if(cc.utils.isSet(exercise.defaultCode)){
    var liElement=$("<li>Default code</li>");
    submissionListElement.append(liElement);
    liElement.click(function(e){
        submissionListElement.find("li").removeClass("active");
        liElement.addClass("active");
        window.editor.setValue(exercise.defaultCode)
        })
    }
};

function Exercise(jsonObj){
    var self=this;
    this._id=jsonObj._id;
    this.path=jsonObj.path;
    this.name=jsonObj.name;
    this.entry=jsonObj.entry;
    this.hint=jsonObj.hint;
    this.index=jsonObj.index;
    this.expectError=jsonObj.expect_error;
    this.showEditor=jsonObj.show_editor;
    this.defaultCode=jsonObj.default_code;
    this.testFunctions=jsonObj.test_functions;
    this.completed=jsonObj.completed;
    this.pointValue=jsonObj.point_value;
    this.submissions=(jsonObj.submissions||[]);
    this.index=function(){
        return getExerciseIndex(self)
        };
        
    this.isComplete=function(){
        return this.completed
        };
        
    this.saveSubmission=function(submission,is_valid,callback){
        $.ajax({
            url:"/submissions",
            type:"POST",
            dataType:"json",
            data:{
                exercise_id:self._id,
                completed:self.completed,
                is_valid:is_valid,
                entry:submission
            },
            success:function(response){
                self.submissions=response.submissions;
                if(cc.utils.isSet(callback)){
                    callback(response)
                    }
                }
        })
};

this.markCompleted=function(){
    this.completed=true
    };
    
this.getDefaultCode=function(){
    if(cc.utils.isSet(self.defaultCode)){
        return self.defaultCode
        }else{
        if(prevExercise(self)){
            return prevExercise(self).getDefaultCode()
            }
        }
}
}
var getIncompleteExercise=function(){
    return window.exercises.first(function(exercise){
        return exercise.isComplete()===false
        })
    };
    
var addExercise=function(exercise){
    window.exercises.push(exercise)
    };
    
var setExercise=function(index,exercise){
    if(index>=0&&index<window.exercises.length){
        window.exercises[index]=exercise
        }
    };

var nextExercise=function(exercise){
    var index=0;
    while(index<window.exercises.length&&window.exercises[index].isComplete()){
        index++
    }
    if(index<window.exercises.length){
        return window.exercises[index]
        }else{
        var index=getExerciseIndex(exercise);
        if(index<window.exercises.length-1){
            return window.exercises[index+1]
            }
        }
};

var prevExercise=function(exercise){
    var index=getExerciseIndex(exercise);
    if(index>0){
        return window.exercises[index-1]
        }
    };

var getExerciseIndex=function(exercise){
    return window.exercises.indexOf(exercise)
    };
    
var getNumExercises=function(){
    return window.exercises.length
    };
    
var getExercise=function(index){
    if(index>=0&&index<window.exercises.length){
        return window.exercises[index]
        }
    };

var getCurrentExercise=function(){
    if(cc.utils.isSet(window.currentExerciseIndex)){
        return window.exercises[window.currentExerciseIndex]
        }
    };

var getExerciseListElement=function(exercise){
    return $(exercisesListElement.find("li").get(getExerciseIndex(exercise)))
    };
    
var setCurrentExercise=function(exercise){
    if(cc.utils.isUnset(exercise)){
        window.currentExerciseIndex=undefined
        }else{
        window.currentExerciseIndex=getExerciseIndex(exercise);
        cc.utils.setURLHash("exercise/"+window.currentExerciseIndex)
        }
    };

var getExerciseFromURLHash=function(){
    var urlHash=cc.utils.getURLHash();
    if(urlHash[0]==="exercise"&&urlHash.length===2){
        return getExercise(parseInt(urlHash[1]))
        }
    };

var initExercises=function(){
    if(window.exercisesData){
        if(cc.utils.isUnset(window.exercises)){
            window.exercises=[];
            $.each(window.exercisesData,function(index,exercise){
                addExercise(new Exercise(exercise))
                })
            }
            if(exercisesListElement.length>0){
            exercisesListElement.find("li").live("click",function(e){
                loadExercise(getExercise($(e.target).closest("li").index()))
                })
            }
            var exercise=getExerciseFromURLHash()||getIncompleteExercise()||getExercise(0);
        if(cc.utils.isSet(exercise)){
            loadExercise(exercise)
            }
        }
};

var loadExercise=function(exercise,output,force){
    if(cc.utils.isSet(exercise)&&(exercise!==getCurrentExercise()||force)){
        setCurrentExercise(exercise);
        renderExercise(exercise,output);
        window._kmq.push(["record","Loaded Exercise",{
            exercise_id:exercise._id,
            exercise_index:exercise.index
            }])
        }
    };

var renderExercise=function(exercise,output){
    if(cc.utils.isUnset(output)){
        output=""
        }
        var exerciseListElement=getExerciseListElement(exercise);
    if(exerciseListElement.length>0){
        if(exercise.isComplete()){
            exerciseListElement.addClass("done")
            }else{
            exerciseListElement.removeClass("done")
            }
            if(exercise===getCurrentExercise()){
            $(exercisesListElement.find("li.active")).removeClass("active");
            exerciseListElement.addClass("active")
            }
        }
    if(exercise.showEditor&&window.editor){
    editorElement.show();
    window.editor.refresh();
    window.editor.focus();
    consoleElement.find(".jqconsole").height(smallConsoleHeight);
    window.jqconsole.Focus=function(){};
    
    if(exercise.submissions.length>0){
        window.editor.setValue(exercise.submissions[0].entry)
        }else{
        if(cc.utils.isSet(exercise.getDefaultCode())){
            window.editor.setValue(exercise.getDefaultCode())
            }
        }
    renderSubmissions()
}else{
    window.jqconsole.Focus=window.jqconsole.FocusBackup;
    consoleElement.find(".jqconsole").height(largeConsoleHeight);
    if(window.jqconsole){
        window.jqconsole.Focus();
        editorElement.hide()
        }
    }
if(exerciseListElement.length===0){
    window.logger.log(exercise.entry)
    }
};

var initConsole=function(){
    if(consoleElement.length>0){
        consoleElement.find(".jqconsole").remove();
        window.jqconsole=consoleElement.jqconsole(null,"> ");
        window.jqconsole.FocusBackup=window.jqconsole.Focus;
        $("code").live("click",function(e){
            window.jqconsole.SetPromptText($(e.target).closest("code").text())
            });
        jqconsole.RegisterShortcut("Z",function(){
            jqconsole.AbortPrompt();
            handler()
            });
        jqconsole.RegisterMatching("{","}","brace");
        jqconsole.RegisterMatching("(",")","paran");
        jqconsole.RegisterMatching("[","]","bracket");
        initConsolePrompt()
        }
    };

var consoleHandler=function(command){
    switch(command){
        case"clear":
            resetConsole();
            break;
        default:
            evalConsole(command);
            break
            }
            initConsolePrompt()
    };
    
var initConsolePrompt=function(){
    jqconsole.Prompt(true,consoleHandler,function(command){
        if(reservedCommands.includes(command)){
            return false
            }else{
            try{
                Function(command)
                }catch(e){}
            return false
            }
        })
};

var resetConsole=function(){
    initConsole();
    loadExercise(getCurrentExercise(),"",true)
    };
    
var evalConsole=function(command){
    if(typeof command!=="string"){
        command=""
        }
        var testResult=false;
    var exercise=getCurrentExercise();
    try{
        if(exercise&&exercise.showEditor&&window.editor){
            command=window.editor.getValue()
            }
            var output=window.eval(command);
        if(window.email!==undefined&&typeof window.email==="string"){
            $.ajax({
                url:root_url+"invite_requests",
                type:"post",
                data:{
                    invite_request:{
                        email:window.email
                        }
                    },
            success:function(){
                window.logger.log("Email successfully added. Thanks.")
                },
            error:function(){
                window.logger.error("An error occured. Please try again.")
                },
            complete:function(){
                window.email=undefined
                }
            })
    }
    if(output!=SKIP_TEST_COMMAND){
    window.logger.output(output);
    if(exercise){
        var testFunctions=new Function("command","output",exercise.testFunctions);
        testResult=testFunctions(command,output);
        if(testResult&&!exercise.expectError){
            exercise.markCompleted();
            loadNextExercise(output)
            }else{
            if(!testResult){
                window.logger.log("<span style='color: crimson'>Oops, try again.</span>")
                }
            }
    }
}
}catch(e){
    window.logger.error(e.message);
    if(exercise&&exercise.expectError){
        var testFunctions=new Function("command","output",exercise.testFunctions);
        testResult=testFunctions(command,output);
        if(testResult){
            exercise.markCompleted();
            loadNextExercise()
            }
        }
}
if(cc.utils.isSet(exercise)){
    exercise.saveSubmission(command,testResult,updateInterface)
    }
};

var loadNextExercise=function(output){
    var exercise=nextExercise(getCurrentExercise());
    if(cc.utils.isSet(exercise)){
        loadExercise(exercise,output)
        }else{
        setCurrentExercise(null);
        var message="You've completed this lesson!";
        if(cc.utils.isSet(window.nextLessonPath)){
            message+=" <a class='next_lesson_in_console' href='"+window.nextLessonPath+"'>Start the next one.</a>"
            }
            if($("#invite_request_form").length>0){
            message+='\n\nWant to hear about new courses and features? Type the following, replacing "user@email.com" with your email: <code>var email = "user@email.com";</code>\n'
            }
            window.logger.log(message)
        }
    };

var loadPrevExercise=function(output){
    var exercise=prevExercise(getCurrentExercise());
    if(cc.utils.isSet(exercise)){
        loadExercise(exercise,output)
        }
    };

var updateInterface=function(){
    $.each(exercises,function(index,exercise){
        var exerciseListElement=getExerciseListElement(exercise);
        if(exerciseListElement){
            if(exercise.isComplete()){
                exerciseListElement.addClass("done")
                }else{
                exerciseListElement.removeClass("done")
                }
            }
    });
loadRecentAchievements();
loadUserWidget();
renderSubmissions()
};

var loadRecentAchievements=function(){
    $.ajax({
        url:"/achievements/recent",
        type:"GET",
        success:function(response){
            cc.ui.loadNotice(response)
            }
        })
};

var loadUserWidget=function(response){
    $.ajax({
        url:"/users/widget",
        type:"GET",
        success:function(data){
            $("#user_badge").replaceWith(data)
            }
        })
};

window.print=function(message){
    window.logger.print(message)
    };
    
window.logger={
    formatLog:function(msg){
        var converter=new Showdown.converter();
        return converter.makeHtml(msg)
        },
    formatOutput:function(output){
        return cc.utils.isSet(output)?"==> "+output.toString()+"\n":""
        },
    formatError:function(msg){
        return"ERROR: "+msg+"\n"
        },
    log:function(msg){
        jqconsole.Write(this.formatLog(msg),"log",false)
        },
    print:function(msg){
        jqconsole.Write(msg+"\n","print",false)
        },
    output:function(output){
        window.latestJQConsoleOutput=output;
        jqconsole.Write(this.formatOutput(window.latestJQConsoleOutput),"output",false)
        },
    error:function(msg){
        jqconsole.Write(this.formatError(msg),"error",false)
        }
    }
})(this);
////
// Atom to HTML - fetch a feed, inject it as dl/dt/dd
//

// Copyright 2009 Joshua Bell
// 
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
// http://www.apache.org/licenses/LICENSE-2.0
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

/*global window, XMLHttpRequest, ActiveXObject */ // For jslint.com

function atomToHtml(uri, element) {

    var READYSTATE_UNINITIALIZED = 0;
    var READYSTATE_LOADING = 1;
    var READYSTATE_LOADED = 2;
    var READYSTATE_INTERACTIVE = 3;
    var READYSTATE_COMPLETE = 4;

    var xhr;
    try {
        if (!xhr && XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        }
    } catch (e1) { }
try {
    if (!xhr && ActiveXObject) {
        xhr = new ActiveXObject('Msxml2.XMLHTTP');
    }
} catch (e2) { }
try {
    if (!xhr && ActiveXObject) {
        xhr = new ActiveXObject('Msxml3.XMLHTTP');
    }
} catch (e3) { }
try {
    if (!xhr && ActiveXObject) {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
    }
} catch (e4) { }
if (!xhr) {
    element.innerHTML = '<em>Unable to load feed</em>';
    return;
}

xhr.open("GET", uri, true);
xhr.onreadystatechange = function() {
    if (xhr.readyState === READYSTATE_COMPLETE) {
        if (200 <= xhr.status && xhr.status < 400) {
            var doc = xhr.responseXML;
            var entries = doc.getElementsByTagName('entry');
            var html = [];

            html.push('<dl>');

            for (var i = 0; i < entries.length; i += 1) {
                var entry = entries[i];

                try {
                    var entryHTML = [];
                    entryHTML.push('<dt>', entry.getElementsByTagName('title')[0].childNodes[0].nodeValue, '</dt>');
                    entryHTML.push('<dd>', entry.getElementsByTagName('content')[0].childNodes[0].nodeValue, '</dd>');
                    html.push(entryHTML.join(''));
                }
                catch (e) {
                    if (window.console && window.console.log) {
                        window.console.log("Error:", e);
                    }
                }

            }

            html.push('</dl>');

            element.innerHTML = html.join('');
        }
        else {
            element.innerHTML = '<em>Unable to load feed</em>';
        }
    }
};

try {
    xhr.send(null);
} 
catch (ex) { 
    // Occurs when testing locally
    element.innerHTML = '<em>Unable to load feed</em>';
}
}

