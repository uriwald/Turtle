<?php
    $str              = $_POST['str'];
    $display_ru       = $_POST['display_ru'];
    $display_zh       = $_POST['display_zh'];
    $display_es       = $_POST['display_es'];
    
    $flag = true ;
    $return['data'] = "dsdd";
    if ($flag)
    {
       
    

        $m      = new Mongo();
        $db     = $m->turtleTestDb;
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
            //Original values
            $strTranslate       =   $strExist['translate'];
            $display            =   $strExist['display'];
            $context            =   $strExist['context'];   
            $page               =   $strExist['page']; 
            $str                =   $strExist['str']; 
            
            //Changed values
            $display["ru_RU"]   =   $display_ru;
            $display["zh_CN"]   =   $display_zh;
            $display["es_AR"]   =   $display_es;
            

            
            $result     =   $strcol->update($strExist, array("str" => $str , "page" => $page , "context" => $context ,
                                                                "translate" => $strTranslate ,"display" => $display ));

        }
          /*
        */
        echo json_encode($return);  
    }
     
     
    
?>