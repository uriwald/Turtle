<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php 
    
    if (!isset ($root_dir))
        $root_dir = "/";
    $jqueryui = $root_dir."ajax/libs/jqueryui/1.10.0/";
    
?>
        <script src="/files/dd/js/jquery/jquery-1.8.2.min.js"></script>
        <script  type="text/javascript" src="<?php echo $jqueryui . 'js/jquery-ui-1.10.0.custom.js'; ?>"></script> <!--- equal to googleapis -->
       
        <script  type="text/javascript" src="<?php echo $root_dir; ?>alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="<?php echo $root_dir; ?>files/jquery.tmpl.js"></script> <!-- jquerytmpl -->
        <script type="application/javascript" src="<?php echo $root_dir; ?>files/jquery.Storage.js"></script> <!-- Storage -->
        <!-- <link   rel="stylesheet" href="<?php echo $root_dir; ?>alerts/jquery.alerts.css" type="text/css" media="all" >  -->
        <link rel='stylesheet' href='<?php echo $jqueryui . 'css/ui-lightness/jquery-ui-1.10.0.custom.css'; ?>' type='text/css' media='all'/> 