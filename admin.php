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
    require_once("files/utils/userUtil.php");
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
            if ($_SESSION['username'] == "admin")
                $show = true ;
    }

    /*
    * To change this template, choose Tools | Templates
    * and open the template in the editor.
    */
    //$show = true ;

    if ($show)
    {
        $num_of_users =   userUtil::get_num_of_varified_users();
        $locale = "en_US"; // Setting default
        $locale_get = 'locale';
        if (isset($_GET[$locale_get]))
            $locale = $_GET[$locale_get];
        cssUtils::loadcss($locale, "./files/css/lessons");
        echo "<div> <span class='title'> <b> Lessons </b> 
                <a href='".$root_dir ."lessons.php'> <span class='lessonh'> Go to lessons page </span> </a>
             </div>";
        echo "<div> <span class='title'> <b> News </b>
                <a href='".$root_dir ."files/turtleNews/insertNewsItem.php'> <span class='lessonh'> Insert News Item </span> </a>
                <a href='".$root_dir ."files/turtleNews/newsTrans.php'> <span class='lessonh'> News Translation</span> </a>
                <a href='".$root_dir ."files/turtleNews/news.php'> <span class='lessonh'> News management </span> </a>
             </div>";
        echo "<div> <span class='title'> <b> String Translation </b>
                <a href='".$root_dir ."files/translation/strings/showtranslationstr.php'> <span class='lessonh'> Show translated strings </span> </a>
                <a href='".$root_dir ."files/translation/strings/insertString.php'> <span class='lessonh'> Add string </span> </a>
             </div>";
        echo "<div> <span class='title'> <b> Lesson Status</b>
                <a href='".$root_dir ."files/translation/lesson/insertLessonInfo.php'> <span class='lessonh'> Insert new lesson </span> </a>
                <a href='".$root_dir ."files/translation/lesson/LessonsStatus.php'> <span class='lessonh'> Edit lesson Status </span> </a>
                <a href='".$root_dir ."files/translation/lesson/lessonsTransReportPage.php'> <span class='lessonh'> Lessons report page </span> </a>
             </div>";
        echo "<div> <span class='title'> <b> User programs</b>
                <a href='".$root_dir ."files/userPrograms/userPrograms.php'> <span class='lessonh'> Edit programs </span> </a>
             </div>";

        echo "<div> <span class='title'> <b> Super User </b>
                <a href='".$root_dir ."files/institute/addInstitute.php'> <span class='lessonh'> Add institute</span> </a>
              </div>";
        echo "<div> <span class='title'> <b> FAQ</b>
                <a href='".$root_dir ."files/faq/faqInsertItem.php'> <span class='lessonh'> Add FAQ item</span> </a>
                <a href='".$root_dir ."files/faq/faqReportPage.php'> <span class='lessonh'> See and edit FACS</span> </a>
            </div>";
        
        echo "<div> <span class='title'> <b> Num of users</b> " . $num_of_users ."
        </div>";
        
    }
    else
    {
        echo " User is not register ";
    }
               
?>
