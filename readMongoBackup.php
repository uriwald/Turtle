<?php

$m = new Mongo();

// select a database
$db = $m->turtleTestDb;

// select a collection (analogous to a relational database's table)
$lessons = $db->lessons;

$lessonTitle = "title";
$lessonSteps = "steps";

// find everything in the collection
$cursor = $lessons->find();
//$fullJsFile = "var lessons = [";
echo "var lessons = {";

//Lesson structure struct
//    $lessonStructure = array("title" => $_POST[$lessonTitle],
//    "steps" => $steps,
//);
// echo "cursor length is " . count($cursor['id']);
// print_r($cursor);
//echo "Number of lessons = " . $lessons->count();
// echo json_encode($cursor);
 
foreach ($cursor as $lessonStructure) {
    //  Unset the lesson ID
    $lessonStructure['id'] = ''. $lessonStructure['_id']; 
    unset ($lessonStructure['_id']);   
     if (isset($lessonStructure['locale_'.$_GET['l']])) {
         $lessonStructure = $lessonStructure['locale_'.$_GET['l']];
     }
     $lessonSteps = $lessonStructure["steps"];
     //echo "_______For debuggin should be delete _____ lesson step before";
     //echo json_encode($lessonStep);
     //print_r($lessonStep);
     //echo "<pre>";
     //echo "Printing Lesson step -";
     //print_r($lessonSteps);
     //echo "End Printing Lesson step -";
     foreach ($lessonSteps as $key => $value) {
           //echo "Key = " . $key ;
           // If we have local for the current step we will set him
           if (isset($lessonSteps[$key]['locale_'.$_GET['l']])) {
              $lessonSteps[$key] = $lessonSteps[$key]['locale_'.$_GET['l']];
           }
           // unsetting the other locale values
           foreach ($value as $kkey => $vvalue)
           {
               //echo "Key = " . $kkey ;
               if (strpos($kkey,'locale') === 0) {
                    //echo "Going to unset" . $kkey;
                    //print_r($lessonSteps[$key]);
                    //echo " ---- will unset ";
                    //print_r($lessonSteps[$key][$kkey]);
                    //echo " end of unset ----\n";
                    unset ($lessonSteps[$key][$kkey]);
                    //print_r($lessonStep[$key][$kkey]);
                    //echo "\n\n\n";
               }
           }
           /*
           echo " title : [";
           echo json_encode($lessonStructure["title"]);
           echo " ],";
           
           echo "steps : [";
           echo json_encode($lessonSteps[$key]);
           echo " ]";
           */
            
     }

     
      $lessonStructure["steps"] = $lessonSteps;
      
    // echo "_______For debuggin should be delete _____ lesson step After ****\n";
    //  print_r(json_encode($lessonSteps));
    // echo "************************************\n";
     //echo json_encode($lessonStep);
     
     // cleanup extra locales
     foreach ($lessonStructure as $key => $value) {
         if (strpos($key,'locale') === 0) {
             unset ($lessonStructure[$key]);
         }
     }
     echo json_encode($lessonStructure);
     echo ",";
//    echo "************************* END Decoding lesson *******************************";
//    $fullJsFile = $fullJsFile . "{";
    /*
    $fullJsFile = $fullJsFile . "title:\"" . $lessonStructure[$lessonTitle] . "\"" . ",";
    $fullJsFile = $fullJsFile . " steps : [{";
    $i = 0;
    foreach ($lessonStructure[$lessonSteps] as $steps) {
        $i++;
        echo "echo decode begin---";
        echo json_encode($steps);
        echo "---echo decode end";
        
        $fullJsFile = $fullJsFile . "{";
        $fullJsFile = $fullJsFile . "title :\"" . $steps['title'] . "\"" . "," . "explanation :\"" . $steps['explanation'] . "\"" . ","
                . "action :\"" . $steps['action'] . "\"" . "," . "solution :\"" . $steps['solution'] . "\"" . "," . "hint :\"" . $steps['hint'] . "\""
        ;
//              $fullJsFile = $fullJsFile."explanation :\"" . $steps['explanation']."\"".",";
//              $fullJsFile = $fullJsFile."action :\"" . $steps['action']."\"".",";
//              $fullJsFile = $fullJsFile."solution :\"" . $steps['solution']."\"".",";
//              $fullJsFile = $fullJsFile."hint :\"" . $steps['hint']."\"";
        if ($i != count($lessonStructure[$lessonSteps])) {
            $fullJsFile = $fullJsFile . "},";
        } else {
            $fullJsFile = $fullJsFile . "}";
        }
        //      echo $steps['title'];
    }
    $fullJsFile = $fullJsFile . "}],";
    //    print_r($lessonStructure);
    // echo $lessonStructure;
     * 
     */
}
echo "}";
//echo "*********";
//echo $fullJsFile;
   

function writeToJsFile($lessonStructure) {


    $ourFileName = "testFile.txt";
    $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
    $stringData = "Bobby Bopper\n";
    fwrite($ourFileHandle, $stringData);
    $stringData = "Tracy Tanner\n";
    fwrite($ourFileHandle, $stringData);
    fclose($ourFileHandle);
}