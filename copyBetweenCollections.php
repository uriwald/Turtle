<html>
    <body>
        <h4>Insert Mongo Id to copy between collections </h4>
        <form action="processColCopy.php" method="post"> 
                Mongo Id : <input name="mongoid" type="text" /> 
                copy from : <input name="copyfrom" type="text" /> 
                copy to: <input name="copyto" type="text" /> 
            <input type="submit" />
        </form>     
        <?php
            require_once("environment.php");

                $m = new Mongo();

                // select a database
                $db = $m->$dbName;

                // select a collection (analogous to a relational database's table)
                $lessons = $db->$dbLessonCollection;

                // find everything in the collection
                $cursor = $lessons->find();
                $cursor->sort(array('precedence' => 1));

                foreach ($cursor as $lessonStructure) {
                    $objID         =            $lessonStructure['_id'];
                    $title         =            $lessonStructure['title']['locale_en_US'];
                    echo "Lesson name is <b>" .$title  . "</b> id is <b>".$objID  . "</b> ";  
                }


        ?>
    </body>
</html>

