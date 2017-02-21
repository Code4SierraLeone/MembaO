<?php
  /**
   * Leader
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  define("_VALID_PHP", true);
  require_once("init.php");
  
  $row = $leader->renderLeader();
  
  if(!$row) redirect_to(SITEURL . '/404.php');
?>
<?php require_once (THEMEDIR . "/leader.tpl.php");?>
