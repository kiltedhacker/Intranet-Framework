<?php namespace cypheralmasy;

interface AutoSmart {

	/**
	*	Set the current domain
	*
	*	@param	string	$domain		The domain to set
	*
	*	@return	void
	*/
	public function setDomain($domain);
	
	/**
	*	Create an FTP user with provided login and password for the currently set domain
	*
	*	@param	string	$login		The requested username
	*	@param	string	$password	The requested password
	*
	*	@return void
	*/
	public function createFtpUser($login, $password);

	/**
	*	Get a list of directories which should be excluded in the SMART configuration (generally other domain docroots)
	*
	*	@return array	An array of strings containing the docroots (relative to the domain root) to be excluded
	*/
	public function getExclusions();
	
	/**
	*	Get the IP address to be used for the SMART host
	*
	*	@return	string		The IP address of the server for SMART setups
	*/
	public function getIpAddress();

	/**
	*	Get a list of domains that are available to be set up 
	*
	*	@return	array	An array of domain names that are available for setup on this service
	*/
	public function getDomains();
}
