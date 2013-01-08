<?php

include_once 'inc/php/config.php';
include_once 'inc/php/functions.php';
require_once ($_SERVER['DOCUMENT_ROOT'] .'/environment.php');
?>
  <head>
    <meta charset="utf-8">
    <title>Login &amp; Sign Up Page 1</title>
    <meta name="description" content="">
    <meta name="author" content="">

    
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements c -->
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
<?php  

//setup some variables/arrays
$action = array();
$action['result'] = null;

$text = array();

//check if the form has been submitted
if(isset($_POST['signup'])){

	//cleanup the variables
	//prevent mysql injection
        /*
            $username = mysql_real_escape_string($_POST['username']);
            $password = mysql_real_escape_string($_POST['password']);
            $email = mysql_real_escape_string($_POST['email']);
	*/
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email =    $_POST['email'];
	//quick/simple validation
	if(empty($username)){ $action['result'] = 'error'; array_push($text,'You forgot your username'); }
	if(empty($password)){ $action['result'] = 'error'; array_push($text,'You forgot your password'); }
	if(empty($email)){ $action['result'] = 'error'; array_push($text,'You forgot your email'); }
        //print_r($action);
	
	if($action['result'] != 'error'){
				
		$password = md5($password);	
                
                $m = new Mongo();

                $db = $m->turtleTestDb;	

                $users = $db->user_test;

                $userQuery       = array('email' => $email ,"confirm" => true);
                $userExist     = $users->count($userQuery);
                if ($userExist > 0 )
                {
                    $action['result'] = 'error'; 
                    array_push($text,'Email is already bieng used');
                }
		//add to the database
		//$add = mysql_query("INSERT INTO `users` VALUES(NULL,'$username','$password','$email',0)");
                $userStructure = array("username" => $username, "password" => $password, "email" => $email , "confirm" => false);
                $userResult = $users->insert($userStructure, array('safe' => true));
                $userid = $userStructure['_id'];		
		if($userResult){
			
			//get the new user id
			//$userid = mysql_insert_id();
			
                        $users = $db->user_test_confirm;
			//create a random key
                        //$key = $username . $email . date('mY');
			$key = $username . $email ;
			$key = md5($key);
			
			//add confirm row
			//$confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')");	
                        $userStructure = array("userid" => $userid, "key" => $key, "email" => $email );
                        $userConfirmResult = $users->insert($userStructure, array('safe' => true));
			
			if($userConfirmResult){
			
				//include the swift class
				include_once 'inc/php/swift/swift_required.php';
			
				//put info into an array to send to the function
				$info = array(
					'username' => $username,
					'email' => $email,
					'key' => $key);
			
				//send the email
				if(send_email($info , $sitePath)){
                                
				//if(send_email_test($info)){				
					$action['result'] = 'success';
					array_push($text,'Thanks for signing up. Please check your email for confirmation!');
				
				}else{
					
					$action['result'] = 'error';
					array_push($text,'Could not send confirm email');
				
				}
			
			}else{
				
				$action['result'] = 'error';
				//array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
                                array_push($text,'Confirm row was not added to the database. Reason: ' );
				
			}
			
		}else{
		
			$action['result'] = 'error';
			array_push($text,'User could not be added to the database. Reason: ' . mysql_error());
		
		}
	
	}
	
	$action['text'] = $text;

}

?>

<?php
include 'inc/elements/header.php'; ?>

<?php echo show_errors($action);?>
  
<!--
<form class='form-stacked' method="post" action="">
    <fieldset>    
    	<ul>
    		<li>
    			<label for="username">Username:</label>
    			<input type="text" name="username" />
    		</li>
    		<li>
    			<label for="password">Password:</label>
    			<input type="password" name="password" />
    		</li>
    		<li>
    			<label for="email">Email:</label>
    			<input type="text" name="email" />	
    		</li>
    		<li>
    			<input type="submit" value="Signup Now" class="large blue button" name="signup" />			
    		</li>
    	</ul>   	
    </fieldset>  
</form>	
-->
      <div class="container">
      <div class='row'>
  <div class="well span6 offset2">
          <form class='form-stacked' id='sign-up-form' method="post" action="">
            <h2>Sign Up for Free</h2>
            
            <div class='cleaner_h20'></div>
            
            <div class="clearfix">
              <label for="email">Email</label>
              <div class="input">
                <input id="email" name="email" size="30" type="text" class='xlarge'/>
                <!--
                <span class="help-block">
                  <span class='label important'>Warning</span> incorrect email address
               </span>
                --> 
              </div>
            </div>
            
            <div class="clearfix">
              <label for="username">Username</label>
              <div class="input">
                <input id="username" name="username" size="30" type="text" class='xlarge'/>
                <!--
                <span class="help-block">
                  <span class='label important'>Warning</span> the username already exists
                </span>
                -->
              </div>
            </div>
            
            <div class="clearfix">
              <label for="password">Password</label>
              <div class="input">
                <input id="password" name="password" size="50" type="text" class='xlarge'/>
                <!--
                <span class="help-block">
                  <span class='label important'>Warning</span> too easy - even I can guess it
               </span>
              -->
              </div>
            </div>
            
            <div class='cleaner_h10'></div>
            
            <ul class="inputs-list">
              <li>
                <label>
                  <input type="checkbox" name="terms_up" id='terms_up' value="yes" checked='true' />
                  <span for='terms_up'>Agree to <a href='#'>Terms of Use</a></span>
                </label>
              </li>
            </ul>
            
            <div class='cleaner_h20'></div>
            <input type='submit' value='Sign Up &raquo;' id='signup' name='signup' class="btn primary"/>
          </form>
  </div>
  </div> 
            </div>