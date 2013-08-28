<?php
require_once 'files/openid.php';
require_once("environment.php");
?>
<link rel='stylesheet' href='/files/css/zocial.css' type='text/css' media='all'/>
<?php
$openid = new LightOpenID("turtle.com");
 
$openid->identity = 'https://www.google.com/accounts/o8/id';
$openid->required = array(
  'namePerson/first',
  'namePerson/last',
  'contact/email',
    'pref/language',
);
$openid->returnUrl = 'http://turtle.com/loginopen.php'
?>
<a href="#" class="zocial google">Sign in</a>
 
<a href="<?php echo $openid->authUrl() ?>">Login with Google</a 