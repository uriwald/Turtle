<?php

    $pru        = $_POST['progress_ru'];
    $pzh        = $_POST['progress_zh'];
    $pes        = $_POST['progress_es'];
    $phe        = $_POST['progress_he'];
    
    $fru        = $_POST['finish_ru'];
    $fzh        = $_POST['finish_zh'];
    $fes        = $_POST['finish_es'];
    $fhe        = $_POST['finish_he'];
   
    $comments   = $_POST['comments'];
    
    $lessonid   = $_POST['lessonId'];

    $return['gg'] = true ;
    $flag = true ;
    if ($flag)
    {

        $m = new Mongo();
        $db = $m->turtleTestDb;
        $strcol = $db->lessons_translate_status;
        
        $strQuery               = array('lesson_id' => $lessonid);
        $resultcount = 1;
        $lessonExist            = $strcol->findOne($strQuery);
        $return["obj"] = $lessonExist;
        $resultcount            = $strcol->count($strQuery);
        //Case we need to add a new record to db
        if (!$resultcount > 0 ) 
        { 
            $return["error"] = "Can't find lesson to update";
        } 
        else //Updating existing user
        {
             
            $progress   =   $lessonExist['in_progress'];
            $completed  =   $lessonExist['completed'];
            $title      =   $lessonExist['title'];
            
            $progress['locale_zh_CN'] = $pzh;
            $progress['locale_es_AR'] = $pes;
            $progress['locale_ru_RU'] = $pru;
            $progress['locale_he_IL'] = $phe;
            
            $completed['locale_zh_CN'] = $fzh;
            $completed['locale_es_AR'] = $fes;
            $completed['locale_ru_RU'] = $fru;
            $completed['locale_he_IL'] = $fhe;

            $result     =   $strcol->update($lessonExist, array("title" => $title , "comments" => $comments , "lesson_id" => $lessonid ,
                                                                "in_progress" => $progress ,"completed" => $completed ));
           
          
         }
        
         
    }
     echo json_encode($return); 
     
    
?>