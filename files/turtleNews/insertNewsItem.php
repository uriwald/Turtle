<?php
    $edit = false;
    if (isset ($_GET['itemid']))
    {
        $edit       =   true;
        $m          = new Mongo();
        $db         = $m->turtleTestDb;
        $colname    = $db->news;
        $theObjId   = new MongoId($_GET['itemid']);
        $cursor     = $colname->findOne(array("_id" => $theObjId));
    }
?>

<html>
    <body>
        <h4>Translate strings</h4>
        <form action="processNewsItem.php" method="post"> 
            News Headline : <input name="headline" type="text" style="width:600px;" value="<?php if($edit) echo $cursor['headline']; ?>">  </input> </br>
            News Content : <textarea name="context" rows="6" cols="60"><?php if($edit) echo $cursor['context']; ?></textarea> </br>
            ItemId : <input name="itemid" type="text"  value="<?php if($edit) echo $cursor['itemid']; ?>"/> </br>
            <input type="submit" />
        </form>      
    </body>
</html>