<?php
    require_once("environment.php");
    $m = new Mongo();
    // select a database
    $db = $m->$db_name;
    // select a collection (analogous to a relational database's table)
    $lessons = $db->$db_lesson_collection;

    $the_object_id = new MongoId($_POST['ObjId']);
    
    $result = $lessons->remove(array('_id' => $the_object_id), true);
    
    $return['objdel'] = true;
    echo json_encode($return);
?>
