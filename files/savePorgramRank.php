<?php
    require_once("../environment.php");
    require_once("utils/collectionUtil.php");
    
    $username                   =   $_POST['username'];
    $program_id                 =   $_POST['programid'];
    $val                        =   $_POST['value'];
    
    $return['programId']        =   $program_id;
    $date                =   date('Y-m-d H:i:s');
    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $user_programs               =   "programs";
    $user_Programs_Collection     =   $db->$user_programs;
    $new_rank = array("username" => $username , "value" => $val  );
    //Fetching the current object
    $the_object_id                   =   new MongoId($program_id);
    $criteria                   =   $user_Programs_Collection->findOne(array("_id" => $the_object_id));
    
    $ranks_before               =   $criteria['ranks'];
    $num_of_ranks               =   $criteria['numOfRanks']; 
    $rank_score                 =   $criteria['totalRankScore']; 
    $rank_score_change = 0;
    $i = 0;
    $update_existing_rank = false;
    
    if(is_array($ranks_before))
    {
        foreach ($ranks_before as $rank)
        {
            if ($rank['username'] == $username)
            {
                $rank_score_change = $val - $ranks_before[$i]['value'];
                $ranks_before[$i]['value'] = $val;
                $update_existing_rank = true;
                break;
            }
            $i++;
        }
    }
    $rank_update                =   $ranks_before;
    if (!$update_existing_rank)
    {
        $rank_update[]              =   $new_rank;
        $rank_score_change          =   $val; 
        $num_of_ranks++;
    } 
    $rank_score = $rank_score + $rank_score_change;
    collectionUtil ::collection_item_change_attrivute_val ("turtleTestDb","programs" ,$the_object_id , "ranks"  , $rank_update);
    collectionUtil ::collection_item_change_attrivute_val ("turtleTestDb","programs" ,$the_object_id , "numOfRanks"  , $num_of_ranks);
    collectionUtil ::collection_item_change_attrivute_val ("turtleTestDb","programs" ,$the_object_id , "totalRankScore"  , $rank_score);

    echo json_encode($return);
?>
