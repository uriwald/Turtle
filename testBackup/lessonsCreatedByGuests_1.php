<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel='stylesheet' href='./files/bootstrap/css/bootstrap.css' type='text/css' media='all'/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script  type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
        <script  type="text/javascript" src="alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <script type="application/javascript" src="files/js/lesson.js"></script> <!-- lessonFunctions -->   
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
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    ?>
     <script type='text/javascript'>
            $.Storage.remove("createLessonLocal");
     </script>
     <?php
    $show = false ;
    session_start();
    if (!isset( $_SESSION['user']) || $_SESSION['user'] != "admin")
                session_unset();
    if (isset ($_SESSION['permision']))
        $permission_num            =   $_SESSION['permision'] ;
    else
    $permission_num            = 1 ;
    $permission_for_edit_lesson        = array(1,100);
    $permmision_translate_chinese           = array(2);
    $permission_translte_spanish           = array(2);
    $permission_translte_german            = array(103);
    $permission_translte_russain           = array(107);
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
    if (isset($_SESSION['user']))
    {
            echo "Hello ";
            echo $_SESSION['user'];
            if ($_SESSION['user'] == "translator" || $_SESSION['user'] == "admin" || $_SESSION['user'] == "eneditor" ||
                    $_SESSION['user'] == "gereditor" || $_SESSION['user'] == "rueditor")
                $show = true ;
    }
    /*
    * To change this template, choose Tools | Templates
    * and open the template in the editor.
    */

    //if ($show)
    //{

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
        $lessons = $db->lessons_created_by_guest;

        $lessonTitle = "title";
        $lessonSteps = "steps";


        // find everything in the collection
        $userQuery       = array('username' => "Unknown");
        $cursor     = $lessons->find($userQuery);
        //$cursor = $lessons->find();
        $cursor->sort(array('precedence' => 1));

        echo "<div> <span class='title'> Edit one of the following lessons </div>";
        foreach ($cursor as $lessonStructure) {
            foreach($lessonStructure['steps'][1] as $key => $val) {
                $locale =   substr($key, -5);
            }
            $finalLocale =  $localePrefix . $locale   ;
            $title                          =            print_r($lessonStructure[$lessonTitle]);//[$finalLocale] ;
            $objID                          =            $lessonStructure['_id'];
            $pendingStatus                  =            $lessonStructure['pending'];


           // print_r( $lessonStructure['steps'][1]);
            //$translateToLanguage            
            echo "Lesson name is <b>" . $title . "</b> " ;
            $editLessonHref    = "<a href='lesson.php?lesson=$objID&l=$locale' > <span class='lessonh'> Edit Lesson <b>" . $title . " </b></span> </a>";
            $translateLessonToChinese   = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=zh_CN' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to chinenese </span> </a>";
            $translateLessonToSpanish   = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=es_AR' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to Spanish </span> </a>";
            $translateLessonToGerman    = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=de_DE' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to German </span> </a>";
            $translateLessonToRussain   = "<a href='translating.php?lesson=$objID&lfrom=he_IL&ltranslate=ru_RU' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to Russain </span> </a>";

            
            $approveLesson ;
            if ($pendingStatus)
            {
                echo "Lesson is currently unapproved";
                $approveLesson = "<a href='approveLesson.php?lesson=$objID&pending=false&col=lessons_created_by_guest' > <span class='lessonh'> Approve Lesson (lesson will appear in main page) </span> </a>";
            }
            else
            {
                echo "Lesson is curretnly approved";
                $approveLesson = "<a href='approveLesson.php?lesson=$objID&pending=true&col=lessons_created_by_guest' > <span class='lessonh'> Unapprove (lesson won't appear in main page) </span> </a>";
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
            
            
            if (in_array($permission_num , $permission_approve_lesson)) 
                    echo $approveLesson;
             echo   "</div>";   
            echo "</br>"; 
        } 
        ?>
        <button id ="btnCreateNewLesson" class="btn btn-link" type="button">Create a new lesson using the following language</button>
        <select id="selectedLanguage">
            <option value="en_US">  English   </option>
            <option value="he_IL">  עברית     </option>
            <option value="zh_CN">  中文       </option>
            <option value="es_AR">  Español   </option>
        </select>
         
<?php
        //echo "<div><a href='lesson.php' > <span> Create a new lesson  </span> </a></div>" ;
        //echo "<span class='footer'>$footer</span>";

?>
