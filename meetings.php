<?php
  /**
   * Committee Meetings
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  define("_VALID_PHP", true);
  require_once("init.php");
    
  if (isset($_GET['meetingname'])): 
    $meetingrow = $committee->renderCommitteeMeeting(); 
    $attendancerow = $committee->renderCommitteeMeetingAttendance($meetingrow->id); 
    if(!$meetingrow):
      redirect_to(SITEURL . '/404.php');
    endif;
  else:
    $allmeetings = $committee->getCommitteeMeetings();
  endif;
?>
<?php require_once (THEMEDIR . "/meetings.tpl.php");?>