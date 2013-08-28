<?php 
class QQ
{
	public $appId;
	public $appKey;
	public $redirectUri;
	public $state;
	public $accessToken;
	public $openId;
	public $userInfo;
	
	public $error;

	public function __construct()
	{

	}

	public function getLoginUrl( $scope )
	{
		$this->state = md5( uniqid( rand(), TRUE ) );
		
		$url = 'https://graph.qq.com/oauth2.0/authorize';
		$urlParams = array( 'response_type' => 'code',
							'client_id' => $this->appId,
							'redirect_uri' => urlencode( $this->redirectUri ),
							'state' => $this->state,
							'scope' => $scope );
		return $url . '?' . http_build_query( $urlParams );
	}
	
	public function getToken( $code = null, $state = null )
	{
		if( $code == null ){
			$code = $_REQUEST['code'];
		}
		if( $state == null ){
			$state = $_REQUEST['state'];
		}

		if( $state == $this->state ){
			$tokenUrl = 'https://graph.qq.com/oauth2.0/token';
			$tokenUrlParams = array( 'grant_type' => 'authorization_code',
										'client_id' => $this->appId,
										'redirect_uri' => urlencode( $this->redirectUri ),
										'client_secret' => $this->appKey,
										'code' => $code );
			$tokenUrl .= '?' . http_build_query( $tokenUrlParams );

			$response = file_get_contents( $tokenUrl );
			if( strpos( $response, 'access_token' ) !== false ){
				parse_str( $response, $qqToken );
				$this->accessToken = $qqToken['access_token'];
				return true;
			} else {
				$lpos = strpos( $response, '(' );
	            $rpos = strrpos( $response, ')' );
				$msg = json_decode( substr( $response, $lpos + 1, $rpos - $lpos -1 ) );
				$this->error = $msg;
				return false;
			}
		} else {
			$this->error = 'state mismatch';
			return false;
		}
	}
	
	public function getUser()
	{
		$userUrl = 'https://graph.qq.com/oauth2.0/me?access_token=' . $this->accessToken;
		$user = file_get_contents( $userUrl );
		$lpos = strpos( $user, '(' );
		$rpos = strrpos( $user, ')');
		$user  = json_decode( substr( $user, $lpos + 1, $rpos - $lpos -1 ) );
		if( @$user->openid ){
			$this->openId = $user->openid;
			$userInfoUrl = 'https://graph.qq.com/user/get_user_info';
			$userInfoUrlParams = array( 'access_token' => $this->accessToken,
										'oauth_consumer_key' => $this->appId,
										'openid' => $user->openid );
			$userInfo = file_get_contents( $userInfoUrl . '?' . http_build_query( $userInfoUrlParams ) );
			$userInfo  = json_decode( $userInfo );
			$this->userInfo = $userInfo;
		} else {
			return false;
		}
		return true;
	}
}
?>