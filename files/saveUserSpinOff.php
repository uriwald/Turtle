<?php
    $username                   =   $_POST['username'];
    if (!isset($_POST['programCode']))
    {
      $programCode = "";  
    } else {
         $programCode                =   $_POST['programCode'];
    }
    $programtitle               =   $_POST['programtitle'];
    $program_id                  =   $_POST['programid'];
    $precedence                 =   "99";
    
    $return['programId']        =   $program_id;
    $return['username']         =   $username; 
    $return['programCode']      =   $programCode;
    $lastUpdated                =   date('Y-m-d H:i:s');
    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $user_programs               =   "programs";
    $user_Programs_Collection     =   $db->$user_programs;
    
   
    //Insert The spanned program
    $structure = array("username" => $username, "dateCreated" => $lastUpdated ,"displayInProgramPage" => "true" , 
        "lastUpdated" => $lastUpdated , "programName" => $programtitle ,
        "code" => $programCode , "numOfComments" => "0" , "comments" => "" ,"precedence" => "99" ,
        "img" => "" , 
        "fatherProgram" =>  $program_id ,"sonPrograms" => "" ,
            "ranks" => "" , "numOfRanks" => "0" , "totalRankScore" => "0");
     
    $result = $user_Programs_Collection->insert($structure, array('safe' => true));
    $newDocID = $structure['_id'];
    $return['programId'] = $newDocID; 
    $return['new_program_id'] = $structure['_id'];;
    
    
    
     //Update current progrma ( add the sapnning son
    $the_object_id                   =   new MongoId($program_id);
    $criteria                   =   $user_Programs_Collection->findOne(array("_id" => $the_object_id));
    $dateCreated    = $criteria["dateCreated"];
    $num_comments       =   $criteria["numOfComments"];
    $comments           =   $criteria["comments"];
    $precedence         =   $criteria["precedence"];
    $dipp               =   $criteria["displayInProgramPage"];
    $programName        =   $criteria["programName"];
    $programCode        =   $criteria["code"];
    $img                =   $criteria["img"];
    $program_sons       =   $criteria["sonPrograms"];
    $program_father     =   $criteria["fatherProgram"];
    $ranks              =   $criteria["ranks"];
    $num_of_ranks       =   $criteria["numOfRanks"];
    $rank_total_score   =   $criteria["totalRankScore"];   
    $username           =   $criteria["username"]; 
    $program_sons       .=  " , " . $newDocID;
    
    $structure = array("username" => $username, "dateCreated" => $dateCreated , "displayInProgramPage" => true , 
            "lastUpdated" => $lastUpdated , "programName" => $programName ,"code" => $programCode ,
            "numOfComments" => $num_comments , "comments" => $comments ,"precedence" => $precedence , "img" => $img
            , "sonPrograms" => $program_sons , "fatherProgram" =>  $program_father,
            "ranks" => $ranks , "numOfRanks" => $num_of_ranks , "totalRankScore" => $rank_total_score);
        $result = $user_Programs_Collection->update($criteria, array('$set' => $structure));

    echo json_encode($return);
?>
