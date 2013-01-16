<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    if(session_id() == '') 
        session_start();
    //if (!isset($_SESSION['username']))
    //        $_SESSION['username'] = "lucio";
    if ( !isset ($locale))
    {
        $locale = "en_US";
    }                 
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    $relPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";
    $ddPath     =   "files/test/dd/";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php
            echo _("Turtle Academy - learn logo programming in your browser");
//        אקדמיית הצב - למד תכנות לוגו היישר מתוך הדפדפן                
            $currentFile = $_SERVER["PHP_SELF"];
            $parts = Explode('/', $currentFile);
            $currentPage = $parts[count($parts) - 1];
        ?>         
        </title>   
        <script src="<?php echo $ddPath . 'js/jquery/jquery-1.8.2.min.js'?>"></script>
        <!-- <msdropdown> -->
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/dd.css'?>" />
        <script src="<?php echo $ddPath . 'js/msdropdown/jquery.dd.min.js'?>"></script>
        <!-- </msdropdown> -->

        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/skin2.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath .  'css/msdropdown/flags.css' ?>" /> 
        
         <!--        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'></script> --> 
        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js'></script>
        
   

</head>
<body>

   <select name="countries" id="countries" style="width:300px;">
      <option value='ad' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ad" data-title="Andorra">Andorra</option>
      <option value='ae' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ae" data-title="United Arab Emirates">United Arab Emirates</option>
    </select>
<script>

$(document).ready(function(e) {		
	//no use
	try {
		var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
												var val = data.value;
												if(val!="")
													window.location = val;
											}}}).data("dd");

		var pagename = document.location.pathname.toString();
		pagename = pagename.split("/");
		pages.setIndexByValue(pagename[pagename.length-1]);
		$("#ver").html(msBeautify.version.msDropdown);
	} catch(e) {
		//console.log(e);	
	}
	
	$("#ver").html(msBeautify.version.msDropdown);
		
	//convert
	$("select").msDropdown();
	createByJson();
	$("#tech").data("dd");
});
function showValue(h) {
	console.log(h.name, h.value);
}
$("#tech").change(function() {
	console.log("by jquery: ", this.value);
})
//
</script>

</body>
</html>
