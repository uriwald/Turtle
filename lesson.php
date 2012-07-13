<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
require_once("files/footer.php");
require_once("files/cssUtils.php");
$show = false ;
session_start();
if (isset($_SESSION['Admin']) && $_SESSION['Admin'] == true)
{
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


    cssUtils::loadcss($locale, "./files/lessons");

    $m = new Mongo();

    // select a database
    $db = $m->turtleTestDb;

    // select a collection (analogous to a relational database's table)
    $lessons = $db->lessons;

    $lessonTitle = "title";
    $lessonSteps = "steps";


    // find everything in the collection
    $cursor = $lessons->find();
    $cursor->sort(array('precedence' => 1));

    echo "<div> <span class='title'> Edit one of the following lessons </div>";
    foreach ($cursor as $lessonStructure) {
        $title         =            $lessonStructure[$lessonTitle][$finalLocale] ;
        $objID         =            $lessonStructure['_id'];
        $pendingStatus =    $lessonStructure['pending'];
        $editLessonHref    = "<a href='lessons.php?lesson=$objID&l=$locale' > <span class='lessonh'> $title </span> </a>";
        $approveLesson ;
        if ($pendingStatus)
        {
            $approveLesson = "<a href='approveLesson.php?lesson=$objID&pending=false' > <span class='lessonh'> Approve Lesson </span> </a>";
        }
        else
        {
            $approveLesson = "<a href='approveLesson.php?lesson=$objID&pending=true' > <span class='lessonh'> Unapprove </span> </a>";
        }
        echo "<div style='display:inline;height:60px;'>$editLessonHref $approveLesson </div>";   
        echo "</br>";
    }

    echo "<div><a href='lessons.php' > <span> Create a new lesson  </span> </a></div>" ;

    echo "<span class='footer'>$footer</span>";
}
?>
