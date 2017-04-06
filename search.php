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

  $keyword = get('keywords');
  $keyword = str_replace("%", '', $keyword);
  $keyword = sanitize($keyword,20,false);
  $keyword = $db->escape($keyword);
  
  $searchrow = $content->getSearchResults($keyword);
?>
  <!-- Start Search-->
<?php require_once (THEMEDIR . "/search.tpl.php");?>
<!-- End Search/-->