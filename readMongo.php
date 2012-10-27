<?php
//TODO check why when translating .. the title is being changin
//TODO check why not all cache steps are being saved
require_once("environment.php");
$m = new Mongo();

// select a database
$db = $m->$dbName;

// select a collection (analogous to a relational database's table)
$lessons = $db->$dbLessonCollection;

$lessonTitle = "title";
$lessonSteps = "steps";
$localPosted = "locale";

// find everything in the collection
$cursor = $lessons->find();
$cursor->sort(array('precedence' => 1));
$i = 0;
//$fullJsFile = "var lessons = [";
echo "var lessons = [";

foreach ($cursor as $lessonStructure) {
    //  Unset the lesson ID
    $lessonStructure['id'] = '' . $lessonStructure['_id'];
    unset($lessonStructure['_id']);
    
    // If the requested language is in the current json collection
    if (isset($lessonStructure['locale_' . $_GET[$localPosted]])) {
        $lessonStructure = $lessonStructure['locale_' . $_GET[$localPosted]];
    }
    if (isset($lessonStructure["steps"])) {
        $lessonSteps = $lessonStructure["steps"];
    }
    
    $showItem = true ;
    foreach ($lessonSteps as $key => $value) {
        //echo "Key = " . $key ;
        // If we have local for the current step we will set him
        if (isset($lessonSteps[$key]['locale_' . $_GET[$localPosted]])) {
            $lessonSteps[$key] = $lessonSteps[$key]['locale_' . $_GET[$localPosted]];
        }
        else
        {
            $showItem = false ;
        }
        // unsetting the other locale values
        foreach ($value as $kkey => $vvalue) {
            //echo "Key = " . $kkey ;
            if (strpos($kkey, 'locale') === 0) {
                unset($lessonSteps[$key][$kkey]);
            }
        }
    }
    $lessonStructure["steps"] = $lessonSteps;
    $finalTitle = $lessonStructure["title"];
    //Now handling the title

    $lessonTitles = $lessonStructure["title"];
    foreach ($lessonTitles as $key => $value) {
        //echo "@@@".$key;
        if ($key == 'locale_' . $_GET[$localPosted]) {
            $finalTitle = $lessonTitles[$key];
        }
    }
    $lessonStructure["title"] = $finalTitle;

    // cleanup extra locales
    foreach ($lessonStructure as $key => $value) {
        if (strpos($key, 'locale') === 0) {
            unset($lessonStructure[$key]);
        }
    }
    if ( ($lessonStructure["pending"] == false) && ($showItem == true) )
    {
        echo json_encode($lessonStructure);
        echo ",";
    }

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