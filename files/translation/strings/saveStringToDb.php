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
        
        $emptyTranslate         = array("locale_zh_CN" => false ,"locale_es_AR" => false ,
            "locale_he_IL" => false ,"locale_ru_RU" => false , "locale_pt_BR" => false , "locale_de_DE" => false ,"locale_pl_PL"=>false , );
        $display                = array("zh_CN" => true ,"es_AR" => true ,"he_IL" => true ,"ru_RU" => true,
                                            "pt_BR" => true ,"pl_PL" => true ,"de_DE" => true);  
        //Case we need to add a new record to db
        if (!$resultcount > 0 ) 
        { 
            $obj = array( "str" => $str , "page" => $page , "context" => $context ,"translate" => $emptyTranslate ,
            "display" =>$display );
             $strcol->insert($obj);
             echo " String was successfully inserted";
        }
        else //Updating existing user
        {
            $zh         =   $strExist['locale_zh_CN'];
            $es         =   $strExist['locale_es_AR'];
            $de         =   $strExist['locale_de_DE'];
            $pt         =   $strExist['locale_pt_BR'];
            $pl         =   $strExist['locale_pl_PL'];
           
            $result     =   $strcol->update($strExist, array("str" => $str , "page" => $page , "context" => $context ,
                                                                "locale_zh_CN" => $zh ,"locale_es_AR" => $es , "locale_de_DE" => $de ,
                                                                    "locale_pt_BR" => $pt ,"locale_pl_PL" => $pl));
            echo " String was successfully Updated" ;
        }
    } 
    
?>