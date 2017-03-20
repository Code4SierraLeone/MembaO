<?php
  /**
   * Crumbs Navigation
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php
  $sname = $_SERVER["SCRIPT_NAME"];
  $pages = array(
      'account',
      'activate',
      'bills',      
      'category',
      'committees',
      'content',
      'item',
      'login',
      'leaders',
      'meetings',
      'profile',
      'register',
      'search',
      'summary',
      'tags',
      'view',
      );
  $regexp = '#' . implode('|', $pages) . '#';
  $pages = preg_match($regexp, $sname, $matches) ? $matches[0] : '';
  $html = '';

  switch ($pages) {

      case "account":
          $html =  Lang::$word->_UA_MYACC;
          break;

      case "activate":
          print Lang::$word->_UA_TITLE3;
          break;

      case "bills":
          if(isset($allbills)):
            $html = "Bills";
          else:
            $html = ($billrow) ? "Bills  /  ".$billrow->title : "";
          endif;
          break;    

      case "category":
          $html = ($row) ? $row->name : "";
          break;

      case "committees":
          if(isset($allcommittees)):
            $html = "Committees";
          else:
            $html = ($committeerow) ? "Committees  /  ".$committeerow->name : "";
          endif;
          break;     

      case "content":
          $html = ($row) ? $row->title : "";
          break;

      case "item":
          $html = ($row) ? $row->title : "";
          break;

      case "leaders":
          if(isset($allleaders)):
            $html = "Leaders";
          else:
            $html = ($leaderrow) ? "Leaders  /  ".$leaderrow->name : "";
          endif;
          break;          

      case "login":
          $html = Lang::$word->_UA_TITLE;
          break;

      case "meetings":
          if(isset($allmeetings)):
            $html = "Meetings";
          else:
            $html = ($meetingrow) ? "Leaders  /  ".$meetingrow->name : "";
          endif;
          break;     

      case "profile":
          $html = Lang::$word->_UA_TITLE4;
          break;

      case "register":
          $html = Lang::$word->_UA_TITLE2;
          break;

      case "search":
          $html = Lang::$word->FSRC_TITLE;
          break;

      case "summary":
          $html = Lang::$word->SMY_TITLE;
          break;

      case "tags":
          $html = ($row) ? $row->tag : "";
          break;

      case "view":
          $html = Lang::$word->_UA_TITLE5;
          break;
		  
      default:
		  $html = '';
          break;

  }
  
  print '<div class="active section">' . $html . '</div>';
?> 