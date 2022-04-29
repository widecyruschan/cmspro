<?php 
	/** 
	* Configuration

	* @package Wojo Framework
	* @author wojoscripts.com
	* @copyright 2022
	* @version Id: config.ini.php, v1.00 2022-03-29 10:50:31 gewa Exp $
	*/
 
	 if (!defined("_WOJO")) 
     die('Direct access to this location is not allowed.');
 
	/** 
	* Database Constants - these constants refer to 
	* the database configuration settings. 
	*/
	 define('DB_SERVER', 'localhost'); 
	 define('DB_USER', 'root'); 
	 define('DB_PASS', '123456'); 
	 define('DB_DATABASE', 'cmspro');
	 define('DB_DRIVER', 'mysql');
 
	 define('INSTALL_KEY', 'OV6VkEi4shIUtvGH'); 
 
	/** 
	* Show Debugger Console. 
	* Display errors in console view. Not recomended for live site. true/false 
	*/
	 define('DEBUG', false);
?>