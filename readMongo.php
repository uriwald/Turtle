<?php

//TODO check why when translating .. the title is being changin
//TODO check why not all cache steps are being saved
if (session_id() == '')
    session_start();
require_once("environment.php");

$m = new Mongo();
$db = $m->$dbName;

// select a collection (analogous to a relational database's table)
if (isset($_GET["dab"])) {
    $dbLessonCollection = $_GET["dab"];
}
$lessons = $db->$dbLessonCollection;
//echo $dbLessonCollection;
$lessonTitle = "title";
$lessonSteps = "steps";
$localPosted = "locale";

// find everything in the collection
$cursor = $lessons->find();
$cursor->sort(array('precedence' => 1));
$i = 0;
//$fullJsFile = "var lessons = [";
echo "var lessons = [";
$notRegisterUser    = !isset($_SESSION['username']);
foreach ($cursor as $lessonStructure) {
    //  Unset the lesson ID
    //   echo " some lessons found";
    //print_r($lessonStructure);
    $lessonStructure['id']      = '' . $lessonStructure['_id'];
    unset($lessonStructure['_id']);
    $lessonForRegisterUserOnly  = false;
    if (isset($lessonStructure["register_only"]) ) 
        $lessonForRegisterUserOnly  = $lessonStructure["register_only"];

    //echo "isset?  ".$lessonStructure['locale_' . $_GET[$localPosted]];
    if (isset($lessonStructure['locale_' . $_GET[$localPosted]])) {
        //  echo "isset ".$lessonStructure['locale_' . $_GET[$localPosted]];
        $lessonStructure = $lessonStructure['locale_' . $_GET[$localPosted]];
    }
    if (isset($lessonStructure["steps"])) {
        // echo "is set steps";
        $lessonSteps = $lessonStructure["steps"];
    }
    //echo " printing lesson steps ";
    //print_r($lessonSteps);
    $showItem           = true;
    //If it's not a register user and the lesson should appear only for register users
    if ($notRegisterUser && $lessonForRegisterUserOnly )
        {
            //echo $lessonStructure['register_only'];
            $showItem = false;
        }
    
    foreach ($lessonSteps as $key => $value) {
        //"enterLessonSteps";
        //echo "Key = " . $key ;
        // If we have locale for the current step we will set him
        if (isset($lessonSteps[$key]['locale_' . $_GET[$localPosted]])) {
            $lessonSteps[$key] = $lessonSteps[$key]['locale_' . $_GET[$localPosted]];
        } else {
            $showItem = false;
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
    if (($lessonStructure["pending"] == false) && ($showItem == true)) {
        echo json_encode($lessonStructure);
        echo ",";
    }

    $i++;
}
echo "]";

updateLoclaStorageForLoggedUser($m , $db);
function writeToJsFile($lessonStructure) {


    $ourFileName = "testFile.txt";
    $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
    $stringData = "Bobby Bopper\n";
    fwrite($ourFileHandle, $stringData);
    $stringData = "Tracy Tanner\n";
    fwrite($ourFileHandle, $stringData);
    fclose($ourFileHandle);
}
function updateLoclaStorageForLoggedUser($m , $db)
{
    if (isset ($_SESSION['username']))
    {
        //echo "; var username = " . $_SESSION['username'] ;
        $userProgressCol    =   $db->user_progress; 
        $userQuery = array('username' => $_SESSION['username']);
        $cursor = $userProgressCol->findone($userQuery);
        echo ";";
        if ($cursor != null && isset($cursor['stepCompleted']))
        {
            $data = explode(",", $cursor['stepCompleted']); ;
            //print_r($data);
            
            $datalen    = count($data);
            $value = "true";
            //echo ";<script>";
            for ($i =0 ; $i < $datalen -1 ; $i++)
            {
               echo "localStorage.setItem('$data[$i]' ,'$value' );";
                 
            }
            if (isset($cursor['userHistory']))
            {
                $historyVal     =   $cursor['userHistory'];
                echo "localStorage.setItem('logo-history' ,'$historyVal' );";
            }
            //echo "</script>";
        }
    }
} 