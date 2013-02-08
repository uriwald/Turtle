<?php

    if(session_id() == '') 
        session_start();
    $_SESSION['locale'] =   $_POST['locale'];
    $return['locale']   =   $_POST['locale']; 
    echo json_encode($return);
?>
