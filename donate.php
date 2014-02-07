
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
    <?php
    require_once("environment.php");
    require_once("localization.php"); 
    require_once("files/footer.php");
    require_once('files/utils/topbarUtil.php');
    ?>
<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            <?php
            echo _("Turtle Academy - learn logo programming in your browser");
            echo _(" free programming materials for kids");
            ?>  
        </title>     
        <?php
        require_once("files/utils/includeCssAndJsFiles.php"); 
        includeCssAndJsFiles::include_all_page_files("donate"); 
        
        // Case user logged in we will clear the storage data and load it from db
        $is_user_log_in =   isset($_SESSION['username']);

        ?>
    </head>
    <div id="index-main">
        <!--Should be different for log in user and for a guest -->
    <?php
        //Printing the topbar menu
        topbarUtil::print_topbar("index");
    ?>
        <div id="donation_title">
            <div id="donation_main" class="span12">
                <h1>
                    <?php
                        echo _("Please donate to help us keep Turtle Academy advertisment free");
                    ?>
                </h1>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="ZWREJAKDKRQ84">
                    <input type="image" src="https://www.paypalobjects.com/en_US/IL/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>


        <?php echo $footer; ?>

    </div> <!-- End of main index-->
   
    <script> 

        
        $(document).ready(function() {
            selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $root_dir; ?>donate/", "donate.php" ,"en" ); 
            // Definition for people opinion carousel
            $('.carousel').carousel({
                interval: 15000 
            })
            $("#myCarousel").carousel('cycle');
            $('#myCarousel').hover(function () {   
                $(this).carousel('pause')
                $(this).carousel(0)
            })
            // End of Definition for people opinion carousel
        });
    </script>
</html> 

