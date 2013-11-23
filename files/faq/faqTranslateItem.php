<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php 
    if (session_id() == '')
        session_start();

    require_once("../../environment.php");
    require_once("../../localization.php"); 
    require_once("../utils/collectionUtil.php");
    require_once("../utils/includeCssAndJsFiles.php"); 
?>
<link rel='stylesheet' href='../../files/css/faq.css' type='text/css' media='all'/>
<html>

    <body>      
        <?php
        //1 . should get the faq num item
        $faqItemnumber    =   "24987338"; 
        if (isset( $_GET['faqItem']))
            $faqItemnumber =   $_GET['faqItem'];
        $locale = "zh_CN";
        if (isset( $_GET['l']))
            $locale =   $_GET['l'];
        //2 . should connect the faq db
        $m                  = new Mongo();
        $db                 = $m->$dbName;
        $dbLessonCollection = "faq";
        $faqs               = $db->$dbLessonCollection;
        //3 . If faq was found than 
        $faqItem = $faqs->findOne(array("id" => $faqItemnumber));
        if ($faqItem != null)
            // Load it into text
            // Provide the possibility to change edited lessons
        {
        ?>
            <div class="leftLessonElem translationdiv">
                <div>
                <lable class="faqHeader"> Faq question: </lable>
                    <input type="text" name="lessonTitle"  id="faqQuestion" class="faqInput" placeholder="Faq question" 
                       value ="<?php echo $faqItem['question']["en_US"] ;?>" disabled/>
                
                </div>
                <div>
                <lable class="faqHeader"> Faq answer: </lable> 
                <input type="text" name="lessonTitle"  id="faqAnswer" class="faqInput" placeholder="Faq question" 
                       value ="<?php echo $faqItem['answer']["en_US"] ;?> " disabled/>
                </div>
                 
            </div>  
            <div class="rightLessonElem rightLessonTitleElem">
                <div>
                    <lable class="faqHeader"> Faq question: </lable> 
                    <input type="text" name="lessonTitle"  id="faqQuestiontranslated" class="faqInput" placeholder="Faq question"/>
                </div>
                <div>
                    <lable class="faqHeader"> Faq answer: </lable> 
                    <input type="text" name="lessonTitle"  id="faqAnswertranslated" class="faqInput" placeholder="Faq question"/>
                </div>
            </div>    
            <div id="actionbtn">
                <a class='btn' id='btnSaveLesson'>  Save </a>
            </div>
        <?php
        }
        //4 Else
        // Show a message Faq item not found
        else
        {
            ?>

        <?php 
        }

        ?>
        </body>
                <script> 
        $("#btnSaveLesson").click(function() {                                
              var faqItemNumber = "<?php echo $faqItemnumber;?>";
              var question      = $("#faqQuestiontranslated").val();
              var answer        = $("#faqAnswertranslated").val();
              var isTrnaslate   = true;
              var locale        = "<?php echo $locale;?>";
              
              
              $.ajax({
                        type : 'POST',
                        url : '/files/faq/faqSaveEditedItem.php', 
                        dataType : 'json',
                        data: {
                            faqQ   :   question,
                            faqA   :   answer,
                            id     :   faqItemNumber,
                            isTrnaslate : isTrnaslate ,
                            locale :   locale
                        },
                        success: function(data) { 
                            var rdata;
                        } ,
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert('en error occured');
                        }
                });
        });  

    </script>
</html>
                    
                 