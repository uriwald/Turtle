<?php
    $headline       = $_POST['headline'];
    $context        = $_POST['context'];
    $itemid         = $_POST['itemid'];
    
    $flag = true ;
    if (strlen($headline) > 1 )
    {
        echo "Headline is ok <br>" ;
    }
    else {
            echo "Length is bad " ;
            $flag = false ;
    }
    if ($flag)
    {
        echo "Your headline is " .$headline  . " "  . ".<br />";
        echo "Your context is " .$context . " "  . ".<br />";
        echo "Your itemid is " .$itemid . " "  . ".<br />";
        
        $m = new Mongo();
        $db = $m->turtleTestDb;
        $strcol = $db->news;
        
        
        $newsQuery              = array('itemid' => $itemid);
        $newsExist              = $strcol->findOne($newsQuery);
        $resultcount            = $strcol->count($newsQuery);
        $emptyTranslate         = array("locale_zh_CN" => "" ,"locale_es_AR" => "" ,"locale_he_IL" => "" ,"locale_ru_RU" => "");
        $date = date('Y-m-d H:i:s');
        //Here the record will be added in any case
        
        if (!$resultcount > 0 ) 
        { 
            $obj = array( "headline" => $headline , "context" => $context , "itemid" => $itemid ,"headline_translate" => $emptyTranslate ,
            "context_translate" => $emptyTranslate , "approve" => false ,"date" => $date);
            $strcol->insert($obj);
            echo " NewsItem was successfully inserted";
        }
        else //Updating existing user
        {
            
            $headline_translate         =   $newsExist['headline_translate'];
            $context_translate          =   $newsExist['context_translate'];
            $approve                    =   $newsExist['approve'];
            $result     =   $strcol->update($newsExist, array("headline" => $headline , "context" => $context , "itemid" => $itemid 
                ,"headline_translate" => $headline_translate ,
                "context_translate" => $context_translate , "approve" => $approve ,"date" => $date));
            echo " String was successfully Updated" ;
        }
    } 
    
?>