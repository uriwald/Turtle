<?php
    sleep(3);
    if (empty($_POST['steps'])) {
        $return['error'] = true;
        $return['msg'] = 'You did not enter you email.';
    }
    else {
        $return['error'] = false;
        $steps = $_POST['steps'];
        
        $decodedStepValue = json_decode($steps);
        $return['msg'] = 'You\'ve entered: ' . $steps . '.';
        $return['firstElem'] = $decodedStepValue[1];
        
        
        
        /// Saving the lesson data into MongoDB
        for ($i = 1; $i <= $_POST['numOfSteps']; $i += 1) {
            $stepsArray = $decodedStepValue[$i];
           // $translatArray = array("title" => $stepsArray[0], "explanation" => $stepsArray[1], "action" => $stepsArray[2],
           //     "solution" => $stepsArray[3], "hint" => $stepsArray[4]);
            $translatArray = array("title" => $stepsArray[0], "action" => $stepsArray[1], "solution" => $stepsArray[2],
                "hint" => $stepsArray[3], "explanation" => $stepsArray[4]);
            $lessonSteps[$i] = $translatArray;
                   
        }   
        $m = new Mongo();
        // select a database
        $db = $m->turtleTestDb;
        // select a collection (analogous to a relational database's table)
        $precedence = 100;
        $lessons = $db->lessons;
        //Case we are inserting a new lesson
        //TODO indentify if an object was already sent
        if (!isset($_POST["ObjId"]) OR $_POST["ObjId"] == null OR strlen($_POST["ObjId"]) < 2) {
            $titles = array('locale_en_US' => $_POST['lessonTitle']);
            $structure = array("steps" => $lessonSteps, "title" => $titles);
            $result = $lessons->insert($structure, array('safe' => true));
            $return['objID'] = $structure['_id'];
        } else { //updating existing lesson
            // TODO see that we got the objId for existing lesson
             $return['objID'] = $_POST["ObjId"];
             $return['isExistingLesson'] = "true";
            
            $theObjId = new MongoId($_POST['ObjId']);
            $criteria = $lessons->findOne(array("_id" => $theObjId));

            //Case we want to remove object 
            if (isset($_POST["formDelete"])) {
                $result = $lessons->remove(array('_id' => $theObjId), true);
            } else {
                            
                $originLanguageStepsArr = $criteria["steps"];
                $originalTitle = $criteria["title"];
                
                
                $i = 1;
                $localeValue = "locale_en_US";
                if(isset($_POST['language']))
                $localeValue = "locale_" . $_POST['language'];
                
                $finalArrAfterTranslation = array();   
                
                $return['originLanguageStepsArr'] = $originLanguageStepsArr;
                //foreach ($originLanguageStepsArr as $lessonStep) {
                $return['numOfSteps'] = $_POST['numOfSteps'];
                for ($i = 1; $i <= $_POST['numOfSteps']; $i += 1) {
                    $return['$i'] = $i;
                    $lessonStep["$localeValue"] = $lessonSteps[$i];
                    $finalArrAfterTranslation[$i] = $lessonStep;
                }
                
                $lessonsTitle = $originalTitle;
                $lessonsTitle["$localeValue"] = $_POST['lessonTitle'];
                
                $return['finalArrAfterTranslation'] = $finalArrAfterTranslation;
                $result = $lessons->update($criteria, array('$set' => array("steps" => $finalArrAfterTranslation, "title" => $lessonsTitle , "precedence" => $precedence)));

                $return['isExistingLesson'] = "If We got Any result";

            }
             
            
             
        }

        //$return['keys'] = array_keys($_POST['steps'] );
    }
    echo json_encode($return);
    
?>