<?php

//TODO check why when translating .. the title is being changin
//TODO check why not all cache steps are being saved
if (session_id() == '')
    session_start();
require_once("environment.php");

$m = new Mongo();
$db = $m->$dbName;


//updateLoclaStorageForLoggedUser($m , $db);

if (isset($_SESSION['username']))
{
 updateToCmd($m , $db);
}

function updateToCmd($m , $db)
{
        $userProgressCol    =   $db->user_progress;
        $userQuery = array('username' => $_SESSION['username']);
        $cursor = $userProgressCol->findone($userQuery);
        if ($cursor != null && isset($cursor['tocmd']))
        {         
            $runcmd =    $cursor['tocmd'];
            echo "localStorage.setItem('tocmd' ,'$runcmd' );";
                 
        }
    
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
            $data = explode(",", $cursor['stepCompleted']);         
            $datalen    = count($data);
            $value = "true";
            for ($i =0 ; $i < $datalen -1 ; $i++)
            {
               echo "localStorage.setItem('$data[$i]' ,'$value' );";
                 
            }
            if (isset($cursor['userHistory']))
            {
                $historyVal                       =   $cursor['userHistory'];
                $historyValNoSpecialCaracter      =   str_replace( "'", "" , $historyVal);
                echo "localStorage.setItem('logo-history' ,'$historyValNoSpecialCaracter' );";
            }
        }
    }
} 