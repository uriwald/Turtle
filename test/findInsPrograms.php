<?php
require_once '../files/utils/userUtil.php';
$programs    = userUtil :: get_institiute_user_programs("uriwald@walla.com"); 

foreach($programs as $program)
{
    echo $program['code'];
}

?>