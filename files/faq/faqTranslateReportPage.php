
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
    <?php
    require_once("../../environment.php");
    require_once("../../localization.php");
    require_once("../footer.php");
    require_once('../utils/topbarUtil.php');
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
        require_once("../utils/includeCssAndJsFiles.php"); 
            includeCssAndJsFiles::include_all_page_files("faqadmin"); 
        echo "<link rel='stylesheet' href='../css/index.css' type='text/css' media='all'/>";

        // Case user logged in we will clear the storage data and load it from db
        $is_user_log_in = isset($_SESSION['username']);
        if ($is_user_log_in) {
            ?>   
            <script type="application/javascript" src="<?php echo $root_dir; ?>clearStorageData.php"></script>
            <?php
        }
        ?>
           <!-- <link rel='stylesheet' href='../css/faq.css' type='text/css' media='all'/> -->
    </head>
    <body>      
            <?php
                //Printing the topbar menu
                topbarUtil::print_topbar("index");
                //Get fuc items
                $m                  = new Mongo();
                $db                 = $m->turtleTestDb;
                $strcol             = $db->faq;
                $faqs               = $strcol->find();

                
                $faqs->sort(array('type' => 1));
                foreach ($faqs as $faq)
                { 
                    echo "<div>";
                        echo "<span>";
                        ?>
                            <a href="<?php echo $root_dir; ?>files/faq/faqTranslateItem.php?faqItem=<?php echo $faq['id']; ?>&&l=<?php echo $locale;?>"><?php echo  $faq['question']['en_US']; ?></a>
                        <?php
                        echo "</span>";    
                    echo "</div>";
                    
                }
            ?>
      

        <script> 
            $(document).ready(function() {
                selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $root_dir; ?>language/", "index.php" ,"en" ); 
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
    </body>
</html> 