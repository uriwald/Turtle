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
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    $show = false ;
    session_start();
    $permissionNum            = 1;
    if (isset ($_SESSION['permision']))
        $permissionNum            =   $_SESSION['permision'] ;
    //echo $permissionNum;
    
    $permForEditLesson        = array(1,100);
    $permTraChinese           = array(1,2);
    $permTraSpanish           = array(1,2);
    $permTraGerman            = array(1,103);
    $permTraRussain           = array(1,107);
    $permTraArb               = array(1,108);
    $permTraThai              = array(1,109);
    $permAprvLesson           = array(1); 
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
    //$show = true ;

    if ($show)
    {

        $locale = "en_US"; // Setting default
        $localeGetVar = 'locale';
        if (isset($_GET[$localeGetVar]))
            $locale = $_GET[$localeGetVar];
        cssUtils::loadcss($locale, "./files/css/lessons");
        echo "<div> <span class='title'> <b> Lessons </b> 
                <a href='".$rootDir ."lessons.php'> <span class='lessonh'> Go to lessons page </span> </a>
             </div>";
        echo "<div> <span class='title'> <b> News </b>
                <a href='".$rootDir ."files/turtleNews/insertNewsItem.php'> <span class='lessonh'> Insert News Item </span> </a>
                <a href='".$rootDir ."files/turtleNews/newsTrans.php'> <span class='lessonh'> News Translation</span> </a>
                <a href='".$rootDir ."files/turtleNews/news.php'> <span class='lessonh'> News management </span> </a>
             </div>";
        echo "<div> <span class='title'> <b> String Translation </b>
                <a href='".$rootDir ."files/translation/strings/showtranslationstr.php'> <span class='lessonh'> Show translated strings </span> </a>
                <a href='".$rootDir ."files/translation/strings/insertString.php'> <span class='lessonh'> Add string </span> </a>
             </div>";
        echo "<div> <span class='title'> <b> Lesson Status</b>
                <a href='".$rootDir ."files/translation/lesson/insertLessonInfo.php'> <span class='lessonh'> Insert new lesson </span> </a>
                <a href='".$rootDir ."files/translation/lesson/LessonsStatus.php'> <span class='lessonh'> Edit lesson Status </span> </a>
                <a href='".$rootDir ."files/translation/lesson/lessonsTransReportPage.php'> <span class='lessonh'> Lessons report page </span> </a>
             </div>";
        echo "<div> <span class='title'> <b> Super User </b>
                <a href='".$rootDir ."files/institute/addInstitute.php'> <span class='lessonh'> Add institute</span> </a>
              </div>";
        
    }
    else
    {
        echo " User is not register ";
    }
               
?>
