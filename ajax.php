<?php
    sleep(3);
    if (empty($_POST['email'])) {
        $return['error'] = true;
        $return['msg'] = 'You did not enter you email.';
    }
    else {
        $return['error'] = false;
        $return['msg'] = 'You\'ve entered: ' . $_POST['email'] . '.';
        //$return['enconded'] = json_encode($_POST['email'] );
    }
    echo json_encode($return);
?>