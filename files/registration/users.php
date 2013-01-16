<?php
    $relPath    =   "../bootstrap/twitter-bootstrap-sample-page-layouts-master/";
    $root       =   $_SERVER['DOCUMENT_ROOT'];
    if(!isset($_SESSION)){session_start();}
    $username   =   "Guest";
    if (isset ($_POST['username']))
        $username = $_POST['username'];
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

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <script src="<?php echo $relPath . 'scripts/jquery.min.js' ?>"></script>
    <script src="<?php echo  './../css/footer.css' ?>"></script>
    
    <script type='text/javascript'>
    $(document).ready(function(){
      $('#topbar').dropdown();
    });
    </script>
    
    <!-- Le styles -->
    <link href="<?php echo $relPath . 'styles/bootstrap.min.css' ?>" rel="stylesheet">
    <link rel='stylesheet' href='../css/footer.css' type='text/css' media='all'/> 
    <style type="text/css">
      body {
        padding-top: 60px;
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

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo $relPath . 'images/favicon.ico' ?>">
    <link rel="apple-touch-icon" href="<?php echo $relPath . 'images/apple-touch-icon.png' ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $relPath . 'images/apple-touch-icon-72x72.png' ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $relPath . 'images/apple-touch-icon-114x114.png' ?>">
  </head>

  <body>

    <div class="topbar">
      <div class="fill">
        <div class="container span18">
          <a class="brand" href="index.html">Project X</a>
          <ul class="nav">
            <li><a href="index.html">Home</a></li>
            <li class="active"><a href="index.html">Sample</a></li>
          </ul>
          
          <form class="pull-left" action="">
            <input type="text" placeholder="Search">
              <button class="btn" type="submit">Go</button>
          </form>        
          <p class="pull-right">Logged in as <a href="#">              
                 <?php
                    echo $username;
                 ?>
              </a></p>
        </div>
      </div>
    </div>

    <div class="container span18">
      <div class='cleaner_h40'></div>
      
      <div class='row'>
        <div class="well span4 sidebar">
            <h4>
                <?php
                    echo $username;
                ?>
            </h4>
            <div class='cleaner_h10'></div>
            
            <div class='btn primary large'>Post a new Ad</div>
            <div class='cleaner_h20'></div>
            
            <p><a href='account1.html'>Main</a></p>
            <p><a href='#'>Messages (3 new)</a></p>
            <p><a href='#'>Expired / Deleted Ads</a></p>
            <p><a href='account1.settings.html'>Account Settings</a></p>
            <p><a href='#'>Help</a></p>
        </div><!-- end of sidebar -->
        
        <div class='span14'>
          <h2>Your lessons</h2>
          <table class='zebra-striped ads'>
              <thead>
                  <tr>
                      <th class='span2'></th>
                      <th class='span4'>Title</th>
                      <th class='span4'>Action</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td class='mini-thumbnail'><img src='images/sample/car1.jpg'/></td>
                      <td>BMW M5</td>
                      <td>
                        <div class='btn small success disabled'>Renewed</div>
                        <div class='btn small info'>Edit</div>
                        <div class='btn small danger'>Remove</div>
                      </td>
                  </tr>
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
<?php



?>
