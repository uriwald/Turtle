<div class="topbar" id="topbarMainDiv"> 
    <div class="fill" id="topbarfill">
        <div class="container span13" id="topbarContainer"> 
            <img class="brand" id="turtleimg" src="files/turtles.png" alt="צב במשקפיים">

            <ul class="nav" id="turtleHeaderUl"> 
                <li><a href="<?php echo $rootDir; ?>index.php" style="color:gray;" ><?php echo _("TurtleAcademy"); ?></a></li> 
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
            if (isset($_SESSION['username'])) {
                ?>                       
                        <!--  <p class="pull-right">Hello <a href="#"> -->
                <nav class="<?php echo $login ?>" style="width:200px;" id="turtleHeaderLoggedUser">
                    <ul class="nav nav-pills <?php echo $login ?>" id="loggedUserUl">

                        <li style="padding: 10px 10px 11px;"> <?php echo _("Hello"); ?></li>
                        <li class="cc-button-group btn-group"> 
                            <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" style="color:#ffffff; background-color: rgba(0, 0, 0, 0.5);" >
                                <?php
                                echo $_SESSION['username'];
                                ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" id="ddmenu"role="menu" aria-labelledby="dLabel">
                                <li><a tabindex="-1" href="/docs"   class="innerLink" id="help-nav"><?php echo _("My account"); ?></a></li>
                                <li><a tabindex="-1" href="/docs" class="innerLink" id="hel-nav"><?php echo _("Help"); ?></a></li>
                                <li><a href="logout.php" class="innerLink"><?php echo _("Log out"); ?></a></li>
                            </ul>


                        </li>
                    </ul> 
                </nav>                                                                     
                </a>

                <?php
            } else {
                
            }
            ?>
        </div>
    </div> <!-- Ending fill barf -->
</div> <!-- Ending top bar -->