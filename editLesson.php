<?php

$m = new Mongo();
// select the turtle database
$db = $m->turtleTestDb;
// select a collection (analogous to a relational database's table)
$lessons = $db->lessons;
//Find lesson by lesson title
//$findLessonTurtle = $lessons->find(array("title" => "luciowald"));
$findLessonTurtle = $lessons->find();
$officeOptions = '';
foreach ($findLessonTurtle as $lessons) {
    echo $lessons["title"] . "\n";
    //Moo Array
    $officeOptions .= "<option value=\"{$lessons['_id']}\">{$lessons['title']}</option>\n";
    echo $lessons["steps"] . "\n";
    $steps = $lessons["steps"];
 //   for ($i = 1; $i < 10; $i++) {
  //      echo "in step number $i";
        echo " trying to echo value of step1 title   ".$steps[1] ["title"]."---------";
  //      foreach ($steps[1] as $key => $value) {
  //        echo " **In foreach loop I =  try to print steps *****  " . "\n";
  //          $kkvv = array();
  //          echo $key ;
 //           echo "=".$value;
 //       }
 //   }
}
?>
<html>
    <head>
        <title></title>
                </script>
    </head>
    <body>
        <select name="office">
            <?php echo $officeOptions; ?>
        </select>
    </body>
</html>