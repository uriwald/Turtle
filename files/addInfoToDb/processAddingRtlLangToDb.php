<?php
    $locale = $_POST['locale'];
    $flag = true ;
    if (strlen($locale) == 5 )
    {
        echo "Length is ok <br>" ;
    }
    else {
            echo "Length is bad " ;
            $flag = false ;
    }
    if ($flag)
    {
        echo "Your locale is " .$locale . " "  . ".<br />";
        $m = new Mongo();
// select a database
        $db = $m->turtleTestDb;
// select a collection (analogous to a relational database's table)
        $languages = $db->rtlLanguages;
        
        // add a record
        //TODO create a simple form for adding new local
        //with list of existing locales
        $obj = array( "locale" => $locale);
        $languages->insert($obj);
    }
    
?>