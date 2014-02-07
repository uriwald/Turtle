<?php
    //print_r($_GET);
    if (isset($_GET['id']))
    {
            $m                       = new Mongo();
            $db                      = $m->turtleTestDb;
            $strcol                  = $db->messages;
            $the_object_id                = new MongoId($_GET['id']);
            $message                 = $strcol->findOne(array("_id" => $the_object_id));
        
            $newMessage = $message;
            if ($newMessage['sendto'] != 'all')
                $newMessage['read'] = true;
            $strcol->update($message , $newMessage);
            echo $message['content']  ;         
    }
?> 