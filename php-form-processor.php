<?php

// Just checking if we are getting the post request as wanted
print_r($_POST);
echo " bla bla" ;
echo $_POST["formSubmit"];
$numberOfSteps          = $_POST["formSubmit"];
$titlePrefix               = "title";
$explPrefix                  = "explanation";
$actionPrefix             = "action";
$solPrefix                     = "solution";
$hintPrefix                  = "hint";
$lessonTitle               = "lessonTitle";


echo "Hi I am birburi and the first step is <br> ***** ";
for ($counter = 1; $counter <=$numberOfSteps; $counter += 1) {
    $stringToCheck = $titlePrefix . $counter;
    echo $stringToCheck;
    echo $_POST[$stringToCheck];
    echo "<br>";
}
//End of check 1
//$query_string = "";
//if ($_POST) {
//    $kv = array();
//    foreach ($_POST as $key => $value) {
//        $kv[] = "$key=$value";
//    }
//    $query_string = join("&", $kv);
//} else {
//    $query_string = $_SERVER['QUERY_STRING'];
//}
//echo $query_string;
//$my_array = array(1 => array(1 => 1, 2 => 2, 3 => 3), 2 => array(1 => 2, 2 => 4, 3 => 6), 3 => array(1 => 3, 2 => 6, 3 => 9));
//Steps is an array of consist from array(each array is a full step)
$steps = array();
echo "Now tryign to set all step lessons </br>";
for ($i = 1; $i <= $numberOfSteps; $i++) {
    $stepTitle = $titlePrefix . $i;
    $stepExplanation      =$explPrefix . $i;
    $stepAction                   =$actionPrefix . $i;
    $stepSolution              = $solPrefix . $i;
    $stepHint                         = $hintPrefix . $i;
    
    echo "<br> Now we are in step number $i";

    
    if (isset($_POST[$stepTitle]) &&  strlen(($_POST[$stepTitle])) > 1) {
        echo " The Title length of this step is .... ";
        echo strlen(($_POST[$stepTitle]));
        $step = array("title" => $_POST[$stepTitle], "explanation" => $_POST[$stepExplanation]
            , "action" => $_POST[$stepAction], "solution" => $_POST[$stepSolution], "hint" => $_POST[$stepHint]);
        $steps[$i] = $step; //use to be function random for get values from 10 to 100.
    }
    else
    {
        echo "Title for the step $i is not set .. We will break  ";
        break;
    }
}
echo " *** now starting to print some steps";
//foreach ($steps as $key => $value) {
//        $kv = array();
//        $kv[] = "$key=$value";
//        $query_string = join("&", $kv);
//        echo $query_string;
//
//}

echo " another way of printlng steps </br></br>";
for ($i = 1; $i <= $numberOfSteps; $i++) {
    print "";
    foreach ($steps[$i] as $kkey => $vvalue) {
        echo "  </br> Step $i   " ;
        $kkvv = array();
        $kkvv[] = "$kkey=$vvalue";
        $firstArryay = join("&", $kkvv);
        echo $firstArryay;
    }
}


$lessonStructure = array("title" => $_POST[$lessonTitle],
    "steps" => $steps,
);
echo " buri buri     ", PHP_EOL;
echo"--------";
$kv = array();
foreach ($lessonStructure as $key => $value) {
    $kv = array();
    $kv[] = "$key=$value";
    $query_string = join("&", $kv);
    if (is_array($value)) {
        echo " In The Array ";
        foreach ($value as $kkey => $vvalue) {
            echo " In the foreEach for ";
            $kkvv = array();
            $kkvv[] = "$kkey=$vvalue";
            $firstArryay = join("&", $kkvv);
            echo $firstArryay;
        }
    }
    echo $query_string;
}
echo $lessonStructure;

connectToMongo($lessonStructure);

function connectToMongo($lessonStructure) {
    echo "In Mongo Function";
    // connect
    $m = new Mongo();

// select a database
    $db = $m->turtleTestDb;

// select a collection (analogous to a relational database's table)
    $lessons = $db->lessons;

// add a record
    //  $obj = array("title" => "Calvin and Hobbes", "author" => "Bill Watterson");
//    $lessons->insert($obj);
// add another record, with a different "shape"
    //   $obj = array("title" => "XKCD", "online" => true);
    $lessons->insert($lessonStructure);

// find everything in the collection
    $cursor = $lessons->find();

    $findLessonTurtle = $lessons->find(array("title" => "luciowald"));

// iterate through the results
    foreach ($cursor as $lessonStructure) {
        echo $lessonStructure["title"] . "\n";
    }
    $findLessonTurtle = $lessons->find(array("title" => "luciowald"));

// iterate through the results
    echo "_____________________________________________-";
    foreach ($findLessonTurtle as $moo) {
        echo $moo["title"] . "\n";
    }
}

/*
  if($_POST['formSubmit'] == "Submit")
  {
  $varMovie = $_POST['formMovie'];
  $varName = $_POST['formName'];
  $varGender = $_POST['formGender'];
  $errorMessage = "";

  if(empty($varMovie)) {
  $errorMessage .= "<li>You forgot to enter a movie!</li>";
  }
  if(empty($varName)) {
  $errorMessage .= "<li>You forgot to enter a name!</li>";
  }
  if(empty($varGender)) {
  $errorMessage .= "<li>You forgot to select your Gender!</li>";
  }
  echo $errorMessage ;

  // - - - snip - - -
  }
 */
 
?>
