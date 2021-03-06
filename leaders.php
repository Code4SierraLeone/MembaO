<?php
  /**
   * Leader
   *
   * @package Membao
   * @author Alan Kawamaraa
   * @copyright 2017
   */
  define("_VALID_PHP", true);
  require_once("init.php");
  
  if (isset($_GET['leadername'])):
    $leaderrow = $leader->renderLeader();
    $totalSittings = $leader->totalSittings();
    $generalAPc = $leader->calculateGeneralAttendance(); 
    $leadercommittees = $committee->getMembersCommittees($leaderrow->id);
    $meetingscount = $committee->totalLeadersCommitteeMeetings($leaderrow->id);
    $presentcount = $committee->totalLeadersCommitteeMeetingsPresent($leaderrow->id); 
    $leaderAPc = getLeaderAttendancePc($leaderrow->attendance,$totalSittings);


    if(!$leaderrow):
      redirect_to(SITEURL . '/404.php');
    endif;
  else:
    $allleaders = $leader->getLeaders();
  endif;

?>
<?php require_once (THEMEDIR . "/leaders.tpl.php");?>
