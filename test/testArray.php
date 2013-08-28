<?php
    require_once("files/utils/arrayUtil.php");
    $array = array(
        "1" => "bar",
        "2" => "foo",
        "4" => "loo",
        "5" => "poo",
        "6" => "ooo",
        "7" => "yoo",
    );
    $bur = 4;
    $ds = array(1,2,3,4);
    if (in_array( $bur , $ds)) 
            echo"Dd";
    //arrayUtil::reindexArray($array);
    
?>
