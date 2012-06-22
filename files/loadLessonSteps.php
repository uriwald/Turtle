<?php
    require_once ("lessonsUtil.php");
    if (isset($_GET['lesson'])) {
        $m = new Mongo();
        $db = $m->turtleTestDb;
        $lessons = $db->lessons;
        $localePrefix = "locale_";
        
        $languageGet = "l";
        $locale = $_GET[$languageGet];
        $lu = new lessonsUtil($locale, "locale_", $lessons, $_GET['lesson']);
        $theObjId = new MongoId($_GET['lesson']);
        $cursor = $lessons->findOne(array("_id" => $theObjId));
        $localSteps = $lu->getStepsByLocale($localePrefix . $_GET[$languageGet]);
        $lessonFinalTitle = $lu->getTitleByLocale($localePrefix . $_GET[$languageGet]);
        //return $localSteps;
        foreach ($localSteps as $step)
        {
       //     echo json_encode($step);
        }
        //TOOD return title
        echo json_encode($localSteps);
        
    }
    return null;
?> 
