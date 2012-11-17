<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    require_once("environment.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    $show = false ;
    session_start();
    $permissionNum            =   $_SESSION['permision'] ;
    $permForEditLesson        = array(1,100);
    $permTraChinese           = array(1,2);
    $permTraSpanish           = array(1,2);
    $permAprvLesson           = array(1);
    echo "PermissionNumberIs".$permissionNum;

    /*
    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] == true)
    {
        var_dump($_SESSION);
        $show = true ;
    }
    * 
    */
    if (isset($_SESSION['user']))
    {
            echo "Hello ";
            echo $_SESSION['user'];
            if ($_SESSION['user'] == "translator" || $_SESSION['user'] == "admin" || $_SESSION['user'] == "eneditor")
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
        $localeGetVar = 'locale';
        if (isset($_GET[$localeGetVar]))
            $locale = $_GET[$localeGetVar];

        $finalLocale =  $localePrefix . $locale   ; 
        //echo $finalLocale;


        cssUtils::loadcss($locale, "./files/css/lessons");

        $m = new Mongo();

        // select a database
        $db = $m->$dbName;

        // select a collection (analogous to a relational database's table)
        $lessons = $db->$dbLessonCollection;

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
            if (in_array($permissionNum , $permForEditLesson)) 
            {
                    echo $editLessonHref;
            }
            if (in_array($permissionNum , $permTraChinese )) 
                    echo $translateLessonToChinese;
            if (in_array($permissionNum , $permTraSpanish)) 
                    echo $translateLessonToSpanish;
            if (in_array($permissionNum , $permAprvLesson)) 
                    echo $approveLesson;
             echo   "</div>";   
            echo "</br>"; 
        } 

        echo "<div><a href='lesson.php' > <span> Create a new lesson  </span> </a></div>" ;

        echo "<span class='footer'>$footer</span>";
    }
?>
