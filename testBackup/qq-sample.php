<?php
require_once "QQ.php";
session_start();

if( !isset( $_SESSION['qq'] ) ){
	$qq = new QQ();
	$qq->appId = '5395100281250.apps.googleusercontent.com'; 
	$qq->appKey = 'Q5slA-I8IsQWN8ibQmrfKWuO';
	$qq->redirectUri = 'http://www.turtleacademy.com/oauth2callback' ; //$_SERVER['HTTP_HOST'];

	$_SESSION['qq'] = $qq;
} else { 
	$qq = $_SESSION['qq'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php if( !isset( $_REQUEST['code'] ) && $qq->accessToken == null ){
	$qqLoginUrl = $qq->getLoginUrl( 'get_user_info,email' );
	$_SESSION['qq'] = $qq;
?>
<a href="<?php echo $qqLoginUrl?>">qq login</a>
<?php } else {
	if( !$qq->userInfo ){
		if( $qq->getToken() ){
			echo "Token:" . $qq->accessToken . "<br />";
			if( $qq->getUser() ){
				echo "OpenId:" . $qq->openId . "<br />";
?>
			<pre style="text-align:left;">
				<?=print_r( $qq->userInfo, true );?>
			</pre>
<?php		} else {
				print_r( $qq->error );
			}
		}
	} else {
	?>
	<pre style="text-align:left;">
		<?=print_r( $qq->userInfo, true );?>
	</pre>
	<?php
	}
}
?>

</body>
</html>
