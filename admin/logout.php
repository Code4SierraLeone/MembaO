<?php
  /**
   * Logout
   *
   * @package Visible Polls
   * @author Alan Kawamara
   * @copyright 2016
   */
  define("_VALID_PHP", true);
  
  require_once("../init.php");
?>
<?php
  if ($user->logged_in)
      $user->logout();
	  
  redirect_to("login.php");
?>