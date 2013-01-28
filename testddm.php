
<!DOCTYPE html>
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
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link href="<?php echo $relPath . 'styles/bootstrap.min.css' ?>" rel="stylesheet"> 
        <script src="<?php echo $ddPath . 'js/jquery/jquery-1.8.2.min.js'?>"></script> 
        <script  type="text/javascript" src="ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script> <!--- equal to googleapis -->

       
         <script type="application/javascript" src="<?php echo $relPath . 'scripts/bootstrap-dropdown.js' ?>"></script><!-- -->
        <script type="application/javascript" src="files/bootstrap/js/bootstrap.js"></script> <!-- Storage -->
         <script type="application/javascript" src="files/bootstrap/js/bootstrap.min.js"></script> <!-- Storage -->
                     <script>
            $(document).ready(function() {
                        $('.dropdown-toggle').dropdown();
                                  
            });
        </script> 
    </head>               
    <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container" style="width: auto;">

            <a class="brand" style="text-indent: 3em" href="#">
                Title
            </a>

            <ul class="nav">
                <li><a href="#">Profile</a></li>
                <li class="active"><a href="#">Statistics</a></li>
                <li><a href="#">Reader</a></li>

                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
                    Options
                    <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>

            </ul>


        </div>
    </div>
</div>

   
                                <nav>
                                    <ul class="nav nav-pills">
                                        <li class="dropdown"> 
                                         
                                            <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" style="color:black;" >
                                                Dropdown
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                <li><a tabindex="-1" href="/docs"  id="help-nav">My account</a></li>
                                                <li><a tabindex="-1" href="/docs" id="hel-nav">Help</a></li>
                                            </ul>
                                         
                                
                                        </li>
                                    </ul> 
                                </nav>
