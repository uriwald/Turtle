<?php
        $m                  = new Mongo();
        $db                 = $m->turtleTestDb;
        $strcol             = $db->user_progress;
        $users           = $strcol->find();;
        $d = date('2001-03-10 H:i:s');
        echo $d;
        $emptyHistory ="";
        
        foreach ($users as $user)
        {      
            echo "***";
            $username               =   $user['username'];
            $completed              =   (isset($user['stepCompleted']))?$user['stepCompleted'] : $user['completed'];
            $history                =   (isset($user['userHistory']))? $user['userHistory'] : $emptyHistory  ;
            $lastupdate             =   (isset($user['lastUpdate']))? $user['lastUpdate'] : $d;
            echo $completed . "<br>";
            $stepesCompletedArray = explode(",", $completed);
            print_r($stepesCompletedArray);
            $i = 0;
            $leng = count($stepesCompletedArray) - 1;
            $newStepsString = " ";
            echo $stepesCompletedArray[0];
            for ($i ; $i < $leng ; $i++ )
            {
               //$newStepsString = $newStepsString . substr($stepesCompletedArray[$i],0,-1). ",";
                $newStepsString = $newStepsString . $stepesCompletedArray[$i]. ",";
            }
            echo "New steps string is : " . $newStepsString;
            echo " ----";
            $result     =   $strcol->update($user, array("username" => $username , "stepCompleted" => $newStepsString ,
                "userHistory" => $history ,"lastUpdate" => $lastupdate ));
        }
        
?> 
