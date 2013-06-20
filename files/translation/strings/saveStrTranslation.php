<?php
    $str        = $_POST['str'];
    $page       = $_POST['page'];
    $context    = $_POST['context'];
    $translated = $_POST['input'];
    $locale     = $_POST['locale'];
    $return["nothi"] = "nothing";
    
    $flag = true ;
    if ($flag)
    {

        $m = new Mongo();
        $db = $m->turtleTestDb;
        $strcol = $db->stringTranslation;
        
        $strQuery               = array('str' => $str);
        $strExist               = $strcol->findOne($strQuery);
        $resultcount            = $strcol->count($strQuery);
        //Case we need to add a new record to db
        if (!$resultcount > 0 ) 
        { 
            $return["error"] = "String to translate wasn't found";
        } 
        else //Updating existing user
        {
            
            $zh         =   $strExist['locale_zh_CN'];
            $es         =   $strExist['locale_es_AR'];
            
            if ($locale == "locale_zh_CN")
            {
              $zh =   $translated;
              $return["info"] = "Locale_zh_CN was affected";
            }
            else if ($locale == "locale_es_AR")
            {
                $es =   $translated;
                $return["info"] = "Locale_es_AR was affected"; 
            }
                         
            $return["zh"] = $zh ; 
            $result     =   $strcol->update($strExist, array("str" => $str , "page" => $page , "context" => $context ,
                                                                "locale_zh_CN" => $zh ,"locale_es_AR" => $es ));
            /*
            */
        }
        
        echo json_encode($return);  
    }
     
     
    
?>