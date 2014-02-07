<style>

div {
   width : 449px; height :221px ;
    background-repeat:no-repeat;
    background-size:75px 75px;
}
</style>
<?php
    $m                          =   new Mongo();
    $db                         =   $m->turtleTestDb;
    $img                        =   "programs";
    $imgCol     =   $db->$img;
    $the_object_id                   =   new MongoId("5280af56f458591334000000");
    $criteria                   =   $imgCol->findOne(array("_id" => $the_object_id));
 

        echo "hello";
        $im = $criteria['img'];
        echo "<div style='background : url($im);background-repeat:no-repeat;background-size:75px 75px;'>";
        echo "</div>";

?>
