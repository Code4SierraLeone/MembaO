<?php
  /**
   * Leader
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */

  define("_VALID_PHP", true);
  require_once ("../init.php");
?>
 <?php
  if (isset($_POST['rating'])):
      $rating = (int) $_POST['stars'];
      $data['rating']  = "INC($rating)";
      $data['ratingc'] = "INC(1)";
      $db->update(Leaders::lTable, $data, "id='" . Filter::$id . "'");
      
      if ($db->affected()):
          print Lang::$word->PLG_RATE_Y;
      else:
          print Lang::$word->PLG_RATE_N;
      endif;
  endif;
  
  if (isset($_POST['like'])):
	  if (isset($_COOKIE['LIKE_M_'])):
		  if ($_COOKIE['LIKE_M_'] == Filter::$id):
			  $total = getValueById("vote_up", Leaders::lTable, Filter::$id);
			  print $total;
		  else:
			  $data['vote_up'] = "INC(1)";
			  $db->update(Leaders::lTable, $data, "id='" . Filter::$id . "'");
			  $total = getValueById("vote_up", Leaders::lTable, Filter::$id);
			  print $total;
		  endif;
	  else:
		  $data['vote_up'] = "INC(1)";
		  $db->update(Leaders::lTable, $data, "id='" . Filter::$id . "'");
		  $total = getValueById("vote_up", Leaders::lTable, Filter::$id);
		  print $total;
	  endif;
  endif;
?>