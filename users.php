<?php
    
    if(session_id() == '') 
        session_start();
    if ( !isset ($locale))
    {
        $locale = "en_US";
        $_SESSION['locale'] = "en_US";
    } 
    $root       =   $_SERVER['DOCUMENT_ROOT'];
    if(!isset($_SESSION)){session_start();}
    $username   =   "Guest";
    if (isset ($_SESSION['username']))
        $username = $_SESSION['username'];
    require_once 'files/utils/userUtil.php';
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    //if (!isset($_SESSION['username']))
    //        $_SESSION['username'] = "lucio";

    //echo $root ;
    //require_once( $root ."/files/footer.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Account 1</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
         include_once("files/inc/dropdowndef.php");
         include_once("files/inc/jquerydef.php");
         include_once("files/inc/boostrapdef.php");
        if ($locale == "he_IL")
        {
                echo "<link rel='stylesheet' type='text/css' href='files/css/users_rtl.css' /> ";  
                echo "<link rel='stylesheet' type='text/css' href='files/css/topbar_rtl.css' /> "; 
        }
        $file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        $username = "Unknown";
        if (isset($_SESSION['username']))
            $username = $_SESSION['username'];
       
    ?>
     <link rel='stylesheet' href='./files/css/topbar.css' type='text/css' media='all'/>  
    <script type='text/javascript'>
    $(document).ready(function(){
        $('.dropdown-toggle').dropdown();
        //$.Storage.set("locale","<?php echo $_SESSION['locale']; ?>");
        try {
            var pages = $("#selectedLanguage").msDropdown({on:{change:function(data, ui) {
            var val = data.value;
            $.Storage.set("locale",val);
            if(val!="")
            {
                window.location.assign('users.php?l=' + val);          
            }
            }}}).data("dd");
            var pageIndex   =  $.Storage.get("locale");
            if (pageIndex == "")
                pageIndex   = "en_US";
            pages.setIndexByValue(pageIndex);
            } catch(e) {
                    console.log(e);	
            }
    }); 
    </script>
    <style type="text/css">
      .row{
          float:none;
      }
      #mainContainer{
           float:none;
      }
      #topbarContainer{
           float:none;
      }
      .sidebar.well.span4{
        width: 180px;
      }
      .ads tbody tr td{
        cursor:pointer !important;
      }
      .highlight td{
        font-weight:bold;
      }
      td.mini-thumbnail img{
        max-height:50px;
        max-width:100px;
      }
      td.mini-thumbnail{
        text-align:center;
      }
    </style>
  </head>

  <body>
        <?php  
            $class = ($locale == "he_IL" ?  "pull-right" :  "pull-left");    
            $login = ($locale != "he_IL" ?  "pull-right" :  "pull-left");    
        ?>
            <!-- Should be different for log in user and for a guest -->
            <div class="topbar" style="position: static;">
                <div class="fill">
                    <div class="container span16" id='topbarContainer' >  
                        <img class="brand" id="turtleimg" src="files/turtles.png" alt="צב במשקפיים">
                        
                        <ul class="nav" id="turtleHeaderUl"> 
                              <li><a href="index.php" ><?php echo _("TurtleAcademy");?></a></li> 
                             <!--<li class="active"><a href="index.html"><?php echo _("Sample");?></a></li> -->
                        </ul> 
                        <form class="<?php  
                                            echo $class . " form-inline";                                
                                     ?>" action="" id="turtleHeaderLanguage">  
                            <select name="selectedLanguage" id="selectedLanguage" style="width:120px;">
                                <option value='en_US' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">English</option>
                                <option value='es_AR' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Español</option>
                                <option value='he_IL' data-image="Images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">עברית</option>
                                <option value='zh_CN' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">中文</option>
                            </select>
                        </form>       
                        <?php
                            if (isset($_SESSION['username']))
                            {
                        ?>                       
                                    <nav class="<?php echo $login ?>"  id="turtleHeaderLoggedUser">
                                        <ul class="nav nav-pills <?php echo $login ?>" id="loggedUserUl">
                                            
                                            <li style="padding: 10px 10px 11px;" id='loggedUserLI'> <?php echo _("Hello");?></li>
                                            <li class="cc-button-group btn-group"> 
                                                <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" >
                                                <?php
                                                    echo $_SESSION['username'];
                                                ?>
                                                </a>
                                                <ul class="dropdown-menu" id="ddmenu"role="menu" aria-labelledby="dLabel">
                                                    <li><a tabindex="-1" href="users.php"   class="innerLink" id="help-nav"><?php echo _("My account");?></a></li>
                                                    <li><a tabindex="-1" href="/docs" class="innerLink" id="hel-nav"><?php echo _("Help");?></a></li>
                                                    <li><a href="logout.php" class="innerLink"><?php echo _("Log out");?></a></li>
                                                </ul>
                                            </li>
                                        </ul> 
                                    </nav>                                                                     

                        <?php
                            }
                            else
                            {

                        ?>       
                                <ul class="nav <?php echo $login ?>" id="turtleHeaderUl">  
                                    <li><a href="registration.php" style="color:gray;" ><?php echo _("Login");?></a></li> 
                                </ul>                         
                         <?php
                            }
                         ?>
                    </div>
                </div>             
            </div> <!-- End of Top menu -->


    <div class="container span16" id="mainContainer">
      <div class='cleaner_h40'></div>
      
      <div class='row'>
        <div class="well span4 sidebar">
            <h4>
                <?php
                    echo $username;
                ?>
            </h4>
            <div class='cleaner_h10'></div>
            
            
            <p><a href='#'><?php echo _("Messages"); echo "(" ; echo _("coming soon"); echo ")"; ?></a></p>
            <p><a href='#'><?php echo _("Account Settings"); echo "(" ; echo _("coming soon"); echo ")"; ?></a></p>
            <p><a href='lesson.php'><?php echo _("Add a new lesson"); ?></a></p>
            <p><a href='#'>Help</a></p>
        </div><!-- end of sidebar -->
        
        <div class='span16'id="usrLessonDiv"> 
          <h2><?php echo _("Your lessons"); ?></h2>
          <table class='zebra-striped ads'>
              <thead>
                  <tr>
                      <th class='span2'></th>
                      <th class='span4'><?php echo _("Title"); ?></th>
                      <th class='span4'><?php echo _("Action"); ?></th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                        $userLessons    =   userUtil::showUserLessons($username);
                        foreach ($userLessons as $lesson)
                        {
                  ?>
                  
                  <tr>
                      <td class='mini-thumbnail'></td>
                      <td><?php echo $lesson['title']['locale_en_US'] ?></td>
                      <td>
                        <!--<div class='btn small success disabled'>Renewed</div> -->
                        <a class='btn small info' href="lesson.php?lesson=<?php echo $lesson['_id']; ?> ">  <?php echo _("Edit"); ?></a>
                        <!--<div class='btn small danger'>Remove</div> -->
                      </td>
                  </tr>
                  <?php
                        } 
                  ?>
              </tbody>  
          </table>
        </div><!-- end of center content -->
      </div>
      <?php
        if (isset ($footer))
            echo $footer ;
       ?>
      <!-- <footer>
        <p>&copy; Company 2011 <a href='http://www.sherzod.me' target='_blank' title='Professional Web Developer'>Sherzod Kutfiddinov</a></p>
      </footer> -->
    </div>

  </body>
</html>
