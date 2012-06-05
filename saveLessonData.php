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
        $return['numOfSteps'] = $_POST['numOfSteps'];
        
        
        /// Saving the lesson data into MongoDB
        for ($i = 1; $i <= $_POST['numOfSteps']; $i += 1) {
            $stepsArray = $decodedStepValue[$i];
            $translatArray = array("title" => $stepsArray[0], "explanation" => $stepsArray[1], "action" => $stepsArray[2],
                "solution" => $stepsArray[3], "hint" => $stepsArray[4]);
            $lessonSteps[$i] = $translatArray;
                   
        }   
        //$return['lessonSteps'] = $lessonSteps;

        //$return['keys'] = array_keys($_POST['steps'] );
    }
    echo json_encode($return);
    
?>