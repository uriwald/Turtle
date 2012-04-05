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
echo "var lessons = [";

//Lesson structure struct
//    $lessonStructure = array("title" => $_POST[$lessonTitle],
//    "steps" => $steps,
//);
// echo "cursor length is " . count($cursor['id']);
// print_r($cursor);
//echo "Number of lessons = " . $lessons->count();
// echo json_encode($cursor);
 
foreach ($cursor as $lessonStructure) {
  //  echo "--" . "Decoding the all lesson" . "----";
    $lessonStructure['id'] = ''. $lessonStructure['_id']; 
    unset ($lessonStructure['_id']);   
     echo json_encode($lessonStructure);
     echo ",\n";
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
echo "]";
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