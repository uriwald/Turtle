<?php
    require_once("environment.php");
    $m = new Mongo();
    // select a database
    $db = $m->$dbName;
    // select a collection (analogous to a relational database's table)
    $lessons = $db->$dbLessonCollection;

    $theObjId = new MongoId($_POST['ObjId']);
    
    $result = $lessons->remove(array('_id' => $theObjId), true);
    
    $return['objdel'] = true;
    echo json_encode($return);
?>
