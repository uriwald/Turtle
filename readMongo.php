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
$cursor->sort(array('precedence' => 1));
$i = 0; 
//$fullJsFile = "var lessons = [";
echo "var lessons = [";

foreach ($cursor as $lessonStructure) {
    //  Unset the lesson ID
    $lessonStructure['id'] = ''. $lessonStructure['_id']; 
    unset ($lessonStructure['_id']);   
     if (isset($lessonStructure['locale_'.$_GET['l']])) {
         $lessonStructure = $lessonStructure['locale_'.$_GET['l']];
     }
     $lessonSteps = $lessonStructure["steps"];
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
                    unset ($lessonSteps[$key][$kkey]);

               }
           }
            
     }
      $lessonStructure["steps"] = $lessonSteps;
      $finalTitle =  $lessonStructure["title"];
      //Now handling the title
      
      $lessonTitles = $lessonStructure["title"] ;
      foreach ($lessonTitles as $key => $value) {
          //echo "@@@".$key;
          if ($key == 'locale_'.$_GET['l'] )
          {
              $finalTitle = $lessonTitles[$key];
          }
      }
      $lessonStructure["title"] = $finalTitle ;
    
     // cleanup extra locales
     foreach ($lessonStructure as $key => $value) {
         if (strpos($key,'locale') === 0) {
             unset ($lessonStructure[$key]);
         }
     }
    echo json_encode($lessonStructure);
        echo ",";

    $i++;
     
}
echo "]";

function writeToJsFile($lessonStructure) {


    $ourFileName = "testFile.txt";
    $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
    $stringData = "Bobby Bopper\n";
    fwrite($ourFileHandle, $stringData);
    $stringData = "Tracy Tanner\n";
    fwrite($ourFileHandle, $stringData);
    fclose($ourFileHandle);
}