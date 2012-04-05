<?php
    session_start();
    
    echo ".\n all post var start  <<<";
    print_r($_POST);
    echo ".\n all post var end  <<<";
   // for i from 1 to  [numOfObjects]  insert object into array in place I-1
    $arr = array();
    for ( $i = 1; $i <= $_POST['numOfObjects']; $i += 1) {
        $title          = "title".$i;
        $explanation    = "explanation".$i    ;
        $action         = "action".$i;    
        $solution       = "solution".$i;   
        $hint           = "hint".$i;   
        $tmpArray = array("title" => $_POST[$title] , "explanation" => $_POST[$explanation] ,"action" => $_POST[$action] ,
            "solution" => $_POST[$solution] ,"hint" => $_POST[$hint] )  ;
        echo "Tmp Array is";
        var_dump($tmpArray);
        $arr[$i] = $tmpArray;
    }
    echo " **** NOW PRINTING THE ARR *****8 ";
    
    var_dump($arr);
    
    echo " **** DONE PRINTING THE ARR *****8 ";
    
    
    
    
    
    
    
    $m = new Mongo();
        // select a database
    $db = $m->turtleTestDb;

    // select a collection (analogous to a relational database's table)
    $lessons = $db->lessons;
    //UPDATE users SET a=1 WHERE b='q'
    //  $db->users->update(array("b" => "q"), array('$set' => array("a" => 1)));
    $buri = $lessons->find();
    foreach ($buri as $birburi)
    {
        var_dump($birburi);
    }
    
    $theObjId = new MongoId($_POST['ObjId']);
    $criteria = $lessons->findOne(array("_id" => $theObjId));
    echo "var_dump Criteria : <<<";
    var_dump($criteria) ;
    echo "End var_dump Criteria >>>";
    
    $lessonsTitle = $_POST['lessonTitle'];
  //  $criteria->update(array("username" => "joe"), array('$set' => array("steps" =>$_SESSION['steps']  , "title" => "helloWorld")));
    $result = $lessons->update($criteria, array('$set' => array("steps" => $arr , "title" => $lessonsTitle)));
   echo ",\n";
  // echo $result;
   echo ".\n post objId start <<<";
    echo $_POST['ObjId'];
   echo ".\n post objId end <<<";
    if(isset($_SESSION['steps']))
    {
        echo ",\n";
        echo " Seesion steps are : \n ";
      //  echo var_dump($_SESSION['steps']) ;
        echo $_SESSION['steps'][1]['title'];
    }
     else {
         echo "No Session Steps found";
}
?>
