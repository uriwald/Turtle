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
    includeCssAndJsFiles::includePageFiles("faqadmin");   
?>
<!-- <link rel='stylesheet' href='../../files/css/faq.css' type='text/css' media='all'/> -->
<html>

    <body>      
        <?php
        //1 . should get the faq num item
        $faqItemnumber    =   "24987338";
        if (isset( $_GET['faqItem']))
            $faqItemnumber =   $_GET['faqItem'];
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
                <div class="faqItem">
                    <lable class="lessonHeader"> Faq question: </lable> 
                    <input type="text" name="faqQuestion"  id="faqQuestion" class="lessonInput" placeholder="Faq question" 
                       value ="<?php echo $faqItem['question'][$locale] ;?>"/>
                </div>
                <div class="faqItem">
                    <lable class="lessonHeader"> Faq answer: </lable> 
                    <textarea type="text" name="faqAnswer"  id="faqAnswer" class="lessonInput" placeholder="Faq question" col="4" > <?php echo $faqItem['answer'][$locale] ;?> </textarea> </br>
                  <!--  <input type="text" name="lessonTitle"  id="faqAnswer" class="lessonInput" placeholder="Faq question" 
                       value ="<?php echo $faqItem['answer'][$locale] ;?>"/> -->
                </div>
                <div class="faqItem">
                    <lable class="lessonHeader"> Faq Type: </lable> 
                    <input type="text" name="faqType"  id="faqType" class="lessonInput" placeholder="Faq question" 
                       value ="<?php echo $faqItem['type'];?>"/>
                </div>
                <div class="faqItem">
                    <lable class="lessonHeader"> Precedence </lable> 
                    <input type="text" name="faqPrecedence"  id="faqPrecedence" class="lessonInput" placeholder="Faq question" 
                       value ="<?php echo $faqItem['precedence'];?>"/>
                </div>
                <div id="actionbtn">
                    <a class='btn' id='btnSaveLesson'>  Save Faq Itme </a>
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
              var type          = $("#faqType").val();
              var question      = $("#faqQuestion").val();
              var answer        = $("#faqAnswer").val();
              var precedence    = $("#faqPrecedence").val();
              var isTrnaslate   = false;
              var locale        = "en_US";
              
              
              $.ajax({
                        type : 'POST',
                        url : '<?php echo $rootDir?>files/faq/faqSaveEditedItem.php', 
                        dataType : 'json',
                        data: {
                            faqQ   :   question,
                            faqA   :   answer,
                            type   :   type,
                            id     :   faqItemNumber,
                            precedence : precedence ,
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
                    
                 