<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link rel='stylesheet' href='/files/css/footer.css' type='text/css' media='all'/>  
         <script type="application/javascript"> <!-- Google Analytics Tracking -->

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-26588530-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
</html>
<?php
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    $show = false ;
    $permission_num            = 1;
    if (isset ($_SESSION['permision']))
        $permission_num            =   $_SESSION['permision'] ;
    //echo $permissionNum;
    
    $permission_for_edit_lesson        = array(1,100);
    $permmision_translate_chinese           = array(1,2);
    $permission_translte_spanish           = array(1,2);
    $permission_translte_german            = array(1,103);
    $permission_translte_russain           = array(1,107);
    $permission_translte_arbic               = array(1,108);
    $permission_translte_thai              = array(1,109);
    $permission_approve_lesson           = array(1); 
    //echo "PermissionNumberIs".$permissionNum;

    /*
    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] == true)
    {
        var_dump($_SESSION);
        $show = true ;
    }
    * 
    */
    if (isset($_SESSION['username']))
    {
            echo "Hello ";
            echo $_SESSION['username'];
            if ($_SESSION['username'] == "translator" || $_SESSION['username'] == "admin" || $_SESSION['username'] == "eneditor" ||
                    $_SESSION['username'] == "gereditor" || $_SESSION['username'] == "rueditor" || $_SESSION['username'] == "areditor"
                    || $_SESSION['username'] == "theditor")
                $show = true ;
    }

    /*
    * To change this template, choose Tools | Templates
    * and open the template in the editor.
    */

    if ($show)
    {

        $locale = "en_US"; // Setting default
        $localePrefix = "locale_";
        $locale_get = 'locale';
        if (isset($_GET[$locale_get]))
            $locale = $_GET[$locale_get];

        $finalLocale =  $localePrefix . $locale   ; 
        //echo $finalLocale;


        cssUtils::loadcss($locale, "./files/css/lessons");

        $m = new Mongo();

        // select a database
        $db = $m->$db_name;

        // select a collection (analogous to a relational database's table)
        $lessons = $db->$db_lesson_collection;

        $lessonTitle = "title";
        $lessonSteps = "steps";


        // find everything in the collection
        $cursor = $lessons->find();
        $cursor->sort(array('precedence' => 1));

        echo "<div> <span class='title'> Edit one of the following lessons </div>";
        foreach ($cursor as $lessonStructure) {
            $title                          =            $lessonStructure[$lessonTitle][$finalLocale] ;
            $objID                          =            $lessonStructure['_id'];
            $pendingStatus                  =    $lessonStructure['pending'];
            //$translateToLanguage            
            echo "Lesson name is <b>" . $title . "</b> " ;
            $editLessonHref    = "<a href='lesson.php?lesson=$objID&lfrom=$locale' > <span class='lessonh'> Edit Lesson <b>" . $title . " </b></span> </a>";
            $translateLessonToChinese   = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=zh_CN' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to chinenese </span> </a>";
            $translateLessonToSpanish   = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=es_AR' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to Spanish </span> </a>";
            $translateLessonToGerman    = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=de_DE' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to German </span> </a>";
            $translateLessonToRussain   = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=ru_RU' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to Russain </span> </a>";
            $translateLessonToArb       = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=ar_SY' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to Arabic </span> </a>";
            $translateLessonToThai      = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=th_TH' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to Thai </span> </a>";
            
            $approveLesson ;
            if ($pendingStatus)
            {
                echo "Lesson is currently unapproved";
                $approveLesson = "<a href='approveLesson.php?lesson=$objID&pending=false' > <span class='lessonh'> Approve Lesson (lesson will appear in main page) </span> </a>";
            }
            else
            {
                echo "Lesson is curretnly approved";
                $approveLesson = "<a href='approveLesson.php?lesson=$objID&pending=true' > <span class='lessonh'> Unapprove (lesson won't appear in main page) </span> </a>";
            }
            echo "<div style='display:inline;height:60px;'>";     
            if (in_array($permission_num , $permission_for_edit_lesson)) 
            {
                    echo $editLessonHref;
            }
            if (in_array($permission_num , $permmision_translate_chinese )) 
                    echo $translateLessonToChinese;
            if (in_array($permission_num , $permission_translte_spanish)) 
                    echo $translateLessonToSpanish;
            if (in_array($permission_num , $permission_translte_german)) 
                    echo $translateLessonToGerman;
            if (in_array($permission_num , $permission_translte_russain)) 
                    echo $translateLessonToRussain;
            if (in_array($permission_num , $permission_translte_arbic)) 
                    echo $translateLessonToArb;           
            if (in_array($permission_num , $permission_translte_thai)) 
                    echo $translateLessonToThai;  
            
            if (in_array($permission_num , $permission_approve_lesson)) 
                    echo $approveLesson;
             echo   "</div>";   
            echo "</br>"; 
        } 

        echo "<div><a href='lesson.php' > <span> Create a new lesson  </span> </a></div>" ;

        echo "<span class='footer'>$footer</span>";
    }
    else
    {
        echo " User is not register ";
    }
?>
