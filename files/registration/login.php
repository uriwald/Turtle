<?php
	//login.php
	session_start(); //Start the session
	if(isset($_SESSION['ERRMSG']) && is_array($_SESSION['ERRMSG']) && count($_SESSION['ERRMSG']) >0 ) { //If the error session exists
		$err = "<table>"; //Start a table
		foreach($_SESSION['ERRMSG'] as $msg) { //Get each error
			$err .= "<tr><td>" . $msg . "</td></tr>"; //Write them to a variable
		}
		$err .= "</table>"; //Close the table
		unset($_SESSION['ERRMSG']); //Delete the session
	}
?>
<html>
	<head>
            <meta charset="utf-8">
            <title>Login &amp; Sign Up Page 1</title>
            <meta name="description" content="">
            <meta name="author" content="">

            <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
            <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

            <script src="../bootstrap/twitter-bootstrap-sample-page-layouts-master/scripts/jquery.min.js"></script>
            <script src="../bootstrap/twitter-bootstrap-sample-page-layouts-master/scripts/bootstrap-dropdown.js"></script>

            <script type='text/javascript'>
            $(document).ready(function(){
            $('#topbar').dropdown();

            $('#username_in').focus();
            });

            $(document).delegate('.switch', 'click', function(){

            var c = $(this).attr('data-switch');
            $('#sign-in-form').slideUp(300, function(){ $(this).addClass('hide'); });
            $('#forgot-password-form').slideUp(300, function(){ $(this).addClass('hide'); });
            $('#'+c).slideDown(300, function(){
                $(this).removeClass('hide');
                $('input:first', this).focus();
            });
            c = null;

            });
            </script>

            <!-- Le styles -->
            <link href="../bootstrap/twitter-bootstrap-sample-page-layouts-master/styles/bootstrap.min.css" rel="stylesheet">
            <style type="text/css">
            body {
                padding-top: 60px;
            }
            .switch{
                display:inline-block;
                cursor:pointer;
            }
            </style>

            <!-- Le fav and touch icons -->
            <link rel="shortcut icon" href="../bootstrap/twitter-bootstrap-sample-page-layouts-master/images/favicon.ico">
            <link rel="apple-touch-icon" href="../bootstrap/twitter-bootstrap-sample-page-layouts-master/images/apple-touch-icon.png">
            <link rel="apple-touch-icon" sizes="72x72" href="../bootstrap/twitter-bootstrap-sample-page-layouts-master/images/apple-touch-icon-72x72.png">
            <link rel="apple-touch-icon" sizes="114x114" href="../bootstrap/twitter-bootstrap-sample-page-layouts-master/images/apple-touch-icon-114x114.png">
	</head>
	<body>
            <?php
                if (isset ($_SESSION['ERRMSG']))
                    echo $_SESSION['ERRMSG'];
                else echo "dds";
            ?>
		<form action='log.php' method='post'>
			<table align="center">
				<tr>
					<td><?php if(isset($_SESSION['ERRMSG'])) echo $err; ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type='text' name='username'></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type='password' name='password'></td>
				</tr>
				<tr>
					<td><input type='submit' value='Login'></td>
					<td><a href="register.php">Register</a></td>
				</tr>
			</table>
		</form>
            
    <div class="well span5">
      <form class='form-stacked' id='sign-in-form' action='log.php' method='post'>
            <h2>Sign In</h2>
            
            <div class='cleaner_h20'></div>
            
            <div class="clearfix">
              <label for="username_in">Username</label>
              <div class="input">
                <input id="username" name="username" size="30" type="text"/>
                <!--
                <span class="help-block">
                  <span class='label important'>Warning</span> the username already exists
                </span>
                -->
              </div>
            </div>
            
            <div class="clearfix">
              <label for="pwd_in">Password</label>
              <div class="input">
                <input type='password' id="password" name="password" size="30" type="text"/>
                <!--
                <span class="help-block">
                  <span class='label important'>Warning</span> too easy - even I can guess it
               </span>
              -->
              </div>
            </div>
            
            <ul class="inputs-list">
              <li>
                <label>
                  <input type="checkbox" name="remember_in" id='remember_in' value="yes" checked='true' />
                  <span for='remember_in'>Remember me</span>
                </label>
              </li>
            </ul>
            
            <div class='cleaner_h20'></div>
            <input type='submit' value='Sign In &raquo;' id='submit_in' name='submit_in' class="btn primary"/>
            <span class='switch' data-switch='forgot-password-form'>Forgot my password</span>
          </form>
          
          <form class='form-stacked hide' id='forgot-password-form'>
            <h2>Forgot Password</h2>
            
            <div class='cleaner_h20'></div>
            
            <div class="clearfix">
              <label for="email_pwd">Email</label>
              <div class="input">
                <input id="email_pwd" name="email_pwd" size="30" type="text"/>
                <!--
                <span class="help-block">
                  <span class='label important'>Warning</span> the username already exists
                </span>
                -->
                <div class='cleaner_h10'></div>
                <span class='switch' data-switch='sign-in-form'>Never mind, I remember my password</span>
              </div>
            </div>
            
            <div class='cleaner_h20'></div>
            <input type='submit' value='Remind me &raquo;' id='submit_pwd' name='submit_pwd' class="btn primary"/>
          </form>
        </div> 
	</body>
</html>
