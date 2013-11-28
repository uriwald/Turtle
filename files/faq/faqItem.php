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
    require_once('../utils/topbarUtil.php');
    require_once("../utils/includeCssAndJsFiles.php"); 
?>
<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>"> 
    <head>
        <link rel='stylesheet' href='../../files/css/faq.css' type='text/css' media='all'/>
        
    </head>

<body>
<?php
        topbarUtil::printTopBar("index");
        //1 . should get the faq num item
        $faqItemnumber    =   "24987338";
        if (isset( $_GET['faqItem']))
        {
            //echo $_GET['faqItem'];
            $faqItemnumber =   $_GET['faqItem'];
        }
        //2 . should connect the faq db
        $m                  = new Mongo();
        $db                 = $m->$dbName;
        $dbLessonCollection = "faq";
        $faqs               = $db->$dbLessonCollection;
        
        //3 . If faq was found than 
        $faqItem = $faqs->findOne(array("id" => $faqItemnumber));
        
        //Type question or answer
        //If no item will use default
        function printfaqItem($faqItem , $type){
            $lcl = $GLOBALS['locale'];
            if ($lcl != "en_US")
            {
                  if ($faqItem[$type][$lcl] == "")
                      echo $faqItem[$type]["en_US"];
                  else
                      echo $faqItem[$type][$lcl];
            }
            else { // Locale en_US
                echo $faqItem[$type][$lcl];
            }
                
        }
        if ($faqItem != null)
            // Load it into text
            // Provide the possibility to change edited lessons
        {
        ?>
    <div id="faq-main">
        <div id="faq-content" class="span12">
            <div id="faq-title">
                <h2> <?php printfaqItem($faqItem , "question") ;?> </h2>
            </div>
            <div id="faq-answer">
                 <p> <?php printfaqItem($faqItem , "answer") ;?> </p>
            </div>
            <div id="faqFooter">
                <a href='<?php echo $rootDir;?>faq.php'> Back to FAQ page </a>
            </div>
        </div> <!-- End faq content -->

    </div>
            <?php
        }
        ?>
</body>