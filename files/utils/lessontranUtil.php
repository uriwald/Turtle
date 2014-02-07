<?php

/*
 * This class will hold helping functinos for 
 * Lesson translation report page
 */
class lessontranUtil {

    public function add_new_locale($locale_name) {
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
            $precedence             =   $lesson['precedence'];
            if (!isset($progress[$locale_name]))
                $progress[$locale_name]  =   "";
            if (!isset($completed[$locale_name]))
                $completed[$locale_name]  =   "";
            $result     =   $strcol->update($lesson, array("title" => $title , "comments" => $comments , "lesson_id" => $lessonId ,
                                                    "in_progress" => $progress ,"completed" => $completed , "precedence"=> $precedence ));

        }
    }

}

?>
