<?php
    require_once("../environment.php");
    require_once ("utils/lessonsUtil.php");
    if (isset($_GET['lesson'])) {
        $m = new Mongo();
        $db = $m->$db_name;
        if (isset($_GET['col']))
            $db_lesson_collection = $_GET['col'];
        $lessons = $db->$db_lesson_collection;
        $localePrefix = "locale_";
        
        $languageGet = "l";
        $locale = $_GET[$languageGet];
        $lu = new lessonsUtil($locale, "locale_", $lessons, $_GET['lesson']);
        $the_object_id = new MongoId($_GET['lesson']);
        $cursor = $lessons->findOne(array("_id" => $the_object_id));
        $localSteps = $lu->get_steps_by_locale($localePrefix . $_GET[$languageGet]);
        $localtitle = $lu->get_title_by_locale($localePrefix . $_GET[$languageGet]);
        //return $localSteps;
       // foreach ($localSteps as $step)
        //{
       //     echo json_encode($step);
        //}
        //TOOD return title
        
        $return['title'] = $localtitle;
        $return['steps'] = $localSteps;
        echo json_encode($return);        
    }
    //return null;
?> 
