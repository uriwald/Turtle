/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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
            
            function loadCKEditor()
            {
                //$( 'textarea' ).ckeditor( function() { /* callback code */ }, { skin : 'kama' , toolbar : [ [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','Link', '-', 'MyButton' ] ] });
                var lang = $.getUrlVar('lfrom');
                if (lang == null || lang.length < 2)
                {
                    lang = "en_US";
                }
                
                var translation = $.getUrlVar('ltranslate');
                var direction = "rtl";
                if (translation != null && translation.length > 2)
                {
                    if (translation == 'he_IL')
                       direction = "rtl"; 
                }
                
                $( 'textarea.expTxtErea' ).ckeditor( function() { /* callback code */ }, { language : lang.value , contentsLangDirection : 'ltr' , width : '500px' , height  : '260px' , readOnly : true /*, skin : 'office2003' */});       
                $( 'textarea.expTxtErea1' ).ckeditor( function() { /* callback code */ }, { language : lang.value , contentsLangDirection : direction , width : '500px' , height  : '260px' /*, skin : 'office2003' */});       

            }
            var isLessonSaved   =   false;
            
            var showFirstStepIfExist = function showFirstStepIfExist(stepsType)
            {
                if ($.Storage.get(stepsType))
                {   
                    
                    if ($.Storage.get('active-step'))
                    {
                        var allsteps = JSON.parse($.Storage.get(stepsType));
                        var currentSteps = allsteps[1];
                        
                        if (currentSteps != null)
                        {
                            if ( stepsType == "lessonStepsValues")
                            {
                                $('#title').val(currentSteps[0]);
                                $('#action').val(currentSteps[1]);
                                $('#solution').val(currentSteps[2]);
                                $('#hint').val(currentSteps[3]);
                                $('#explanation').val(currentSteps[4]);  
                            }
                            else
                            {
                                $('#title1').val(currentSteps[0]);
                                $('#action1').val(currentSteps[1]);
                                $('#solution1').val(currentSteps[2]);
                                $('#hint1').val(currentSteps[3]);
                                $('#explanation1').val(currentSteps[4]);      
                            }
                        }
                    }
                }
            };
          
            function getStepValues(isTranslate)
            {
                if (isTranslate)
                {
                    var stepTitle = $('#title1').val();
                    var stepAction = $('#action1').val();
                    var stepSolution = $('#solution1').val();
                    var stepHint = $('#hint1').val();
                    var stepExplanation = $('#explanation1').val(); 
                }
                else {
                    var stepTitle = $('#title').val();
                    var stepAction = $('#action').val();
                    var stepSolution = $('#solution').val();
                    var stepHint = $('#hint').val();
                    var stepExplanation = $('#explanation').val();  
                }
                    
                var fullStep = new Array();
                    
                fullStep[0] = stepTitle;
                fullStep[1] = stepAction;
                fullStep[2] = stepSolution;
                fullStep[3] = stepHint;
                fullStep[4] = stepExplanation;                
                return fullStep;
            }
            
            //Removing a specific step from the steps array
            function removestep(stepNumber)
            {
      
                jConfirm('Are you sure you want to delete step number ' + stepNumber , 'Confirmation Dialog', function(r) {
                    jAlert('Confirmed: ' + r, 'Confirmation Results');
                    if (r)
                    {
                        //Indicating that some steps has been 
                        //var stepNumberToRemove = stepNumber;
                        $.Storage.set('isStepRemoved',"true");
                        $.Storage.set('stepToRemove' ,stepNumber );
                        
                        
                        var allSteps = JSON.parse($.Storage.get("lessonStepsValues"));
                        allSteps.splice(stepNumber ,1);
                        $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2));
                        var valTotalSteps = parseInt($.Storage.get("lesson-total-number-of-steps")) - 1;
                        $.Storage.set("lesson-total-number-of-steps" , valTotalSteps.toString());
                        var val = parseInt($.Storage.get("active-step-num")) - 1;
                        if (!val == 0)
                        {
                            $.Storage.set("active-step-num" , val.toString());
                        }
                        createStepNavVar(false,true); 
                        populateInputsWithCurrentStep('lessonStepsValues');
                        populateInputsWithCurrentStep('lessonStepsValuesTranslate');
                        //Saving new data
                        window.saveLessonData(false);
                    }
                }); 
                
            }
            function populateInputsWithCurrentStep(stepsType)
            {
                    
                var allSteps = JSON.parse($.Storage.get(stepsType));
                //var allStepsTranslated = JSON.parse($.Storage.get("lessonStepsValues"));
                var currentSteps = allSteps[$.Storage.get('active-step-num')];
                if (stepsType == "lessonStepsValues")
                {
                    $('#title').val(currentSteps[0]);
                    $('#action').val(currentSteps[1]);
                    $('#solution').val(currentSteps[2]);
                    $('#hint').val(currentSteps[3]);
                    $('#explanation').val(currentSteps[4]);
                }
                else
                {
                    $('#title1').val(currentSteps[0]);
                    $('#action1').val(currentSteps[1]);
                    $('#solution1').val(currentSteps[2]);
                    $('#hint1').val(currentSteps[3]);
                    $('#explanation1').val(currentSteps[4]); 
                }
            }
            
            //Remove a full lesson
            function removelesson()
            {
      
                jConfirm('Are you sure you want to delete step number ' + 1 , 'Confirmation Dialog', function(r) {
                    jAlert('Confirmed: ' + r, 'Confirmation Results');
                    if (r)
                    {
                        alert('hello');    
                    }
                }); 
                
            }
        
            var infoElementKeyUpEvent = function infoElementKeyUpEvent(isTranslate)
            {
                var stepsType ="" ;
                if (isTranslate)
                    stepsType = "lessonStepsValuesTranslate";
                else
                    stepsType = "lessonStepsValues";
                    
                if ($.Storage.get("lesson-total-number-of-steps") == 1)
                {
                    window.initializeSteps(stepsType);
                    var firstStep = getStepValues(isTranslate);
                    addStepVar(1,firstStep,true , stepsType);//Making replace     
                }
                    
                if ($.Storage.get("active-step-num"))
                {
                    var fullStep =  getStepValues(isTranslate);    
                    var allSteps;
                    if ($.Storage.get(stepsType))  
                    {
                        allSteps = JSON.parse($.Storage.get(stepsType));     
                    }
                    if ($.Storage.get('active-step-num'))
                    {
                        allSteps.splice(parseInt($.Storage.get("active-step-num")),1,fullStep);              
                        $.Storage.set(stepsType,JSON.stringify(allSteps, null, 2))       
                    } else {
                        allSteps[0] =  fullStep;  
                        $.Storage.set(stepsType,JSON.stringify(allSteps, null, 2))   
                    }
                } 
                //Setting precedence
                var prec = $('#precedence').val();
                if (prec != null)
                {
                    $.Storage.set('precedence',prec);
                }
            }       
                
            var clearLocalStorage = function clearLocalStorage()
            {
                var lessonid = $.getUrlVar('lesson');
                if (lessonid == null || lessonid.length < 3)
                {
                    $.Storage.remove("lessonStepsValues");
                    $.Storage.remove("lesson-total-number-of-steps");
                    $.Storage.remove("active-step-num");
                    //$.Storage.remove("active-step");
                    $.Storage.remove("ObjId");
                    $.Storage.remove("lessonTitle");
                    $.Storage.remove("locale");
                    $.Storage.remove("lessonStepsValuesTranslate");
                    $.Storage.remove("localeTransale");
                    $.Storage.remove("lessonTitleTrans"); 
                    $.Storage.remove("stepToRemove"); 
                    $.Storage.remove("isStepRemoved"); 
                    
                    
                }
                else
                {
                     $.Storage.remove("stepToRemove"); 
                    $.Storage.remove("isStepRemoved"); 
                    /*
                        $.Storage.remove("lessonStepsValuesTranslate");
                        $.Storage.remove("localeTransale");
                        $.Storage.remove("lessonTitleTrans");    
                    */
                }
            }
            
            var saveLessonData = function saveLessonData(isTranslate)
            {
                //TODO get the working collection from storage if exist
                // Making translation case more dynamic according to the isTranslate flag
                $.getScript("files/jquery.Storage.js", function(){
                    //alert("Script loaded and executed.");
                });
                window.infoElementKeyUpEvent(isTranslate);
                var lessonSteps     = 'lessonStepsValues';
                var lessonTitle     = 'lessonTitle';
                var lessonLocale    = 'locale';
                //After removing a step the lesson will be saved automatically
                var isStepRemoved   = false ;
                var stepToRemove    =   "";
                var user        =  "";
                if ($.Storage.get('username'))
                    user        =   $.Storage.get('username'); 
                var collectionName  = $.Storage.get('collection-name');
                
                if ($.Storage.get('isStepRemoved'))
                    isStepRemoved = $.Storage.get('isStepRemoved');
                if ($.Storage.get('stepToRemove'))
                {
                    stepToRemove = JSON.parse($.Storage.get('stepToRemove')) ;
                }
                //End of case
                if (isTranslate)
                 {
                    var lessonSteps     = 'lessonStepsValuesTranslate';
                    var lessonTitle     = 'lessonTitlet';
                    var lessonLocale    = 'localeTranslate'; 
                    //collectionName      = "lessons_translate";           
                 }
                $.ajax({
                    type : 'POST',
                    url : 'saveLessonData.php',
                    dataType : 'json',
                    data: {
                        steps : $.Storage.get(lessonSteps) , //Should be a parameter
                        numOfSteps : $.Storage.get('lesson-total-number-of-steps') ,
                        lessonTitle : $.Storage.get(lessonTitle),
                        ObjId : $.Storage.get('ObjId'),
                        locale : $.Storage.get(lessonLocale),  //Should be a parameter
                        precedence :$.Storage.get('precedence'),
                        translate : isTranslate,
                        isStepRemove  : isStepRemoved ,
                        collection  : collectionName ,
                        stepToRemove : stepToRemove ,
                        username : user

                    },
                        
                    success : function(data){
                        $('#waiting').hide(500);
                        $('#lessonObjectId').val(data.objID.$id);
                        window.isLessonSaved =   true;
                        $.Storage.set("ObjId" , data.objID.$id);
                        $.Storage.set('isStepRemoved' , "false");   
                        //$('#message').removeClass().addClass((data.error === true) ? 'error' : 'success').text(data.msg).show(500);
                        //alert(data.msg);
                        alert("Lesson Saved");
                    },        
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        $('#waiting').hide(500);
                        $('#message').removeClass().addClass('error')
                        .text(XMLHttpRequest.responseText).show(500);
                        $.Storage.set('isStepRemoved' , "false");  
                    }
                });
                return false;
            }
            
            //Adding new full step the the steps array
            //isReplace flag will be set to true while replacing
            //currentStep is the correct step before we press on add step
            //preActiveStep The step that was active before the change
            var addStepVar = function addStep(stepPosition , stepArray , isReplace , allStepsArray , currentstep , preActiveStep)
            {
                window.initializeSteps('lessonStepsValues');
                window.initializeSteps('lessonStepsValuesTranslate');
                var allSteps            =   JSON.parse($.Storage.get(allStepsArray));
                allSteps[preActiveStep]  = currentstep;    
                if (isReplace === true )
                {
                    allSteps.splice (stepPosition , 1 , stepArray);      
                }
                else
                {
                    allSteps.splice (stepPosition , 0 , stepArray); 
                }
                    
                $.Storage.set(allStepsArray,JSON.stringify(allSteps, null, 2)) 
            };
            /**
             * Will use the get Variable lessons with his locale
             * will use ajax request to load lesson data
             * in order to get the lesson id and his locale
             * than will load the existing step
             */
            function loadExistingLessonSteps( lessonid ,originLang , transLang)
            {        
                //var lessonid = $.getUrlVar('lesson');
                //var locale = $.getUrlVar('lfrom');
                if (originLang != null && originLang.length > 2)
                {
                    $.Storage.set("locale" , originLang);
                    $.Storage.set("localeTranslate" , transLang);
                }
                if (lessonid != null && lessonid.length > 2)
                {
                    $.Storage.set("ObjId" , lessonid);
                }
                var collection = $.Storage.get("collection-name");
                if (originLang != null && originLang.length > 2 && lessonid != null && lessonid.length > 2)
                {
                    $.ajax({
                        url: 'files/loadLessonSteps.php?lesson=' + lessonid + '&l=' + originLang + '&col=' + collection ,
                        success: function(data) { 
                            var rdata;
                            rdata = JSON.parse(data);
                            $.Storage.set("lessonTitle" , rdata.title);
                            $('#lessonTitle').val(rdata.title);
                            $('.result').html(data);
                            //alert('Load was performed.');
                            var i = 1;
                        } ,
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert('en error occured');
                        }

                    });
                }
                if (transLang != null && transLang.length > 2 && lessonid != null && lessonid.length > 2)
                {
                    $.ajax({
                        url: 'files/loadLessonSteps.php?lesson=' + lessonid + '&l=' + transLang,
                        success: function(data) {
                            //alert(data);
                            var rdata;
                            rdata = JSON.parse(data);
                            $.Storage.set("lessonTitleTrans" , rdata.title);
                            $('#lessonTitlet').val(rdata.title);
                        } ,
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert('en error occured');
                        }

                    });
                }
            }
            
            var clearStep = function clearStep()
            {
                $('#title').val("");
                $('#action').val("");
                $('#solution').val("");
                $('#hint').val("");
                $('#explanation').val("");
                // Translate elemnets
                $('#title1').val("");
                $('#action1').val("");
                $('#solution1').val("");
                $('#hint1').val("");
                $('#explanation1').val("");
            }

            /**
             * Creating the step navigator
             * each step containing the title , hint , solution explanation and etc 
             * Diffrent case between loading existin step , and adding a step to a lesson
             * should be seen in active step perpective
             * isAddStep - if the step was added now or not
             */
            var createStepNavVar = function createStepNav(isStepAdd , isStepRemove)
            {
                var lessonStepValuesStorage = new Array(new Array());
                var gt = new Gettext({'domain' : 'messages'});
                if ($.Storage.get("lesson-total-number-of-steps"))
                {
                    //var currentNumOfLessonStep = $('.existing_step').length;
                    $('.existing_step').remove();
                    $('.add_step').remove();
                    
                    var numOfLessonSteps = $.Storage.get("lesson-total-number-of-steps");
                    var liElements = "";
                    var active ="";
                    var stepId = "lesson_step";
                    
                    for (i=1;i<=numOfLessonSteps;i++)
                    {
                       if (i == 1 )
                           {
                           if (!isStepAdd && !isStepRemove ) 
                                active = "active";
                           }
                       else
                           {
                               if(!isStepRemove)
                                   {
                                        if (isStepAdd && i == numOfLessonSteps)  
                                            active = "active";
                                        else
                                            active = "";  
                                   }
                               else
                                   {
                                       var val = parseInt($.Storage.get('stepToRemove'))-1;
                                       if (i == val)
                                           active = "active";                            
                                   }
                           }
                           
                       var id = stepId + i ;
                       // liElements += '<li class="existing_step" id='+ id + "> <a href=# >" + i + "</a></li>";
                       liElements += "<li class='existing_step " + active + "" + "'id=\"" +id + "\">" + " <a href='#'> " + i + " </a></li>";
                       active = "";
                    }
                    liElements += "<li><a class='add_step' id='addStep'>" + gt.gettext("Add lesson step") + "</a></li>";
                    if (isStepAdd)
                        {
                            $.Storage.set('active-step' , stepId + numOfLessonSteps); 
                        }
                    $("#lessonStepUl" ).append(liElements);
                      
                }
                else
                {
                    $("#lessonStepUl" ).append('<li class="existing_step active" id="lesson_step1"> <a href="#"> 1 </a></li><li><a class="add_step" id="addStep">' + gt.gettext("Add lesson step") + '</a></li>');  
                    $.Storage.set('lesson-total-number-of-steps' , '1');
                    $.Storage.set('lessonStepsValues',JSON.stringify(lessonStepValuesStorage, null, 2))
                    $.Storage.set('lessonStepsValuesTranslate',JSON.stringify(lessonStepValuesStorage, null, 2))
                }
            };
            
            var initializeSteps = function initializeSteps(stepsToInitialize)
            {
                if (! $.Storage.get(stepsToInitialize))
                {
                    var lessonStepValuesStorage = new Array(new Array());
                    $.Storage.set(stepsToInitialize,JSON.stringify(lessonStepValuesStorage, null, 2))
                }
            }

            $(document).ready(function() {
                     
                if ($('.dropdown-toggle').length > 0)
                     $('.dropdown-toggle').dropdown();
                window.clearLocalStorage();
                window.clearStep();
                var lessonid = $.getUrlVar('lesson');
                var originLang = $.getUrlVar('lfrom');
                var transLang = $.getUrlVar('ltranslate');
                loadExistingLessonSteps(lessonid ,originLang , transLang );
                //loadCKEditor();
                createStepNavVar(false,false);
                showFirstStepIfExist('lessonStepsValues');
                showFirstStepIfExist('lessonStepsValuesTranslate');
                
                if (!$.Storage.get("ObjId"))
                {
                    $.Storage.set("ObjId" , "");
                }
                if (!$.Storage.get("locale")) //Setting default locale to en_US
                {
                    $.Storage.set("locale" , "en_US"); 
                    if ($.Storage.get("createLessonLocal"))
                        $.Storage.set("locale" , $.Storage.get("createLessonLocal")); 
                    $.Storage.set("localeTranslate" , "he_IL");
                    
                }
                if (!$.Storage.get("active-step-num"))
                {
                    $.Storage.set('active-step-num' , '1');    
                }
                if (!$.Storage.get("precedence"))
                {
                     $.Storage.set('precedence' , '80');
                }
                $('#addStep').live("click" , function() {
                    var val             = parseInt($.Storage.get("lesson-total-number-of-steps")) + 1;
                    var currentStep     =  getStepValues(false); 
                    var preActiveStep   = $.Storage.get('active-step-num');
                    $.Storage.set("lesson-total-number-of-steps" , val.toString());
                    $.Storage.set('active-step-num' , val.toString());  
                    addStepVar(val , new Array() , false , "lessonStepsValues",currentStep,preActiveStep);
                    clearStep();
                    createStepNavVar(true,false);
                });
                $('#removeStep').click(function () {
                    if (parseInt($.Storage.get("lesson-total-number-of-steps")) > 1)
                    {
                        if ($.Storage.get('active-step-num'))
                        {
                            removestep($.Storage.get('active-step-num'));
                        }
                    }

                });
                //Case of swithing language in creating lesson page
                try {
                     var pages = $("#selectedLanguage").msDropdown({on:{change:function(data, ui) {
                        var val = data.value;
                        //$.Storage.set("locale",val);
                        if(val!="")
                        {
                            window.location.assign('lesson.php?locale=' + val);          
                        }
                }}}).data("dd");
                var pageIndex   =  $.Storage.get("locale");
                if (pageIndex == "")
                    pageIndex   = "en_US";
                pages.setIndexByValue(pageIndex);
                } catch(e) { 
                        console.log(e);	
                }
                //Ending case of swithing languages
                              
                // We are now in translating page so isTranslate = true
                $('.lessonInfoElement').live("keyup" , function() {
                    window.infoElementKeyUpEvent(true);
                });
                $('.cke_editor_explanation').live("keyup" , function() {
                    window.infoElementKeyUpEvent(true);
                });
                
                $('#lessonTitle').keyup(function() {       
                    var lessonTitle = $('#lessonTitle').val();           
                    $.Storage.set('lessonTitle' , lessonTitle);
                });
                
                $('#lessonTitlet').keyup(function() {       
                    var lessonTitle = $('#lessonTitlet').val();           
                    $.Storage.set('lessonTitlet' , lessonTitle);
                });
                
                
                //While clicking on other step .. saving step info
                //TODO while clicking existing step make it more generic to support translation
                $('.existing_step').live("click" , function() {
                    var fullStep =  getStepValues(false);         
                    window.clearStep();
                    var allSteps;
                    if ($.Storage.get("lessonStepsValues"))
                    
                    {
                        allSteps = JSON.parse($.Storage.get("lessonStepsValues"));     
                    }
                    else
                    {
                        allSteps = new Array();     
                    }
                    
                    // Making some action on the privous press element
                    if ($.Storage.get("active-step"))
                    {
                        var name = '#' + $.Storage.get("active-step");
                        $(name).css('background-color' , 'white')
                        $(name).removeClass('existing_step active').addClass('existing_step');
                    }

                    if ($.Storage.get('active-step-num'))
                    {
                        allSteps.splice(parseInt($.Storage.get("active-step-num")),1,fullStep);              
                        $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2));
                    } else { //Case of first step
                        allSteps[0] =  fullStep;  
                        $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2))   
                    }
                        
                    var pressed = $(this).attr('id');
                    $(this).css('background-color' , '#AAA');
                    $(this).removeClass('existing_step').addClass('existing_step active');
                    $.Storage.set('active-step' , pressed);
                    $.Storage.set('active-step-num' , pressed.substring(11));
                    $('.currentSteplable').text($.Storage.get('active-step-num')) ;
                    populateInputsWithCurrentStep('lessonStepsValues');
                    populateInputsWithCurrentStep('lessonStepsValuesTranslate');   
            
                });
                
                $('#btnDeleteLesson').click(function() {
                    //removelesson();
                    //need to remove from DB
                    var gt = new Gettext({'domain' : 'messages'});
                    jConfirm(gt.gettext("Are you sure you want to delete the lesson") , 'Confirmation Dialog', function(r) {
                        jAlert(gt.gettext("Your lessson has been deleted") + r, 'confirm delete');
                        if (r)
                        {
                            $.ajax({
                                type : 'POST',
                                url : 'deleteLessonData.php',
                                dataType : 'json',
                                data: {
                                    ObjId : $.Storage.get('ObjId')
                                },

                                success : function(data){
                                    window.clearLocalStorage();
                                    window.clearStep();
                                    var url = document.URL ;
                                    var myUrl = url.split("?");
                                    alert(gt.gettext("successfully deleted"));
                                    window.location.replace(myUrl[0]);
                                },
                                error : function(XMLHttpRequest, textStatus, errorThrown) {
                                    alert(gt.gettext("an error occured"));
                                }
                            });
                        }
                    }); 
                });     
                
                $('#btnSaveLessonTranslate').click(function() {           
                    window.saveLessonData(true);
                });
                $('#btnSaveLesson').click(function() {  
                    var gt = new Gettext({'domain' : 'messages'});
                    if ($.Storage.get('lessonTitle'))
                        {
                           if ($.Storage.get('lessonTitle').length > 2)
                               window.saveLessonData(false);
                           else
                               alert(gt.gettext("Lesson title should contain at least 2 caracters"));
                        }
                    else{
                        alert(gt.gettext("Lesson title should contain at least 2 caracters"));
                    }
                    
                });
                $('#btnShowDoc').click(function() {           
                    window.open('files/language.html','');
                });
                $('#selectedLanguage').change(function() {   
                    var selLang = $('#selectedLanguage').val();
                    $.Storage.set('createLessonLocal',selLang);
                });
                $('#btnCreateNewLesson').click(function() {  
                    var locale = 'en_US';
                    if ($.Storage.get('createLessonLocal'))
                        locale = $.Storage.get('createLessonLocal')
                    window.open('lesson.php?l=' + locale,'_self');
                });

                
                $('#btnShowLesson').each(function() {
                            var gt = new Gettext({'domain' : 'messages'});
                            
                            
                            var dialogCreatedOnce   =   false ;
                            if (locale != "he_IL")
                                var $dialog = $('<div dir="ltr"></div>'); 
                            else
                                var $dialog = $('<div dir="rtl"></div>');
                            var $link = $(this).live('click', function() {
                                    var locale      = $.Storage.get('locale');
                                    var objid       = $.Storage.get('ObjId');
                                    if (window.isLessonSaved == false)
                                        alert(gt.gettext("You must save the lesson before show lesson"));
                                    else
                                    {  
                                    $dialog                           
                                            .load('showLesson.php?locale=' + locale + '&objid=' + objid)
                                            .dialog({
                                                    title: $link.attr('title'),
                                                    width: 700                                                  
                                            }); 
                                            $link.click(function() {
                                                    $dialog.dialog('open');
                                                    dialogCreatedOnce = true;
                                                    return false;
                                            });
                                    return false;
                                    }
                            });                                           
                    });

                $('#btnDel').attr('disabled','disabled');
            });