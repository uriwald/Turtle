<?php
    $root_dir = "../../../";
    $title       = $_POST['title'];
    $id          = $_POST['id'];
    
    $flag = true ;
    if (strlen($title) > 1 )
    {
        echo "Lesson Title is ok <br>" ;
    }
    else {
            echo "Length is bad " ;
            $flag = false ;
    }
    if ($flag)
    {
        echo "Your Title is " .$title  . " "  . ".<br />";
        echo "Your id is " .$id . " "  . ".<br />";
        
        $m = new Mongo();
        $db = $m->turtleTestDb;
        $strcol = $db->lessons_translate_status;
        
        $emptyTranslate         = array("locale_zh_CN" => false ,"locale_es_AR" => false ,"locale_he_IL" => false ,"locale_ru_RU" => false , "locale_de_DE" => false);
        
        //$date = date('Y-m-d H:i:s'); 
        //Here the record will be added in any case
        
            $obj = array( "title" => $title , "lesson_id" => $id , "in_progress" => $emptyTranslate ,"completed" => $emptyTranslate
                            , "comments" => "" , "precedence" => "9999");
            $strcol->insert($obj);
            echo " NewsItem was successfully inserted";
            $adminPage  =   $root_dir . "admin.php";
            echo "<a href='" . $adminPage . "'> <span class='lessonh'> Go back to Admin page </span> </a>";
      
    } 
    
?>