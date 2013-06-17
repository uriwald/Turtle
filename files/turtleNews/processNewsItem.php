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
            $zh         =   $strExist['locale_zh_CN'];
            $es         =   $strExist['locale_es_AR'];
            $result     =   $strcol->update($strExist, array("str" => $str , "page" => $page , "context" => $context ,
                                                                "locale_zh_CN" => $zh ,"locale_es_AR" => $es ));
            echo " String was successfully Updated" ;
        }
    } 
    
?>