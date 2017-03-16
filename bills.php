<?php
  /**
   * Index
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  define("_VALID_PHP", true);
  require_once("init.php");
    
  if (isset($_GET['billname'])):
    $billrow = $bill->renderBill();    
    if(!$billrow):
      redirect_to(SITEURL . '/404.php');
    endif;
  else:
    $allbills = $bill->getBills();
  endif;
?>
<?php require_once (THEMEDIR . "/bills.tpl.php");?>