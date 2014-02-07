<?php

    //Handle 2 cases 1 is that Item was translated 
    //Second the item was edited
if (session_id() == '')
    session_start();

require_once ('../../environment.php');
require_once ("../../localization.php");
require_once ('../utils/topbarUtil.php');
require_once("faqSideNav.php");
?>

<html dir="<?php echo $dir ?>" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Report a Problem</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        echo "<link rel='stylesheet' type='text/css' href='" . $root_dir . "files/css/registration.css' /> ";

            require_once("../utils/includeCssAndJsFiles.php"); 
            includeCssAndJsFiles::include_all_page_files("faqadmin"); 
        ?>    
        <!--
        <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/zocial.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='../css/faq.css' type='text/css' media='all'/>
        <script src="<?php echo $root_dir; ?>ajax/libs/jquery/validator/dist/jquery.validate.js" type="text/javascript"></script>
        -->
    </head>
   <?php 
    $collectionType; $collectionName;
    $email              = $_POST['email'];
    if (isset ($_POST['problem']))
    {
        $collectionType = "problem";
        $collectionName = "problemReport";
        $thankMSG       = "Thanks for your problem reporting";
        $linkAction     = "Report another Problem";
        $linkUrl        = $site_path . "/files/faq/faqReportProblem.php" ;
        $problem        = $_POST['problem'];
    }
    else if (isset ($_POST['feature'])){
        $collectionType = "feature";
        $collectionName = "featureSuggest";
        $thankMSG       = "Thanks for suggesting a new feature";
        $linkAction     = "Suggest another feature";
        $linkUrl        = $site_path . "/files/faq/faqSuggestionFeature.php" ;
        $feature        = $_POST['feature'];
    }
    else
    {
        $collectionType = "comment";
        $collectionName = "comments";
        $thankMSG       = "Thanks for your comment ";
        $linkAction     = "Add another comment";
        $linkUrl        = $site_path . "/files/faq/faqComment.php" ;
        $rname              = $_POST['reportername'];
        $subject            = $_POST['subject'];
        $comment            = $_POST['comment'];
    }
    
    $m = new Mongo();
    $db         = $m->turtleTestDb;
    $strcol     = $db->$collectionName;
    $date       =   date('Y-m-d H:i:s');
        
    
     switch ($collectionType) {
                case "problem": 
                      $result     =   $strcol->insert(array("date" => $date , "email" => $email ,
                                                    "problem" => $problem  ));
                    break;
                case "problem": 
                      $result     =   $strcol->insert(array("date" => $date , "email" => $email ,
                                                    "feature" => $feature  ));
                    break;
                case "comment":
                     $result     =   $strcol->insert(array("date" => $date , "reportername" => $rname , "email" => $email ,
                                                    "subject" => $subject ,"content" => $comment ));
                    break;
    }        

?>
    <body>
        <?php
            topbarUtil::print_topbar("faq");
        ?>
    <div id="faq-main">
        <div id="faq-content" class="span12">
            <div id="faq-title">
                <h1> <?php echo $thankMSG ; ?> </h1>
            </div>
            <?php
                if ($collectionType == "comment")
                {
            ?>
            <div id="faq-comment-save-info">
                <p> <?php echo "<b> your subject </b>" .$subject;?></p>
                <p> <?php echo "<b> your comment </b>" .$comment;?></p>
                <p> <?php echo "Has been saved"?></p>
            </div>
            <?php } ?>
            <div class="faq-comment-link">
                 <a href='<?php echo $linkUrl;?>'> <?php echo $linkAction ; ?></a>
            </div>
            <div class="faq-comment-link">
                <a href='<?php echo $site_path;?>faq.php'> Back to FAQ page </a>
            </div>
        </div> <!-- End faq content -->
    </div>
    </body>
</html>