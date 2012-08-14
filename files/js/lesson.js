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
                $( 'textarea.expTxtErea' ).ckeditor( function() { /* callback code */ }, { language : lang.value , contentsLangDirection : 'ltr' , width : '500px' , readOnly : true /*, skin : 'office2003' */});       
                $( 'textarea.expTxtErea1' ).ckeditor( function() { /* callback code */ }, { language : lang.value , contentsLangDirection : 'ltr' , width : '500px'  /*, skin : 'office2003' */});       

            }
            
            var showFirstStepIfExist = function showFirstStepIfExist(stepsType)
            {
                if ($.Storage.get(stepsType))
                {   
                    
                    if ($.Storage.get('active-step'))
                    {
                        var allsteps = JSON.parse($.Storage.get(stepsType));
                        var currentSteps = allsteps[1];
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
                        var allSteps = JSON.parse($.Storage.get("lessonStepsValues"));
                        allSteps.splice(stepNumber ,1);
                        $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2));
                        var val = parseInt($.Storage.get("lesson-total-number-of-steps")) - 1;
                        $.Storage.set("lesson-total-number-of-steps" , val.toString());
                        var val = parseInt($.Storage.get("active-step-num")) - 1;
                        if (!val == 0)
                        {
                            $.Storage.set("active-step-num" , val.toString());
                        }
                        createStepNavVar(); 
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
            // TODO suuport case of translating page
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
            }
                
                
            var clearLocalStorage = function clearLocalStorage()
            {
                var lessonid = $.getUrlVar('lesson');
                if (lessonid == null || lessonid.length < 3)
                {
                    $.Storage.remove("lessonStepsValues");
                    $.Storage.remove("lesson-total-number-of-steps");
                    $.Storage.remove("active-step-num");
                    $.Storage.remove("active-step");
                    $.Storage.remove("ObjId");
                    $.Storage.remove("lessonTitle");
                    $.Storage.remove("locale");
                    $.Storage.remove("lessonStepsValuesTranslate");
                    $.Storage.remove("localeTransale");
                    $.Storage.remove("lessonTitleTrans");   
                }
                else
                {
                    /*
                        $.Storage.remove("lessonStepsValuesTranslate");
                        $.Storage.remove("localeTransale");
                        $.Storage.remove("lessonTitleTrans");    
                    */
                }
            }
            
            var saveLessonData = function saveLessonData(isTranslate)
            {
                // Making translation case more dynamic according to the isTranslate flag
                window.infoElementKeyUpEvent(isTranslate);
                var lessonSteps = 'lessonStepsValues';
                var lessonTitle = 'lessonTitle';
                var lessonLocale = 'locale';
                if (isTranslate)
                 {
                    var lessonSteps = 'lessonStepsValuesTranslate';
                    var lessonTitle = 'lessonTitlet';
                    var lessonLocale = 'localeTranslate';  
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
                        translate : true

                    },
                        
                    success : function(data){
                        $('#waiting').hide(500);
                        $('#lessonObjectId').val(data.objID.$id);
                        $.Storage.set("ObjId" , data.objID.$id);
                               
                        $('#message').removeClass().addClass((data.error === true) ? 'error' : 'success').text(data.msg).show(500);
                        //alert(data.msg);
                        //alert("Lesson Saved");
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        $('#waiting').hide(500);
                        $('#message').removeClass().addClass('error')
                        .text('There was an error.').show(500);
                    }
                });
                return false;
            }
            
            //Adding new full step the the steps array
            //Replace flag will be set to true while replacing
            var addStepVar = function addStep(stepPosition , stepArray , replace , allStepsArray)
            {
                window.initializeSteps('lessonStepsValues');
                window.initializeSteps('lessonStepsValuesTranslate');
                var allSteps = JSON.parse($.Storage.get(allStepsArray));
                if (replace === true )
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
                if (originLang != null && originLang.length > 2 && lessonid != null && lessonid.length > 2)
                {
                    $.ajax({
                        url: 'files/loadLessonSteps.php?lesson=' + lessonid + '&l=' + originLang,
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
             */
            var createStepNavVar = function createStepNav()
            {
                var lessonStepValuesStorage = new Array(new Array());
                if ($.Storage.get("lesson-total-number-of-steps"))
                {
                    //var currentNumOfLessonStep = $('.existing_step').length;
                    $('.existing_step').remove();
                    var numOfLessonSteps = $.Storage.get("lesson-total-number-of-steps");
                    var liElements = "";
                    for (i=1;i<=numOfLessonSteps;i++)
                    {
                        var id = 'lesson_step' + i ;
                        liElements += '<li class="existing_step" id='+ id + ">" + i + "</li>";
                    }
                    $("#lessonStepUl" ).append(liElements);
                      
                }
                else
                {
                    $("#lessonStepUl" ).append('<li class="existing_step"> 1 </li>');  
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
                
                window.clearLocalStorage();
                window.clearStep();
                var lessonid = $.getUrlVar('lesson');
                var originLang = $.getUrlVar('lfrom');
                var transLang = $.getUrlVar('ltranslate');
                loadExistingLessonSteps(lessonid ,originLang , transLang );
                loadCKEditor();
                createStepNavVar();
                showFirstStepIfExist('lessonStepsValues');
                showFirstStepIfExist('lessonStepsValuesTranslate');
                
                if (!$.Storage.get("ObjId"))
                {
                    $.Storage.set("ObjId" , "");
                }
                if (!$.Storage.get("locale")) //Setting default locale to en_US
                {
                    $.Storage.set("locale" , "en_US"); 
                    $.Storage.set("localeTranslate" , "he_IL");
                    
                }
                if (!$.Storage.get("active-step-num"))
                {
                    $.Storage.set('active-step-num' , '1');    
                }
                $('#addStep').click(function () {
                    var val = parseInt($.Storage.get("lesson-total-number-of-steps")) + 1;
                    $.Storage.set("lesson-total-number-of-steps" , val.toString());
                    $.Storage.set('active-step-num' , val.toString());  
                    addStepVar(val , new Array() , false , "lessonStepsValues");
                    clearStep();
                    createStepNavVar();
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
                    
                    if ($.Storage.get("active-step"))
                    {
                        //$.Storage.set($.Storage.get("active-step"), JSON.stringify(fullStep, null, 2));     
                        var name = '#' + $.Storage.get("active-step");
                        $(name).css('background-color' , 'white')
                    }

                    if ($.Storage.get('active-step-num'))
                    {
                        allSteps.splice(parseInt($.Storage.get("active-step-num")),1,fullStep);              
                        $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2))       
                    } else { //Case of first step
                        allSteps[0] =  fullStep;  
                        $.Storage.set('lessonStepsValues',JSON.stringify(allSteps, null, 2))   
                    }
                        
                    var pressed = $(this).attr('id');
                    $(this).css('background-color' , '#AAA');
                    $.Storage.set('active-step' , pressed);
                    $.Storage.set('active-step-num' , pressed.substring(11));
                    populateInputsWithCurrentStep('lessonStepsValues');
                    populateInputsWithCurrentStep('lessonStepsValuesTranslate');   
            
                });
                
                $('#btnDeleteLesson').click(function() {
                    //removelesson();
                    //need to remove from DB
                    jConfirm('Are you sure you want to delete the whole lesson '  , 'Confirmation Dialog', function(r) {
                        jAlert('Your lessson has been deleted' + r, 'confirm delete');
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
                                    alert('successfully deleted');
                                    window.location.replace(myUrl[0]);
                                },
                                error : function(XMLHttpRequest, textStatus, errorThrown) {
                                    alert('en error occured');
                                }
                            });
                        }
                    }); 
                });     
                
                $('#btnSaveLessonTranslate').click(function() {           
                    window.saveLessonData(true);
                });
                $('#btnSaveLesson').click(function() {           
                    window.saveLessonData(false);
                });
                $('#btnDel').attr('disabled','disabled');
            });