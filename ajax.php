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

        //$return['keys'] = array_keys($_POST['steps'] );
    }
    echo json_encode($return);
?>