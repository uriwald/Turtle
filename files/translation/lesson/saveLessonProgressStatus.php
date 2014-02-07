<?php

    $pru        = $_POST['progress_ru'];
    $pzh        = $_POST['progress_zh'];
    $pes        = $_POST['progress_es'];
    $phe        = $_POST['progress_he'];
    $pde        = $_POST['progress_de'];
    $ppt        = $_POST['progress_pt'];
    $ppl        = $_POST['progress_pl'];
    $pnl        = $_POST['progress_nl'];
    $pfi        = $_POST['progress_fi'];
    
    $fru        = $_POST['finish_ru'];
    $fzh        = $_POST['finish_zh'];
    $fes        = $_POST['finish_es'];
    $fhe        = $_POST['finish_he'];
    $fde        = $_POST['finish_de'];
    $fpt        = $_POST['finish_pt'];
    $fpl        = $_POST['finish_pl'];
    $fnl        = $_POST['finish_nl'];
    $ffi        = $_POST['finish_fi'];
    
    $precedence = $_POST['precedence'];
   
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
        $return["obj"]          = $lessonExist;
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
            $progress['locale_de_DE'] = $pde;
            $progress['locale_pt_BR'] = $ppt;
            $progress['locale_pl_PL'] = $ppl;
            $progress['locale_fi_FI'] = $pfi;
            $progress['locale_nl_NL'] = $pnl;

            
            $completed['locale_zh_CN'] = $fzh;
            $completed['locale_es_AR'] = $fes;
            $completed['locale_ru_RU'] = $fru;
            $completed['locale_he_IL'] = $fhe;
            $completed['locale_de_DE'] = $fde;
            $completed['locale_pt_BR'] = $fpt; 
            $completed['locale_pl_PL'] = $fpl; 
            $completed['locale_fi_FI'] = $ffi;
            $completed['locale_nl_NL'] = $fnl;

            $result     =   $strcol->update($lessonExist, array("title" => $title , "comments" => $comments , "lesson_id" => $lessonid ,
                                                                "in_progress" => $progress ,"completed" => $completed , "precedence" => $precedence ));
            
           
          
         }
        
         
    }
     echo json_encode($return); 
     
    
?>