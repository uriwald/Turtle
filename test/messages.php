<?php                              
$m = new Mongo();
$db = $m->turtleTestDb;
$strcol = $db->messages;
$messages_recieve_query = array('sendto' => 'admin');
$messages_general = array('sendto' => 'all');
$username = "admin";
$messagesAdmin = array('sendto' => 'buri');
$messages_all = array('$or' => array(array('sendto' => $username), array('sendto' => 'all')));

//$newMessagesQuery = array('sendto' => $username, 'read' => false);
$new_messages_query = array('sendto' =>'buri');

$message_sent_query = array('sendfrom' => $username);
//$messagesRecieve = $strcol->find($messagesRecieveQuery);
$messages_recieve = $strcol->find($messages_all);
$messagesUser = $strcol->find($messages_recieve_query);
$all    = $strcol->find($messagesAdmin);
$messages_recieve->sort(array('date' => -1));
$messages_sent = $strcol->findOne($message_sent_query);
//$msgRecieveCount = $strcol->count($messagesRecieveQuery);
$msg_recieve_count = $strcol->count($messages_recieve_query);
$num_of_new_msg = $strcol->count($messages_all);
//foreach ($messagesRecieve as $message) {
foreach ($all as $message) {
    echo "adsfdfa";
    $class = '';
    if ($message['read'])
        $class = "read"; 
?>
    <tr>
        <td> <?php echo $message['sendfrom'] ?></td>
        <td> <?php echo $message['date'] ?></td>
        <td> <a id ="<?php echo $message['_id']; ?>"  title ="<?php echo $message['subject']; ?>" class="openMessage <?php echo $class; ?>"> <?php echo $message['subject'] ?> </a></td>
    </tr>
<?php
}
?>
