<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php 
    
    if (!isset ($rootDir))
        $rootDir = "/";
    $jqueryui = $rootDir."ajax/libs/jqueryui/1.10.0/";
    
?>
        <script  type="text/javascript" src="<?php echo $jqueryui . 'js/jquery-ui-1.10.0.custom.js'; ?>"></script> <!--- equal to googleapis -->
       
        <script  type="text/javascript" src="<?php echo $rootDir; ?>alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/jquery.tmpl.js"></script> <!-- jquerytmpl -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/jquery.Storage.js"></script> <!-- Storage -->
        <!-- <link   rel="stylesheet" href="<?php echo $rootDir; ?>alerts/jquery.alerts.css" type="text/css" media="all" >  -->
        <link rel='stylesheet' href='<?php echo $jqueryui . 'css/ui-lightness/jquery-ui-1.10.0.custom.css'; ?>' type='text/css' media='all'/> 