<?php 
	/** 
	* Configuration

   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
	*/
 
	 if (!defined("_VALID_PHP")) 
     die('Direct access to this location is not allowed.');
 
	/** 
	* Database Constants - these constants refer to 
	* the database configuration settings. 
	*/
	 define('DB_SERVER', 'localhost'); 
	 define('DB_USER', 'root'); 
	 define('DB_PASS', ''); 
	 define('DB_DATABASE', 'membao2017');
 
	/** 
	* Show MySql Errors. 
	* Not recomended for live site. true/false 
	*/
	 define('DEBUG', false);
 
	/** 
	* Cookie Constants - these are the parameters 
	* to the setcookie function call, change them 
	* if necessary to fit your website 
	*/
	 define('COOKIE_EXPIRE', 60 * 60 * 24 * 60); 
	 define('COOKIE_PATH', '/');
?>