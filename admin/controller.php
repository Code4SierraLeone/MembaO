<?php
  /**
   * Controller
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  define("_VALID_PHP", true);

  require_once ("init.php");
  if (!$user->is_Admin())
      redirect_to("login.php");
	  
  $delete = (isset($_POST['delete']))  ? $_POST['delete'] : null;
?>


<?php
  switch ($delete):
	  
	  /* == Delete Page == */
	  case "deletePage":
		  $res   = $db->delete(Content::pTable, "id=" . Filter::$id);
		  $title = sanitize($_POST['title']);
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->PAG_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;
	  
	  /* == Delete News == */
	  case "deleteNews":
		  $res   = $db->delete(Content::nTable, "id=" . Filter::$id);
		  $title = sanitize($_POST['title']);
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->NWS_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;
	  	  
	  
	  /* == Delete F.A.Q. == */
	  case "deleteFaq":
		  $res   = $db->delete(Content::fqTable, "id=" . Filter::$id);
		  $title = sanitize($_POST['title']);
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->FAQ_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;
	  
	  /* == Delete Slide == */
	  case "deleteSlide":
		  if ($thumb = getValueById("thumb", Content::slTable, Filter::$id)):
			  unlink(UPLOADS . "slider/" . $thumb);
		  endif;
		  
		  $res   = $db->delete(Content::slTable, "id=" . Filter::$id);
		  $title = sanitize($_POST['title']);
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->SLM_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;
	  
	  /* == Delete User == */
	  case "deleteUser":
		  if (Filter::$id == 1):
			  $json['type']    = 'error';
			  $json['title']   = Lang::$word->ERROR;
			  $json['message'] = Lang::$word->USR_DELUSER_ERR1;
		  else:
			  if ($avatar = getValueById("avatar", Users::uTable, Filter::$id)):
				  unlink(UPLOADS . 'avatars/' . $avatar);
			  endif;
			  $db->delete(Users::uTable, "id=" . Filter::$id);
			  
			  $title = sanitize($_POST['title']);
			  if ($db->affected()):
				  $json['type']    = 'success';
				  $json['title']   = Lang::$word->SUCCESS;
				  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->USR_DELUSER_OK);
			  else:
				  $json['type']    = 'warning';
				  $json['title']   = Lang::$word->ALERT;
				  $json['message'] = Lang::$word->NOPROCCESS;
			  endif;
		  endif;
		  print json_encode($json);
		  break;
	  	 

	 /* == Delete Bill == */
	  case "deleteBill":		  
		  
		  $res = $db->delete(Bills::bTable, "id=" . Filter::$id);
		  
		  $title = sanitize($_POST['title']);		  		 		  
		  
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("BILL: ", $title, "Bill record deleted");
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;


	 /* == Delete Leader == */
	  case "deleteLeader":
		  if ($thumb = getValueById("thumb", Leaders::lTable, Filter::$id)):
			  unlink(UPLOADS . "leaders/" . $thumb);
		  endif;
		  
		  $res = $db->delete(Leaders::lTable, "id=" . Filter::$id);
		  $db->delete(Leaders::saTable, "leader_id=" . Filter::$id);
		  
		  $name = sanitize($_POST['name']);		  		 		  
		  
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $name, "Leader record deleted");
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;
		  
	/* == Delete Party == */
	  case "deleteParty":
		  
		  $res = $db->delete(Leaders::paTable, "id=" . Filter::$id);
		
		  $name = sanitize($_POST['name']);		  		 		  
		  
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $name, "Party record deleted");
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;	  	  

	/* == Delete Constituency == */
	  case "deleteConstituency":
		  
		  $res = $db->delete(Leaders::coTable, "id=" . Filter::$id);
		
		  $name = sanitize($_POST['name']);		  		 		  
		  
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $name, "Constituency record deleted");
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;

	  /* == Delete Constituency == */
	  case "deleteCommitteeMeeting":
		  		  
		  $db->delete(Committees::cmaTable, "meeting_id=" . Filter::$id);
		  $res = $db->delete(Committees::cmsTable, "id=" . Filter::$id);
		
		  $name = sanitize($_POST['name']);		  		 		  
		  
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $name, "Committee meeting record deleted");
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;		  	  	  		  
	  
	  /* == Delete Gallery Image == */
	  case "deleteGalleryImage":
		  if ($thumb = getValueById("thumb", Products::phTable, Filter::$id)):
			  unlink(UPLOADS . "prod_gallery/" . $thumb);
		  endif;
		  
		  $res   = $db->delete(Products::phTable, "id=" . Filter::$id);
		  $title = sanitize($_POST['title']);
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->GAL_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;
	  	  
	  
	  /* == Delete File == */
	  case "deleteFile":
		  $action = false;
		  $title  = sanitize($_POST['title']);
		  if ($_POST['extra'] == "temp"):
			  @unlink(Registry::get("Core")->file_dir . $title);
			  $action = true;
		  elseif ($_POST['extra'] == "live"):
			  $thumb = getValueByID("name", Products::fTable, Filter::$id);
			  $db->delete(Products::fTable, "id=" . Filter::$id);
			  @unlink(Registry::get("Core")->file_dir . $thumb);
			  $action = true;
		  endif;
		  
		  if ($action):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->FLM_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;

		/* == Delete Backup == */
		case "deleteBackup":
			$title = sanitize($_POST['title']);
			$action = false;
	  
			if(file_exists(BASEPATH . 'admin/backups/'.sanitize($_POST['file']))) :
			  $action = unlink(BASEPATH . 'admin/backups/'.sanitize($_POST['file']));
			endif;
						
			if($action) :
				$json['type'] = 'success';
				$json['title'] = Lang::$word->SUCCESS;
				$json['message'] = str_replace("-ITEM-", $title, Lang::$word->DBM_DEL_OK);
			else :
				$json['type'] = 'warning';
				$json['title'] = Lang::$word->ALERT;
				$json['message'] = Lang::$word->NOPROCCESS;
			endif;
			print json_encode($json);
		 break;

	  /* == Delete Menu == */
	  case "deleteMenu":
		  $res = $db->delete(Content::muTable, "id=" . Filter::$id);
		  $title = sanitize($_POST['title']);
		  
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->MNU_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;

	  /* == Delete Category == */
	  case "deleteCategory":
		  $res = $db->delete(Content::cTable, "id=" . Filter::$id);
		  $db->delete(Content::cTable, "parent_id=" . Filter::$id);
		  $title = sanitize($_POST['title']);
		  
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->CAT_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;

	  /* == Delete Country == */
	  case "deleteCountry":
		  $res   = $db->delete(Content::cnTable, "id=" . Filter::$id);
		  $title = sanitize($_POST['title']);
		  if ($res):
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("-ITEM-", $title, Lang::$word->CNT_DELETED);
		  else:
			  $json['type']    = 'warning';
			  $json['title']   = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
		  
		  print json_encode($json);
		  break;
		     
  endswitch;

  /* == Load Menus == */
  if (isset($_POST['getmenus'])):
      $content->getMenuList();
  endif;

  /* == Proccess Menus == */
  if (isset($_POST['processMenu'])):
      $content->processMenu();
  endif;

  /* == Sort Menus == */
  if (isset($_POST['doMenuSort'])):
      $i = 0;
      foreach ($_POST['list'] as $k => $v):
          $i++;
          $data['position'] = intval($i);
          $res = $db->update(Content::muTable, $data, "id=" . (int)$k);
      endforeach;
      print ($res) ? Filter::msgSingleOk(Lang::$word->MNU_SORTED) : Filter::msgSngleAlert(Lang::$word->NOPROCCESS);

  endif;

  /* Get Content Type */
  if (isset($_POST['contenttype'])):
      $type = sanitize($_POST['contenttype']);
      $html = "";
      switch ($type):
          case "page":
              $sql = "SELECT id, title FROM " . Content::pTable . " WHERE active = '1' ORDER BY title ASC";
              $result = $db->fetch_all($sql);

              if ($result):
                  foreach ($result as $row):
                      $html .= "<option value=\"" . $row->id . "\">" . $row->title . "</option>\n";
                  endforeach;
                  $json['type'] = 'page';
                  $json['message'] = $html;
              endif;
              break;

          default:
              $html .= "<input name=\"page_id\" type=\"hidden\" value=\"0\" />";
              $json['type'] = 'web';
              $json['message'] = $html;
      endswitch;

      print json_encode($json);
  endif;

  /* == Proccess Country == */
  if (isset($_POST['processCountry'])):
      $content->processCountry();
  endif;
  
  /* == Load Categories == */
  if (isset($_POST['getcategories'])):
      $content->getSortCatList();
  endif;

  /* == Proccess Category == */
  if (isset($_POST['processCategory'])):
      $content->processCategory();
  endif;

  /* == Sort Category == */
  if (isset($_POST['doCatSort'])):
      $i = 0;
      foreach ($_POST['list'] as $k => $v):
          $i++;
          $data['parent_id'] = intval($v);
          $data['position'] = intval($i);
          $res = $db->update(Content::cTable, $data, "id=" . (int)$k);
      endforeach;
      print ($res) ? Filter::msgSingleOk(Lang::$word->CAT_SORTED) : Filter::msgSingleAlert(Lang::$word->NOPROCCESS);
  endif;

  /* == Proccess Bill == */
  if (isset($_POST['processBill'])):
      $bill->processBill();
  endif;

  /* == Proccess Bill Status == */
  if (isset($_POST['processBillStatus'])):
      $bill->processBillStatus();
  endif;


 /* == Proccess Committee == */
 	if (isset($_POST['processCommittee'])):
    	$committee->processCommittee();
  	endif;

 /* == Proccess Committee Type == */
 	if (isset($_POST['processCommitteeType'])):
    	$committee->processCommitteeType();
  	endif; 

  /* == Proccess Committee Members == */
 	if (isset($_POST['processCommitteeMembers'])):
    	$committee->processCommitteeMembers();
  	endif; 

  /* == Proccess Committee Meeting == */
 	if (isset($_POST['processCommitteeMeeting'])):
    	$committee->processCommitteeMeeting();
  	endif;

  /* == Proccess Committee Meeting Attendance == */
  if (isset($_POST['processCommitteeMeetingAttendance'])):
      $committee->processCommitteeMeetingAttendance();
  endif;	 	 		

  /* == Proccess Leader == */
  if (isset($_POST['processLeader'])):
      $leader->processLeader();
  endif;
  
    /* == Proccess Party == */
  if (isset($_POST['processParty'])):
      $leader->processParty();
  endif;
  
  /* == Proccess Constituency == */
  if (isset($_POST['processConstituency'])):
      $leader->processConstituency();
  endif;
  
  /* == Proccess Constituency == */
  if (isset($_POST['processCalendar'])):
      $leader->processCalendar();
  endif;
  
  /* == Proccess Attendance == */
  if (isset($_POST['processAttendance'])):
      $leader->processAttendance();
  endif;

  /* == Leader Live Search == */
  if (isset($_POST['leaderSearch'])):
      $string = sanitize($_POST['leaderSearch'], 15);
      if (strlen($string) > 3):
          $sql = "SELECT id, first_name, last_name, thumb, bio, created" 
		  . "\n FROM " . Leaders::lTable
		  . "\n WHERE MATCH (last_name) AGAINST ('" . $db->escape($string) . "*' IN BOOLEAN MODE)" 
		  . "\n ORDER BY last_name LIMIT 10";

          $html = '';
          if ($result = $db->fetch_all($sql)):
              $html .= '<div id="search-results" class="corporato segment celled list">';
              foreach ($result as $row):
                  $thumb = ($row->thumb) ? '<img src="' . UPLOADURL . 'leaders/' . $row->thumb . '" alt="" class="corporato small image"/>' : '<img src="' . UPLOADURL . 'leaders/blank.png" alt="" class="corporato small image"/>';
                  $link = 'index.php?do=leaders&amp;action=edit&amp;id=' . $row->id;
                  $html .= '<div class="item">' . $thumb;
                  $html .= '<div class="items">';
                  $html .= '<div class="header"><a href="' . $link . '">' . $row->first_name . ' ' . $row->last_name .'</a></div>';
                  $html .= '<p>' . Filter::dodate('short_date', $row->created) . '</p>';
                  $html .= '<p><small>' . cleanSanitize($row->bio, 150). '</small></p>';
                  $html .= '</div>';
                  $html .= '</div>';
              endforeach;
              $html .= '</div>';
              print $html;
          endif;
      endif;
  endif;

  /* == Rename File Alias == */
  if (isset($_POST['quickedit']) and $_POST['type'] == "file"):
          if (empty($_POST['title'])):
              print '-/-';
              exit;
          endif;
		  
		  $title = cleanOut($_POST['title']);
		  $title = strip_tags($title);
			  
          if($_POST['key'] == "title"):
		    $data['alias'] = $title;
		    $db->update(Products::fTable, $data, "id = " . Filter::$id);
		  endif;
		  
	  print $title;
  endif;

  /* == Add All Temp Files */
  if (isset($_POST['addAllTempFiles'])):
      $item->addTempFiles();
  endif;
  
  /* == Upload Files == */
  if (isset($_POST['uploadMainFiles'])):
      Registry::get('FM')->filesUpload('mainfile');
  endif;
  

  /* == Upload Gallery Image == */
  if (isset($_POST['uploadGalleryImages'])):
      $item->galleryUpload('mainfile');
  endif;

  /* == Edit Gallery == */
  if (isset($_POST['quickedit']) and $_POST['type'] == "gallery"):
          if (empty($_POST['title'])):
              print '-/-';
              exit;
          endif;
		  
		  $title = cleanOut($_POST['title']);
		  $title = strip_tags($title);
			  
          if($_POST['key'] == "title"):
		    $data['caption'] = $title;
		    $db->update(Products::phTable, $data, "id = " . Filter::$id);
		  endif;
		  
	  print $title;
  endif;

  /* == Rename File Alias == */
  if (isset($_POST['quickedit']) and $_POST['type'] == "language"):
          if (empty($_POST['title'])):
              print '-/-';
              exit;
          endif;
		  
		  $title = cleanOut($_POST['title']);
		  $title = strip_tags($title);
			  
          if (file_exists(BASEPATH . Lang::langdir . Core::$language . "/" . $_POST['path'] . ".xml")):
		      $xmlel = simplexml_load_file(BASEPATH . Lang::langdir . Core::$language . "/" . $_POST['path'] . ".xml");
              $node = $xmlel->xpath("/language/phrase[@data = '" . $_POST['key'] . "']");
              $node[0][0] = $title;
              $xmlel->asXML(BASEPATH . Lang::langdir . Core::$language . "/" . $_POST['path'] . ".xml");
          endif;
		  
	  print $title;
  endif;
  
  /* == Proccess Configuration == */
  if (isset($_POST['processConfig'])):
      $core->processConfig();
  endif;

  /* == Proccess Gateway == */
  if (isset($_POST['processGateway'])):
      $content->processGateway();
  endif;

  /* == Restore SQL Backup == */
  if (isset($_POST['restoreBackup'])):
	  require_once(BASEPATH . "lib/class_dbtools.php");
	  Registry::set('dbTools',new dbTools());
	  $tools = Registry::get("dbTools");
	  
	  if($tools->doRestore($_POST['restoreBackup'])) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("-ITEM-", $_POST['restoreBackup'], Lang::$word->DBM_RES_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  print json_encode($json);
  endif;
  
  /* == Proccess Page == */
  if (isset($_POST['processPage'])):
      $content->processPage();
  endif;

  /* == Proccess F.A.Q == */
  if (isset($_POST['processFaq'])):
      $content->processFaq();
  endif;

  /* == Update faq order == */
  if (isset($_GET['sortfaq'])):
      foreach ($_POST['node'] as $k => $v):
          $p = $k + 1;
          $data['position'] = $p;
          $db->update(Content::fqTable, $data, "id=" . intval($v));
      endforeach;
  endif;

  /* == Proccess Newsletter == */
  if (isset($_POST['processNewsletter'])):
      $content->processNewsletter();
  endif;

  /* == Proccess Email Template == */
  if (isset($_POST['processEmailTemplate'])):
      $content->processEmailTemplate();
  endif;

  /* == Proccess News == */
  if (isset($_POST['processNews'])):
      $content->processNews();
  endif;

  /* == Proccess Comment Configuration == */
  if (isset($_POST['processCommentConfig'])):
      $content->processCommentConfig();
  endif;

  /* == Comments Actions == */
  if (isset($_POST['comproccess']) && intval($_POST['comproccess']) == 1):
      $action = '';
      if (empty($_POST['comid'])):
          $json['type'] = 'warning';
          $json['message'] = Filter::msgAlert(Lang::$word->CMT_ACT_1, false);
      endif;

      if (!empty($_POST['comid'])):
          foreach ($_POST['comid'] as $val):
              $id = intval($val);
              if (isset($_POST['action']) && $_POST['action'] == "disapprove"):
                  $data['active'] = 0;
                  $action = Lang::$word->CMT_ACT_2;
              elseif (isset($_POST['action']) && $_POST['action'] == "approve"):
                  $data['active'] = 1;
                  $action = Lang::$word->CMT_ACT_3;
              endif;

              if (isset($_POST['action']) && $_POST['action'] == "delete"): 
                  $db->delete(Content::cmTable, "id=" . $id);
                  $action = Lang::$word->CMT_ACT_4;
              else: 
                  $db->update(Content::cmTable, $data, "id=" . $id);
              endif;
              endforeach;

		  if ($db->affected()):
			  $json['type'] = 'success';
			  $json['message'] = Filter::msgOk($action, false);
		  else:
			  $json['type'] = 'warning';
			  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
		  endif;
		  
      endif;
	  print json_encode($json);
  endif;

  /* == Load Comment For Edit == */
  if (isset($_POST['loadComment'])):
      $row = Core::getRowById(Content::cmTable, Filter::$id);
      if ($row):
          $html =  '<div class="corporato small form" style="width:400px">';
          $html .= '<div class="field"><textarea name="body" class="altpost" id="bodyid">' . $row->body . '</textarea></div>';
          $html .= '<p class="corporato info">' . $row->www . '</p>';
          $html .= '<p class="corporato info">IP: ' . $row->ip . '</p>';
          $html .= '</div>';
          print $html;
      endif;
  endif;

  /* == Update Comment == */
  if (isset($_POST['processComment'])):
      $data['body'] = cleanOut($_POST['content']);
      $result = $db->update(Content::cmTable, $data, "id=" . Filter::$id);

      if ($result):
          $json['type'] = 'success';
          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = Lang::$word->CMT_UPDATED;
      else:
          $json['type'] = 'warning';
          $json['title'] = Lang::$word->ALERT;
          $json['message'] = Lang::$word->NOPROCCESS;
      endif;
      print json_encode($json);
  endif;


  /* == Proccess Slider Configuration == */
  if (isset($_POST['processSliderConfiguration'])):
      $content->processSliderConfiguration();
  endif;

  /* == Proccess Slider == */
  if (isset($_POST['processSlide'])):
      $content->processSlide();
  endif;
  
  /* == Update Slide order == */
  if (isset($_GET['sortslides'])):
      foreach ($_POST['node'] as $k => $v):
          $p = $k + 1;
          $data['sorting'] = $p;
          $db->update(Content::slTable, $data, "id=" . intval($v));
      endforeach;
  endif;

  
  /* == Proccess User == */
  if (isset($_POST['processUser'])): 
      $user->processUser();
  endif;

  /* == Acctivate User == */
  if (isset($_POST['activateAccount'])):
      $user->activateAccount();
  endif;

  /* == User Search == */
  if (isset($_POST['userSearch'])):
      $string = sanitize($_POST['userSearch'], 15);
      if (strlen($string) > 3):
          $sql = "SELECT id, username, email, created, avatar, CONCAT(fname,' ',lname) as name" 
		  . "\n FROM " . Users::uTable 
		  . "\n WHERE MATCH (username) AGAINST ('" . $db->escape($string) . "*' IN BOOLEAN MODE)" 
		  . "\n ORDER BY username LIMIT 10";

          $html = '';
          if ($result = $db->fetch_all($sql)):
              $html .= '<div id="search-results" class="corporato segment celled list">';
              foreach ($result as $row):
                  $thumb = ($row->avatar) ? '<img src="' . UPLOADURL . 'avatars/' . $row->avatar . '" alt="" class="corporato image avatar"/>' : '<img src="' . UPLOADURL . 'avatars/blank.png" alt="" class="corporato image avatar"/>';
                  $link = 'index.php?do=users&amp;action=edit&amp;id=' . $row->id;
                  $html .= '<div class="item">' . $thumb;
                  $html .= '<div class="items">';
                  $html .= '<div class="header"><a href="' . $link . '">' . $row->name . '</a> <small>(' . $row->username . ')</small></div>';
                  $html .= '<p>' . Filter::dodate('short_date', $row->created) . '</p>';
                  $html .= '<p><a href="index.php?do=newsletter&amp;emailid=' . urlencode($row->email) . '">' . $row->email . '</a></p>';
                  $html .= '</div>';
                  $html .= '</div>';
              endforeach;
              $html .= '</div>';
              print $html;
          endif;
      endif;
  endif;

  /* == Site Maintenance == */
  if (isset($_POST['processMaintenance'])):
	switch ($_POST['do']):
		case "inactive":
				$now = date('Y-m-d H:i:s');
				$diff = intval($_POST['days']);
				$expire = date("Y-m-d H:i:s", strtotime($now . -$diff . " days"));
				$db->delete(Users::uTable, "lastlogin < '" . $expire . "' AND active = 'y' AND userlevel !=9");
				if ($db->affected()):
					$json['type'] = 'success';
					$json['message'] = Filter::msgOk(str_replace("[NUMBER]", $db->affected(), Lang::$word->MTN_DELINCT_OK), false);
				else:
					$json['type'] = 'success';
					$json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
				endif;
			print json_encode($json);	
		 break;
	
	  case "banned":
		$db->delete(Users::uTable, "active = 'b'");
		if ($db->affected()):
			$json['type'] = 'success';
			$json['message'] = Filter::msgOk(str_replace("[NUMBER]", $db->affected(), Lang::$word->MTN_DELBND_OK), false);
		else:
			$json['type'] = 'success';
			$json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
		endif;
		print json_encode($json);
	   break;

	  case "recent":
		$db->query("TRUNCATE TABLE recent");
		if ($db->affected()):
			$json['type'] = 'success';
			$json['message'] = Filter::msgOk(str_replace("[NUMBER]", $db->affected(), Lang::$word->MTN_DELRCT_OK), false);
		else:
			$json['type'] = 'success';
			$json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
		endif;
		print json_encode($json);
	   break;
	   
	  case "sitemap":
		$content->writeSiteMap();
	   break;
  
	endswitch;

  endif;

 
  
  /* == Export Transactions XLS == */
  if (isset($_GET['exportTransactionsXLS'])):
       $item->exportTransactionsXLS();
  endif;

  /* == Export Transactions PDF == */
  if (isset($_GET['exportTransactionsPDF'])):
       $item->exportTransactionsPDF();
   
  endif;

  /* == Latest Leader Stats == */
  if (isset($_GET['getLeaderStats'])):

      $data = array();
      $data['hits'] = array();
      $data['xaxis'] = array();
      $data['hits']['label'] = Lang::$word->ADM_PVIEWS;
      $data['uhits']['label'] = Lang::$word->ADM_UVIEWS;

      $and = (Filter::$id) ? "AND lid = " . Filter::$id : null;

      for ($i = 1; $i <= 12; $i++):
          $row = $db->first("SELECT SUM(hits) AS hits," 
		  . "\n SUM(uhits) as uhits" 
		  . "\n FROM stats" 
		  . "\n WHERE YEAR(day) = '" . date('Y') . "'" 
		  . "\n AND MONTH(day) = '" . $i . "'" 
		  . "\n $and" 
		  . "\n GROUP BY MONTH(day)");

          $data['hits']['data'][] = ($row) ? array($i, (int)$row->hits) : array($i, 0);
          $data['uhits']['data'][] = ($row) ? array($i, (int)$row->uhits) : array($i, 0);
          $data['xaxis'][] = array($i, date('M', mktime(0, 0, 0, $i, 1, date('Y'))));
      endfor;

      print json_encode($data);
  endif;
  
?>