<?php
  /**
   * Committees
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  
  define("_VALID_PHP", true);
  require_once("init.php");
    
  if (isset($_GET['committeename'])):
    $committeerow = $committee->renderCommittee();  
    $committeemembersrow = $committee->getCommitteeMembers($committeerow->id);
    $committeemeetingsrow = $committee->getCommitteeMeetingsList($committeerow->id); 
    if(!$committeerow):
      redirect_to(SITEURL . '/404.php');
    endif;
  else:
    $allcommittees = $committee->getCommitteesList();
  endif;
?>
<?php require_once (THEMEDIR . "/committees.tpl.php");?>