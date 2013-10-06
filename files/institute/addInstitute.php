<html>
    <?php
        require_once("../../environment.php");
        require_once("../../localization.php"); 
        require_once("../footer.php");
        require_once('../utils/topbarUtil.php');
    ?>
    <head>
        <?php
            require_once("../utils/includeCssAndJsFiles.php"); 
            echo "<link rel='stylesheet' href='../css/institute.css' type='text/css' media='all'/>";
        ?>
    </head>
        
    <body> 
        <h4>Add institute</h4>
        <form action="saveInstitute.php" method="post"> 
            <div>
                <span> Institute name : </span> <span> <input name="name" type="text" /> </span>
            </div>
            <div>
                <span> Institute email : </span> <span> <input name="email" type="text" /> </span>
            </div>
            <div>
                <span>Institute permission :  </span><span> <input name="permission" type="text" /> </span>
            </div>
            <div>
                <span>Institute description :  </span><span> <input name="desc" type="text" /> </span>
            </div>
            <input type="submit" />
        </form>      
    </body>
</html>