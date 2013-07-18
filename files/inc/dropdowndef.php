<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
    if (!isset ($rootDir))
        $rootDir = "/";
    $ddPath =  $rootDir . "files/test/dd/"; 
?>
 
        <!-- Starting the dropdown dd directory related -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="<?php echo $ddPath . 'js/jquery/jquery-1.8.2.min.js' ?>"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/dd.css' ?>" />
        <script src="<?php echo $ddPath . 'js/msdropdown/jquery.dd.min.js' ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/skin2.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/flags.css' ?>" /> 
        <!-- Finish the dropdown dd directory related -->
