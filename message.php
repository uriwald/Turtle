<div>
<?php
    //print_r($_GET);
    if (isset($_GET['id']))
    {
            $m                       = new Mongo();
            $db                      = $m->turtleTestDb;
            $strcol                  = $db->messages;
            $theObjId                = new MongoId($_GET['id']);
            $message                 = $strcol->findOne(array("_id" => $theObjId));
        
            $newMessage = $message;
            $newMessage['read'] = true;
            $strcol->update($message , $newMessage);

            echo    $message['content'];         
    }
?>
</div>