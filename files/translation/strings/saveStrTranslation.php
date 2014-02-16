<?php
    $str        = $_POST['str'];
    $page       = $_POST['page'];
    $context    = $_POST['context'];
    $translationInput = $_POST['input'];
    $locale     = $_POST['locale'];
    $return["nothi"] = "nothing";
    $lastUpdated                =   date('Y-m-d H:i:s');
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
            
            $strTranslate   =   $strExist['translate'];
            $display        =   $strExist['display'];
            $pagecode       =   $strExist['pagecode'];

            $strTranslate[$locale] = $translationInput . " - " . $lastUpdated;
            $return["info"] = $locale ." was affected"; 

            $result     =   $strcol->update($strExist, array("str" => $str , "page" => $page ,"pagecode" => $pagecode , "context" => $context ,
                                                                "translate" => $strTranslate ,"display" => $display ));

        }
        
        echo json_encode($return);  
    }
     
     
    
?>