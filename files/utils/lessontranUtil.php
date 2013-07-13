<?php

/*
 * This class will hold helping functinos for 
 * Lesson translation report page
 */
class lessontranUtil {

    public function addNewLocale($localeName) {
        $m                  = new Mongo();
        $db                 = $m->turtleTestDb;
        $strcol             = $db->lessons_translate_status;
        $lessons            = $strcol->find();
        
        foreach ($lessons as $lesson)
        {
            $progress               =   $lesson['in_progress'];
            $completed              =   $lesson['completed'];
            $title                  =   $lesson['title'];
            $comments               =   $lesson['comments'];
            $lessonId               =   $lesson['lesson_id']; 
            if (!isset($progress[$localeName]))
                $progress[$localeName]  =   "";
            if (!isset($completed[$localeName]))
                $completed[$localeName]  =   "";
            $result     =   $strcol->update($lesson, array("title" => $title , "comments" => $comments , "lesson_id" => $lessonId ,
                                                    "in_progress" => $progress ,"completed" => $completed ));

        }
    }

}

?>
