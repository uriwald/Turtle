<?php
    $relPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";
    $root       =   $_SERVER['DOCUMENT_ROOT'];
    if(!isset($_SESSION)){session_start();}
    $username   =   "Unknown";
    if (isset ($_SESSION['username']))
        $username = $_SESSION['username'];
    require_once 'files/utils/userUtil.php';
    //echo $root ;
    //require_once( $root ."/files/footer.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Lessons by guests</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <script src="<?php echo $relPath . 'scripts/jquery.min.js' ?>"></script>
    <script src="<?php echo  './../css/footer.css' ?>"></script>
    
    <script type='text/javascript'>
    $(document).ready(function(){
      $('#topbar').dropdown();
    });
    </script>
    
    <!-- Le styles -->
    <link href="<?php echo $relPath . 'styles/bootstrap.min.css' ?>" rel="stylesheet">
    <link rel='stylesheet' href='../css/footer.css' type='text/css' media='all'/> 
    <style type="text/css">
      body {
        padding-top: 60px;
      }
      .sidebar.well.span4{
        width: 180px;
      }
      .ads tbody tr td{
        cursor:pointer !important;
      }
      .highlight td{
        font-weight:bold;
      }
      td.mini-thumbnail img{
        max-height:50px;
        max-width:100px;
      }
      td.mini-thumbnail{
        text-align:center;
      }
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo $relPath . 'images/favicon.ico' ?>">
    <link rel="apple-touch-icon" href="<?php echo $relPath . 'images/apple-touch-icon.png' ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $relPath . 'images/apple-touch-icon-72x72.png' ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $relPath . 'images/apple-touch-icon-114x114.png' ?>">
  </head>

  <body>

    <div class="topbar">
      <div class="fill">
        <div class="container span18">
          <a class="brand" href="index.html">Project X</a>
          <ul class="nav">
            <li><a href="index.html">Home</a></li>
            <li class="active"><a href="index.html">Sample</a></li>
          </ul>
          
          <form class="pull-left" action="">
            <input type="text" placeholder="Search">
              <button class="btn" type="submit">Go</button>
          </form>        
          <p class="pull-right">Logged in as <a href="#">              
                 <?php
                    echo $username;
                 ?>
              </a></p>
        </div>
      </div>
    </div> <!-- End of topbar -->

    <div class="container span18">
      <div class='cleaner_h40'></div>
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
        /*
        echo "<div> <span class='title'> Edit one of the following lessons </div>";
        foreach ($cursor as $lessonStructure) {
            //foreach($lessonStructure['steps'][1] as $key => $val) {
            //    $locale =   substr($key, -5);
            //}
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
            if (in_array($permissionNum , $permForEditLesson)) 
            {
                    echo $editLessonHref;
            }
            if (in_array($permissionNum , $permTraChinese )) 
                    echo $translateLessonToChinese;
            if (in_array($permissionNum , $permTraSpanish)) 
                    echo $translateLessonToSpanish;
            if (in_array($permissionNum , $permTraGerman)) 
                    echo $translateLessonToGerman;
            if (in_array($permissionNum , $permTraRussain)) 
                    echo $translateLessonToRussain;
            
            
            if (in_array($permissionNum , $permAprvLesson)) 
                    echo $approveLesson;
             echo   "</div>";   
            echo "</br>"; 
        } 
         * 
         */
        ?>    
      <div class='row'>        
        <div class='span14'>
          <h2>User Lessons</h2>
          <table class='zebra-striped ads'>
              <thead>
                  <tr>
                      <th class='span2'></th>
                      <th class='span4'>Title</th>
                      <th class='span4'>Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                        $userLessons    =   userUtil::show_user_lessons($username);
                        foreach ($userLessons as $lesson)
                        {
                            $finalLocale =  $localePrefix . $locale   ;
                            $title                          =            print_r($lesson[$lessonTitle]);//[$finalLocale] ;
                            $objID                          =            $lesson['_id'];
                            $pendingStatus                  =            $lesson['pending'];


                        // print_r( $lessonStructure['steps'][1]);
                            //$translateToLanguage            
                            echo "Lesson name is <b>" . $title . "</b> " ;
                            $editLessonHref    = "<a href='lesson.php?lesson=$objID&l=$locale' > <span class='lessonh'> Edit Lesson <b>" . $title . " </b></span> </a>";
                            $translateLessonToChinese   = "<a class='btn small info' href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=zh_CN'>To Chinese</a>";
                            $translateLessonToSpanish   = "<a class='btn small info' href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=es_AR'>To Spanish</a>";
                            $translateLessonToGerman    = "<a class='btn small info' href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=de_DE'>To German</a>";
                            $translateLessonToRussain   = "<a class='btn small info' href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=ru_RU'>To Russain</a>";
                            /*
                            $translateLessonToChinese   = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=zh_CN' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to chinenese </span> </a>";
                            $translateLessonToSpanish   = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=es_AR' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to Spanish </span> </a>";
                            $translateLessonToGerman    = "<a href='translating.php?lesson=$objID&lfrom=$locale&ltranslate=de_DE' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to German </span> </a>";
                            $translateLessonToRussain   = "<a href='translating.php?lesson=$objID&lfrom=he_IL&ltranslate=ru_RU' > <span class='lessonh'> Translate Lesson <b>" . $title . " </b> to Russain </span> </a>";                          
                            
                             * 
                             */
                  ?>
                  <tr>
                      <td class='mini-thumbnail'></td>
                      <td><?php echo $lesson['title']['locale_en_US'] ?></td>
                      <td>
                        <div class='btn small success disabled'>Renewed</div>
                        <a class='btn small info' href='lesson.php?lesson=<?php echo $lesson['_id']; ?> '>Edit</a>
                        <?php
                                //if (in_array($permissionNum , $permTraChinese )) 
                                        echo $translateLessonToChinese;
                                if (in_array($permission_num , $permission_translte_spanish)) 
                                        echo $translateLessonToSpanish;
                                if (in_array($permission_num , $permission_translte_german)) 
                                        echo $translateLessonToGerman;
                                if (in_array($permission_num , $permission_translte_russain)) 
                                        echo $translateLessonToRussain;
                        ?>
                        <div class='btn small danger'>Remove</div>
                      </td>
                  </tr>
                  <?php
                        } 
                  ?>
              </tbody>  
          </table>
        </div><!-- end of center content -->
      </div>
      <?php
        if (isset ($footer))
            echo $footer ;
       ?>
      <!-- <footer>
        <p>&copy; Company 2011 <a href='http://www.sherzod.me' target='_blank' title='Professional Web Developer'>Sherzod Kutfiddinov</a></p>
      </footer> -->
    </div>

  </body>
</html>
<?php



?>
