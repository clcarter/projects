<?php

class RetrieveSharepoint {
	public $useTable = false; // This model does not use a database table
//Build the URL & Request JSON format
	private $data,$url,$attachments; 
	private $loginDomain = "";
	private $loginUser = "";
	private $loginPath = "C:\\xampp\htdocs\projects\app\Config";
	
	function __construct($url){
		$this->url = $url;
		$this->curlSetup();
	}

	private function curlSetup(){
		$file = file_get_contents($this->loginPath.'\sharePointDom');
		$loginDomain = $this->decrypt($file);
		$loginUser = 'ucartc3';
		$loginUser = $this->encrypt($loginUser);
		file_put_contents($this->loginPath.'\sharePointUsr',$loginUser);
		$file = file_get_contents($this->loginPath.'\sharePointUsr');
		$loginUser = $this->decrypt($file);
		$file = file_get_contents($this->loginPath.'\sharePointPwd');
		$loginPass = $this->decrypt($file);
		$login = $loginDomain . "/" . $loginUser . ":" . $loginPass;
		print $login;
		$mycurl = curl_init();
		curl_setopt($mycurl, CURLOPT_HEADER, 0);
		curl_setopt($mycurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($mycurl, CURLOPT_URL, $this->url);
		curl_setopt($mycurl, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);    // Optional only if the sharepoint requires authentication
		curl_setopt($mycurl, CURLOPT_USERPWD, $login);            // Optional only if the sharepoint requires authentication
		curl_setopt($mycurl, CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
		curl_setopt($mycurl, CURLOPT_HTTPHEADER,array('Accept: application/json;odata=verbose'));
		curl_setopt($mycurl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($mycurl, CURLOPT_SSL_VERIFYHOST, FALSE);
		$webResponse =  curl_exec($mycurl);
		$this->parseResponse($webResponse);
	}
	private function parseResponse($webResponse){
		$needle = 'g_objCurrentFormData_ctl00_m_g_2d2915f6_3278_44b6_a0a7_72e558ca56c1_FormControl0';
		$needle2 = '[';
		$end = ';';
		$pos = strpos($webResponse,$needle);
		
		$sub = substr($webResponse,$pos);
		$pos = strpos($sub,$needle2);
		$sub = substr($sub,$pos);
		$pos = strpos($sub,$end);
		$extra = substr($sub,$pos);
		$sub = substr($sub,0,$pos);
		$enc = json_decode($sub);
		$this->setUpData($enc);
	}
	
	private function setUpData($enc) {
		$data = $enc[1][1][0][0][1][2];
		$attachmentData = array();
		$attachments = $data[10][1][0];
		$keyedData = array('requestor' => 0,'request_date' => 1,'deadline' => 3,'priority' => 5,'program' => 6,'type' => 7,'title' => 8,'description' => 9,'status' => 11,'completetion_date' => 12,'notes' => 14);
		
		foreach($keyedData as $key => $val){
			$keyedData[$key] = $data[$val][1][1][0];
		}
		
		if(!empty($attachments)){
			for($i = 0, $ii = count($attachments); $i < $ii; $i++){
				array_push($attachmentData,$attachments[$i][1][1][0]);
			}
		}
		
		$this->attachments = $attachmentData;
		$this->data = $keyedData;
	}
	
	public function getData(){
		return array('Project' => $this->data, 'Attachments' => $this->attachments);
	}
	
	public function refresh(){
		$this->curlSetup();
	}
	
	

	private function encrypt($plaintext)
	{
		require_once('C:\xampp\htdocs\projects\app\Config\sharePointCypher');
		$td = mcrypt_module_open(CYPHER, '', MODE, '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, KEY, $iv);
		$crypttext = mcrypt_generic($td, $plaintext);
		mcrypt_generic_deinit($td);
		return base64_encode($iv.$crypttext);
	}

	private function decrypt($crypttext)
	{
		require_once('C:\xampp\htdocs\projects\app\Config\sharePointCypher');
		$crypttext = base64_decode($crypttext);
		$plaintext = '';
		$td        = mcrypt_module_open(CYPHER, '', MODE, '');
		$ivsize    = mcrypt_enc_get_iv_size($td);
		$iv        = substr($crypttext, 0, $ivsize);
		$crypttext = substr($crypttext, $ivsize);
		if ($iv)
		{
			mcrypt_generic_init($td, KEY, $iv);
			$plaintext = mdecrypt_generic($td, $crypttext);
		}
		return trim($plaintext);
	}
}
$rs = new RetrieveSharepoint('http://christopher-carter.com');

