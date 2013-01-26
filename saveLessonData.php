<?php

//TODO refer translation mode when I get the translation = true by the translating.php page 
if (!isset($_SESSION)) {
  session_start();
}
require_once("environment.php");
require_once("files/utils/arrayUtil.php");
sleep(3);


//Getting User Info
$user = "Unknown";
$username   =   "username";
if (isset($_SESSION[$username]))
{
    $user = $_SESSION[$username] ;
}
  //$return['session'] = Print_r($_SESSION);

if (empty($_POST['steps'])) {
    $return['error'] = true;
    $return['msg'] = 'You did not enter you email.';
} else {
    $return['error'] = false;
    $steps = $_POST['steps'];

    $decodedStepValue           = json_decode($steps);
    $return['decodedSteps']     = $decodedStepValue;
    $return['msg']              = 'You\'ve entered: ' . $steps . '.';
    //$return['firstElem']        = $decodedStepValue[1];


    //TODO case of removing singel step 
    /// Saving the lesson data into lessonSteps
    for ($i = 1; $i <= $_POST['numOfSteps']; $i += 1) {
        $stepsArray = $decodedStepValue[$i];
        // $translatArray = array("title" => $stepsArray[0], "explanation" => $stepsArray[1], "action" => $stepsArray[2],
        //     "solution" => $stepsArray[3], "hint" => $stepsArray[4]);
        $translatArray = array("title" => $stepsArray[0], "action" => $stepsArray[1], "solution" => $stepsArray[2],
            "hint" => $stepsArray[3], "explanation" => $stepsArray[4]);
        $lessonSteps[$i] = $translatArray;
    }
    $return['lessonSteps'] =  $lessonSteps;
    
    $m = new Mongo();
    // select a database
    $db = $m->$dbName;
    // select a collection (analogous to a relational database's table)
    $precedence = $_POST['precedence'];
    
    $dbCollection   =   "lessons";
    if (isset($_POST['collection']))
       $dbCollection    =   $_POST['collection'] ;
    $lessons = $db->$dbCollection;
    //$lessons = $db->lessons;
    //$lessons = $db->lessons;
    $localeValue = "locale_en_US";
    if (isset($_POST['locale']))
        $localeValue = "locale_" . $_POST['locale'];
    
    
    //Case we are inserting a new lesson
    if (!isset($_POST["ObjId"]) OR $_POST["ObjId"] == null OR strlen($_POST["ObjId"]) < 2) {
        $titles = array('locale_en_US' => $_POST['lessonTitle']);
        for ($i = 1; $i <= $_POST['numOfSteps']; $i += 1) {
            $lessonStep["$localeValue"] = $lessonSteps[$i];
            $finalArrAfterTranslation[$i] = $lessonStep;
        }
        $structure = array("steps" => $finalArrAfterTranslation, "title" => $titles, "pending" => "true" , "user" => $user);
        $result = $lessons->insert($structure, array('safe' => true));
        $return['objID'] = $structure['_id'];
    } 
    else 
    { //updating existing lesson

        $return['objID'] = $_POST["ObjId"];
        $return['isExistingLesson'] = "true";

        $theObjId = new MongoId($_POST['ObjId']);
        $criteria = $lessons->findOne(array("_id" => $theObjId));
        
        $isStepRemove = $_POST["isStepRemove"];
        $stepToRemove = $_POST["stepToRemove"];

        //Case we want to remove object 
        if (isset($_POST["formDelete"])) {
            $result = $lessons->remove(array('_id' => $theObjId), true);
            
        } else { //Case we don't want to remove object but updating existing one
            
            $originLanguageStepsArr = $criteria["steps"]; 
            $return['originLanguageStepsArrBeforeSet'] = $originLanguageStepsArr;
            $originalTitle = $criteria["title"];
            $i = 1;
            //$finalArrAfterTranslation = array();
            $numberOfSteps  =  $_POST['numOfSteps']; 
            for ($i = 1; $i <= $numberOfSteps; $i++) {
                
                $return['$i'] = $i;
                $originLanguageStepsArr[$i]["$localeValue"] = $lessonSteps[$i];
            }
            $return['originLanguageStepsAfterSettingLessonSteps'] = $originLanguageStepsArr;
            //Will delete step by step not in a list
            if ($isStepRemove)
            {
               $return['isStepRemove']          = true ; 
               $return['stepToRemove']         = $stepToRemove;
               //$lenStepToRemove                 = sizeof($stepToRemove);
               //$return['stepToRemoveLen']      = $lenStepToRemove;
               //for ($i = 0; $i < $lenStepToRemove; $i += 1) {
                   //unset($originLanguageStepsArr[$stepToRemove[$i]]);   
               $return['originLanguageStepsArrBeforeSet'] = $originLanguageStepsArr;
                unset($originLanguageStepsArr[$stepToRemove]);        
                   //Return index array from 0 ( need from 1 will create a function to fix)
                $originLanguageStepsArr = arrayUtil::reindexArray($originLanguageStepsArr);
                for ($i = 1; $i <= $numberOfSteps; $i += 1) {
                    $originLanguageStepsArr[$i]["$localeValue"] = $lessonSteps[$i];
                } 

               //} 
            }
            $return['originLanguageStepsArrAfterSet'] = $originLanguageStepsArr;
            $lessonsTitle = $originalTitle;
            $lessonsTitle["$localeValue"] = $_POST['lessonTitle'];
            //$return['finalArrAfterTranslation'] = $finalArrAfterTranslation;
            $result = $lessons->update($criteria, array('$set' => array("steps" => $originLanguageStepsArr, "title" => $lessonsTitle, "precedence" => $precedence)));
            $return['isExistingLesson'] = "If We got Any result";
        }
    }
    
    //$return['keys'] = array_keys($_POST['steps'] );
}
echo json_encode($return);
?>