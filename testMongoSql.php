<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    require_once("environment.php");
    
        $m = new Mongo();
        $db = $m->$dbName;
        $confirmation = $db->user_test;
        
        $userQuery = array('email' => 'uriwald@walla.com' , 'username' => 'buri' ,'password' => 'd2f2297d6e829cd3493aa7de4416a18f');
        $userQueryfake = array('email' => 'uriwald@wallagg.com');
        $cursor = $confirmation->find($userQuery);
        echo "Cursor object is " ;
        var_dump($cursor);
        echo $confirmation->count($userQuery);
        $cursorfake = $confirmation->find($userQueryfake);
        echo $confirmation->count($userQueryfake);
        echo "Fake cursor object is " ;
        print_r($cursorfake); // Where there are no results
        foreach ($cursor as $doc) {
            var_dump($doc);
        }
        foreach ($cursorfake as $doc) {
            var_dump($doc);
        }

        echo " Cursor email is ";
        echo $cursor[0]['email'];
?>