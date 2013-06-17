<?php

    $return["nothi"]        = "nothing";
   
    $headline               = $_POST['headline'];
    $headline_translate     = $_POST['headline_translate'];
    $context                = $_POST['context'];
    $context_translate      = $_POST['context_translate'];
    $locale                 = $_POST['locale'];
    $id                     = $_POST['id'];
    
    $flag = true ;
    
    if ($flag)
    {

        $m = new Mongo();
        $db = $m->turtleTestDb;
        $strcol = $db->news;
        
        $newsQuery              = array('itemid' => $id);
        $newsItem               = $strcol->findOne($newsQuery);
        $resultcount            = $strcol->count($newsQuery);
        //Case we need to add a new record to db
        
        if (!$resultcount > 0 ) 
        { 
            $return["error"] = "News Item wasn't found";
        } 
        else //Updating existing user
        {
            
            $headTranslate             =   $newsItem['headline_translate'];
            $contextTranslate          =   $newsItem['context_translate'];
            $headTranslate[$locale]    = $headline_translate;
            $contextTranslate[$locale] = $context_translate;
            $return["info"] = "Locale " . $locale . " was affected";
            //Unchanged Items
            $date       = $newsItem['date'];
            $approve    = $newsItem['approve'];
            

            $result     =   $strcol->update($newsItem, array("headline" => $headline , "headline_translate" => $headTranslate ,
                "context" => $context , "context_translate" => $contextTranslate ,
                "approve" => $approve , "date" => $date , "itemid" => $id ));
            
            
        }
        
        echo json_encode($return);  
    }
    

    
?>