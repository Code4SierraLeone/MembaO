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
  
  $home = $content->getHomePage();
  //$news = $content->renderNews();
  $latest = $leader->featuredLeaders();
  $attendanceperc = $leader->calculateGeneralAttendance();
  $mps = $leader->totalLeaders();
  $sittings = $leader->totalSittings();
  $totalbills = $bill->totalBills();
  $totalbillspassed = $bill->totalBillsPassed();
  $totalcommitteemeetings = $committee->totalCommitteeMeetings();
  $mostattendance = $leader->mostAttendances();
  $leastattendance = $leader->leastAttendances();
?>
<?php require_once (THEMEDIR . "/index.tpl.php");?>