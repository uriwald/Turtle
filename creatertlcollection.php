<?php

        $m = new Mongo();
// select a database
        $db = $m->turtleTestDb;
// select a collection (analogous to a relational database's table)
        $languages = $db->rtlLanguages;
        
        // add a record
        //TODO create a simple form for adding new local
        //with list of existing locales
        $obj = array( "locale" => "ar_DZ");
        $languages->insert($obj);
        
?>
