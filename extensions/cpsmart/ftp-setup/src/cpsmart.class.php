<?php namespace cypheralmasy;

use Gufy\CpanelPhp\Cpanel;

class CpSmart implements AutoSmart {

	/**
	*	@var array	Most recent error(s) from cPanel API
	*
	*/
	private $errors;

	/**
	*	@var mixed	Most recent (undecoded) response from the cPanel API
	*
	*/
	private $response;

	/**
	*	@var string cPanel username
	*
	*/
	private $username;

	/**
	*	@var string cPanel password
	*
	*/
	private $password;

	/**
	*	@var string cPanel server hostname or IP address
	*
	*/
	private $server;

	/**
	*	@var string	The domain for which SMART is being set up
	*
	*/
	private $domain;

	/**
	*	@var boolean Whether to allow HTTPS connections to cPanel, defaults to true
	*
	*/
	private $ssl = true;

	/**
	*	@var \Gufy\CpanelPhp\Cpanel Reference to the cPanel API object, used to make API calls
	*
	*/
	private $cpanel;

	/**
	*	@var string The IP address of the cPanel account
	*
	*/
	private $ipAddress;

	/**
	*	@var string The cPanel home directory (will usually be /home/$user, though some systems have this symlinked)
	*
	*/
	private $homedir;
	
	/**
	*	@var string The primary domain on the cPanel
	*
	*/
	private $mainDomain;

	/**
	*	@var array A list of FTP users on the cPanel account
	*
	*/
	private $ftplist = array();

	/**
	*	@var array A list of the domains on the cPanel acount, along with associated docroots
	*
	*/
	private $domlist = array();

	/**
	*	Class constructor.  Accepts an options array which must contain hostname, username, and password for the cPanel server.
	*
	*	@param array $options options for creation of object
	*/
	public function __construct($options = array()){
		if( ! empty($options)){
			if( ! empty($options['useSSL'])){
				$this->setUseSSL($options['useSSL']);
			}
	
			if(empty($options['username'])){
				throw new \Exception('No username provided');
			}

			if(empty($options['password'])){
				throw new \Exception('No password provided');
			}

			if(empty($options['server'])){
				throw new \Exception('No server provided');
			}

			$this->setLogin($options['server'], $options['username'], $options['password']);
		} else {
			throw new \Exception('No options provided; must provide options including username, password, and server');
		}
	}

	/**
	*	Get or set the current value of useSSL
	*
	*	@var	mixed	$newUseSSL	If provided a boolean, becomes the new value of useSSL.  If called with no arguments, returns current value of useSSL.
	*
	*	@return void|bool	Current value of useSSL if no arguments, or void if new value is set.
	*/
	public function useSSL($newUseSSL = null){
		if(func_num_args() === 0){
			return $this->ssl;
		} else {
			$this->ssl = $newUseSSL;
			$this->cpanel->setHost('http' . ($this->ssl ?  's' : '' ) . '://' . $this->server . ':208' . ($this->ssl ? '3' : '2'));
		}
	}

	/**
	*	Set the cPanel login details, reset $this->initialized to false
	*	
	*	@param string $server The cPanel server hostname or IP address
	*	@param string $username The cPanel username
	*	@param string $password The cPanel password
	*
	*	@return object self
	*/
	public function setLogin($server, $username, $password){
		$this->server = $server;
		$this->username = $username;
		$this->password = $password;
		$this->initialized = false;	
	
		return $this;
	}

	/**
	*	Set the site for which SMART is being set up
	*
	*	@param string $domain The domain name for the site
	*
	*	@throws \Exception if domain is not hosted on the cPanel
	*
	*	@return	void 
	*/
	public function setDomain($domain){
		$domColumn = array_column($this->domlist, 'domain');
		if(!in_array($domain, $domColumn)){
			throw new \Exception('Domain ' . $this->domain . ' does not appear to be hosted on this cPanel.');
		}
		$this->domain = $domain;
	}

	/**
	*	Get the domain for which SMART is being set up
	*
	*	@return string The domain name
	*/
	public function getDomain(){
		return $this->domain;
	}

	/**
	*	Get most recent errors from the API
	*
	*	@return	array	The array of errors
	*/
	public function getErrors(){
		return $this->errors;
	}

	/**
	*	Create the cPanel API object
	*
	*	@return void
	*/
	private function createCPanel(){
		if($this->useSSL()){
			$host = 'https://' . $this->server . ':2083';
		} else {
			$host = 'http://' . $this->server . ':2082';
		}

		$this->cpanel = new Cpanel([
			'host'		=> $host,
			'username'	=> $this->username,
			'password'	=> $this->password,
			'auth_type'	=> 'password'
		]);
	}

	/**
	*	Check provided authentication details for cPanel.  According to the cPanel forums
	*	(https://forums.cpanel.net/threads/php-cpanel-authentication-check.209742/), there's 
	*	no single way to check authentication, and since not all cPanel servers use 401 responses
	*	for authentication, I'm using the method recommended at the URL above: try calling 
	*	StatsBar::get_stats and see if it fails.  Since we need to use get_stats to retrieve the IP
	*	anyway, we'll store it if authentication succeeds.
	*
	*	@return boolean True for successful auth, false for failure
	*/
	private function checkAuth(){
		$result = $this->apiCall('StatsBar', 'get_stats', array(
			'display' => 'dedicatedip|sharedip'
		));
		if(!$result){
			return false;
		} else {
			$this->ipAddress = $result->result->data[0]->value;	
			return true;
		}
	}

	/**
	*	Calls a cPanel API function
	*	
	*	@param string $module The cPanel UAPI Module 
	*	@param string $function The cPanel UAPI Function
	*	@param array $params The parameters to pass with the API request
	*
	*	@throws \Exception if errors are returned from the API
	*
	*	@return mixed The decoded UAPI response JSON
	*/
	private function apiCall($module, $function, $params = array()){
		$response_json = $this->cpanel->execute_action(3, $module, $function, $this->username, $params);
		$this->response = $response_json;
		$response = json_decode($response_json);
		if($response === null){
			//unable to decode response, likely means client error thrown by Gufy\CpanelPhp object
			$this->errors = array($response_json);
			throw new \Exception('Errors returned from cPanel API');
		} else if($response->result->errors != null){
			//Indicates that cPanel encountered an error with the request
			$this->errors = $response->result->errors;
			throw new \Exception('Errors returned from cPanel API');
		}
		return $response;
	}

	/**
	*	Populate cPanel-specific information on the instance
	*
	*	@return null
	*/
	private function populateCpData(){
		//Get list of FTP users
		$ftp_result = $this->apiCall('Ftp','list_ftp', [
			'include_acct_types'	=>	'main|sub'
		]);

		$this->ftplist = $ftp_result->result->data;

		//Find the main FTP user to determine the absolute home directory for the cPanel
		$type_column = array_map(function($item){
				return $item->type;
			}, $this->ftplist);

		$main_index = array_search('main', $type_column);

		if($main_index === false){
			trigger_error('Unable to determine home directory via cPanel API; assuming /home/username', E_USER_WARNING);
			$this->homedir = '/home/' . $this->username;
		} else {
			$this->homedir = $this->ftplist[$main_index]->homedir;
		}

		//Populate domain information
		$dom_result = $this->apiCall('DomainInfo', 'domains_data', [
			'format' => 'list'
		]);

		$dom_data = $dom_result->result->data;
		$domains = array();

		foreach($dom_data as $dom){
			$domains[] = [
				'domain'	=>	$dom->domain,
				'type'		=>	$dom->type,
				'docroot'	=>	$this->getRelativePath($dom->documentroot),
			];
		}

		$this->domlist = $domains;
	}
	
	/**
	*	Get a relative path based on current homedir settings
	*
	*	@param string $path The absolute path to be converted
	*
	*	@return string The path relative to user's home directory
	*/
	private function getRelativePath($path){
		$pattern = '#^' . preg_quote($this->homedir) . '/?#';
		$relative = preg_replace($pattern, '', $path);
		if(strlen($relative) == 0){
			$relative = '.';
		} 

		return $relative;
	}

	/**
	*	Returns the docroot for the current domain
	*
	*	@return string	The docroot relative to the user's home directory
	*/
	private function getDocroot(){
		$domCol = array_column($this->domlist, 'docroot', 'domain');
		return $domCol[$this->domain];
	}

	/**
	*	Initialize the object with data from the remote cPanel server
	*
	*	@return void
	*
	*	@throws Exception if can't connect to cPanel
	*	@throws Exception if the domain is not set up on this cPanel
	*	@throws Exception if no login details have been provided
	*/
	public function initialize(){
		//Create the cPanel object
		$this->createCPanel();

		//If we can connect to cPanel, proceed to populate with cPanel data
		if($this->checkAuth()){ 
			$this->populateCpData();
		} else {
			throw new \Exception('Unable to connect to cPanel', 2400);			
		}
	}

	/**
	*	Creates an FTP user with the provided username and password for the current domain
	*
	*	@var	string	$login		The username for the FTP user.  Note cPanel will automatically append @maindomain.com to it
	*	@var	string	$password	The password for the FTP user.
	*
	*	@return	void
	*/
	public function createFtpUser($login, $password){
		$docroot = $this->getDocroot();
		
		$response = $this->apiCall('Ftp', 'add_ftp', [
			'user' => $login,
			'pass' => $password,
			'homedir'	=>	$docroot
		]);
	}

	/**
	*	Get the directories that need to be excluded for SMART downloads for this domain
	*
	*	@return	array	An array of directories that will need to be listed as exclusions in SMART config
	*/
	public function getExclusions(){
		$docroot = $this->getDocroot() . '/';
		$retval = array();
		foreach($this->domlist as $dom){
			if(stripos($dom['docroot'], $docroot) === 0){
				$retval[] = str_replace($docroot, '', $dom['docroot']) . '/';
			}	
		}
		return array_unique($retval);
	}

	/**
	*	Get the IP address listed in the cPanel 
	*
	*	@return	string	The account's IP address
	*/
	public function getIpAddress(){
		return $this->ipAddress;
	}

	/**
	*	Get a list of the domains hosted on this cPanel
	*
	*	@param	bool	$includeSubs	Whether to include subdomains in the returned array
	*
	*	@return	array	An array of domain names hosted on this account 
	*/
	public function getDomains($includeSubs = false){
		$fullList = array_column($this->domlist, 'type', 'domain');
		if($includeSubs){
			return array_keys($fullList);
		} else {
			return array_keys(array_filter($fullList, function($type){
				return $type != 'sub';
			}));
		}	
	}
}
