<?php
    //require_once("../environment.php");
     $img64 = $_POST['imgBase64'];
   //  file_put_contents($sitePath .'/img/tmp/newImage.JPG',$decoded);
    $return['imag'] = $img64 ;
    
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $img                        =   "img";
    $imgCol     =   $db->$img;
        $structure = array("img" => $img64 );
        $result = $imgCol->insert($structure, array('safe' => true));
/*
    $path = $sitePath . "/img/tmp/";
    $filename = "newImage.JPG";
    // GridFS
    $grid = $db->getGridFS();
    $storedfile = $grid->storeFile($path . $filename,
             array("metadata" => array("filename" => $filename),
             "filename" => $filename));
*/


    echo json_encode($return);
?>
