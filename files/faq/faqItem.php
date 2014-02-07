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
    includeCssAndJsFiles::include_all_page_files("faqadmin"); 
?>
<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>"> 
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--<link rel='stylesheet' href='../../files/css/faq.css' type='text/css' media='all'/> -->
        
    </head>

<body>
<?php
        topbarUtil::print_topbar("index");
        //1 . should get the faq num item
        $faqItemnumber    =   "24987338";
        if (isset( $_GET['faqItem']))
        {
            //echo $_GET['faqItem'];
            $faqItemnumber =   $_GET['faqItem'];
        }
        //2 . should connect the faq db
        $m                  = new Mongo();
        $db                 = $m->$db_name;
        $db_lesson_collection = "faq";
        $faqs               = $db->$db_lesson_collection;
        
        //3 . If faq was found than 
        $faqItem = $faqs->findOne(array("id" => $faqItemnumber));
        
        //Type question or answer
        //If no item will use default
        function printfaqItem($faqItem , $type){
            global $locale_domain;
            if ($locale_domain != "en_US")
            {
                  if ($faqItem[$type][$locale_domain] == "")
                      echo $faqItem[$type]["en_US"];
                  else
                      echo $faqItem[$type][$locale_domain];
            }
            else { // Locale en_US
                echo $faqItem[$type][$locale_domain];
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
                <a href='<?php echo $root_dir;?>faq.php'> Back to FAQ page </a>
            </div>
        </div> <!-- End faq content -->

    </div>
            <?php
        }
        ?>
</body>