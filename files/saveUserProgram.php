<?php
    $username                   =   $_POST['username'];
    if (!isset($_POST['programCode']))
    {
      $programCode = "";  
    } else {
         $programCode                =   $_POST['programCode'];
    }
    $programtitle               =   $_POST['programtitle'];
    $programUpdate              =   $_POST['update'];
    $program_id                  =   $_POST['programid'];
    $ispublic                   =   $_POST['ispublic'];
    $img                      =   $_POST['imgBase64'];
    $precedence                 =   "99";
    
    $return['programId']        =   $program_id;
    $return['username']         =   $username; 
    $return['programCode']      =   $programCode;
    $return['programUpdate']    =   $programUpdate;
    $lastUpdated                =   date('Y-m-d H:i:s');
    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $user_programs               =   "programs";
    $user_Programs_Collection     =   $db->$user_programs;

    if ($programUpdate == "false" || $programUpdate == false)
    {
        $return['isFirstUserProgram'] = true;
        $structure = array("username" => $username, "dateCreated" => $lastUpdated ,"displayInProgramPage" => $ispublic ,
            "lastUpdated" => $lastUpdated , "programName" => $programtitle ,
             "code" => $programCode , "numOfComments" => "0" , "comments" => "" ,"precedence" => "99" ,
            "img" => $img  , "sonPrograms" => "" , "fatherProgram" =>  "",
            "ranks" => "" , "numOfRanks" => "0" , "totalRankScore" => "0");
        $result = $user_Programs_Collection->insert($structure, array('safe' => true));
        $newDocID = $structure['_id'];
        $return['programId'] = $newDocID; 
    }
    else
    {
        //Fetching the current object
        $the_object_id                   =   new MongoId($program_id);
        $criteria                   =   $user_Programs_Collection->findOne(array("_id" => $the_object_id));
        //Changing all the values but createdDate
        $dateCreated        =   $criteria["dateCreated"];
        $num_comments       =   $criteria["numOfComments"];
        $comments           =   $criteria["comments"];
        $precedence         =   $criteria["precedence"];
        $dipp               =   $criteria["displayInProgramPage"];
        $father_program     =   $criteria["fatherProgram"];   
        $son_progrms        =   $criteria["sonPrograms"];
        $ranks              =   $criteria["ranks"];
        $num_of_ranks       =   $criteria["numOfRanks"];
        $rank_total_score   =   $criteria["totalRankScore"];     
        if (!isset($_POST['programCode']))
        {
             $programCode = $criteria["code"]; 
        }
        
        $structure = array("username" => $username, "dateCreated" => $dateCreated , "displayInProgramPage" => $ispublic , 
            "lastUpdated" => $lastUpdated , "programName" => $programtitle ,"code" => $programCode ,
            "numOfComments" => $num_comments , "comments" => $comments ,"precedence" => $precedence , "img" => $img,
            "sonPrograms" => $son_progrms , "fatherProgram" =>  $father_program,
            "ranks" => $ranks , "numOfRanks" => $num_of_ranks , "totalRankScore" => $rank_total_score);
        $result = $user_Programs_Collection->update($criteria, array('$set' => $structure));     
    }

    echo json_encode($return);
?>
