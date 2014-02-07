<?php

  
    $precedence = $_POST['precedence'];  
    $progid   = $_POST['programId'];

    $return['nothing'] = true ;
    $flag = true ;
    if ($flag)
    {

        $m = new Mongo();
        $db = $m->turtleTestDb;
        $progcol = $db->programs;
        
        $the_object_id = new MongoId($progid);
        $criteria = $progcol->findOne(array("_id" => $the_object_id));
     
        $resultcount            = $progcol->count(array("_id" => $the_object_id));
        //Case we need to add a new record to db
        if (!$resultcount > 0 ) 
        { 
            $return["error"] = "Can't find lesson to update";
        } 
        else //Updating existing user
        {            
            $cursor = $criteria; 
            $cursor["precedence"] = $precedence ;
            $result = $progcol->update($criteria,$cursor);

         }
        
         
    }
     echo json_encode($return); 
     
    
?>