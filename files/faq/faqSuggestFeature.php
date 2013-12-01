<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();
$phpDirPath = "../registration/inc/php/";
include_once $phpDirPath . 'config.php';
include_once $phpDirPath . 'functions.php';
require_once ('../../environment.php');
require_once ("../../localization.php");
require_once ('../utils/topbarUtil.php');
require_once("faqSideNav.php");

?>
<html dir="<?php echo $dir ?>" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Report a Problem</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        echo "<link rel='stylesheet' type='text/css' href='" . $rootDir . "files/css/registration.css' /> ";

        require_once("../utils/includeCssAndJsFiles.php");
        ?>     
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/zocial.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='../css/faq.css' type='text/css' media='all'/>
        <script src="<?php echo $rootDir; ?>ajax/libs/jquery/validator/dist/jquery.validate.js" type="text/javascript"></script>
        <script type='text/javascript'> 
            $(document).ready(function(){
                var gt = new Gettext({'domain' : 'messages'});
                $('#topbar').dropdown();
                $('#username_in').focus();
                $('#username_in').focus();
                $("#submit-comment-form").validate({
                    
                    rules: {
                        
                        feature: {
                            required: true, 
                            minlength: 3
                        },
                        
                        email: {
                            required: true,
                            email: true
                        }
                        
                    },
                    messages: {
                        
                        feature: {
                            required: gt.gettext("Please enter the comment content"), 
                            minlength: gt.gettext("Content should contain at least 3 Characters")
                        },
                        email: {
                            required: gt.gettext("Please enter your email address"),
                            minlength: gt.gettext("Please enter a valid email address")
                        }
                    }
                });                   
            });

        </script>
        
    </head>
    <body>
        <?php
            topbarUtil::printTopBar("faq");
        ?>
        <div id="main" >
            <div id="container">
                <div id="faq-comment-main" class="span16">
                <h3>
                    Suggest a feature
                </h3>
                <div id="form">
                    <form class='form-stacked' id='submit-comment-form' method="post" action="faqSaveComment.php">
                        <div class="form-block">
                            <span class="faq-form-label"> Email Address </span>
                            <span class="faq-form-required"> (Required)</span>
                            <div class="input">
                                <input id="email" name="email" type="text"> </input>
                            </div>
                        </div>    
                        <div class="form-block">
                            <span class="faq-form-label"> Feature suggestion</span>
                            <span class="faq-form-required"> (Require)</span> 
                            <div class="input">
                                <textarea id="feature" name="feature" col="6" rows="6"></textarea>
                            </div>
                        </div>   
                        <input type='submit' value='<?php echo _("Submit"); ?>' id='signup' name='signup' class="btn primary"/>
                    </form>
                </div> <!-- Close form div -->
                </div>
                <?php
                    echo $sideNav;
                ?>
            </div> <!-- Close container div-->
        </div> <!-- Close main div-->    
    </body>