<?php
    $str        = $_POST['string'];
    $page       = $_POST['page'];
    $context    = $_POST['context'];
    $flag = true ;
    if (strlen($str) > 1 )
    {
        echo "Length is ok <br>" ;
    }
    else {
            echo "Length is bad " ;
            $flag = false ;
    }
    if ($flag)
    {
        echo "Your String is " .$str . " "  . ".<br />";
        echo "Your Page is " .$page . " "  . ".<br />";
        echo "Your Context is " .$context . " "  . ".<br />";
        $m = new Mongo();
        $db = $m->turtleTestDb;
        $strcol = $db->stringTranslation;
        
        $strQuery               = array('str' => $str);
        $strExist               = $strcol->findOne($strQuery);
        $resultcount            = $strcol->count($strQuery);

        //Case we need to add a new record to db
        if (!$resultcount > 0 ) 
        { 
            $obj = array( "str" => $str , "page" => $page , "context" => $context ,"locale_zh_CN" => "" ,
            "locale_es_AR" => "" );
             $strcol->insert($obj);
             echo " String was successfully inserted";
        }
        else //Updating existing user
        {
            $zh         =   $strExist['locale_zh_CN'];
            $es         =   $strExist['locale_es_AR'];
            $result     =   $strcol->update($strExist, array("str" => $str , "page" => $page , "context" => $context ,
                                                                "locale_zh_CN" => $zh ,"locale_es_AR" => $es ));
            echo " String was successfully Updated" ;
        }
    } 
    
?>