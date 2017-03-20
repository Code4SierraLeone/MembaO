<?php
  /**
   * Leaders Class
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Leaders
  {
      const lTable = "leaders";
	  const coTable = "constituencies";
	  const paTable = "parties";
	  const scTable = "sitting_calendar";
	  const saTable = "sitting_attendance";
	  const rTable = "recent";
	  const sTable = "stats";
	  
	  public $leaderslug = null;
	  private static $db;
      public static $gfileext = array("jpg","jpeg","png");
      /**
       * Leaders::__construct()
       * 
       * @return
       */
      public function __construct()
      {
          self::$db = Registry::get("Database");
		  $this->getLeaderSlug();

      }

	  /**
	   * Leaders::getLeaderSlug()
	   * 
	   * @return
	   */
	  private function getLeaderSlug()
	  {
		  
		  if (isset($_GET['leadername'])) {
			  $this->leaderslug = sanitize($_GET['leadername'],100);
			  return self::$db->escape($this->leaderslug);
		  }
	  }
	  
	  /**
	   * Leaders::getLeaders()
	   * 
	   * @param bool $sort
	   * @return
	   */
	  public function getLeaders($from = '')
	  {

		  if (isset($_GET['letter']) and (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '')) {
			  $enddate = date("Y-m-d");
			  $letter = sanitize($_GET['letter'], 2);
			  $fromdate = (empty($from)) ? $_POST['fromdate'] : $from;
			  if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
				  $enddate = $_POST['enddate'];
			  }
			  $q = "SELECT COUNT(*) FROM " . self::lTable . " WHERE created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'"
			  . "\n AND last_name REGEXP '^" . self::$db->escape($letter) . "'";
			  $where = " WHERE l.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59' AND last_name REGEXP '^" . self::$db->escape($letter) . "'";
			  
		  } elseif (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '') {
			  $enddate = date("Y-m-d");
			  $fromdate = (empty($from)) ? $_POST['fromdate'] : $from;
			  if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
				  $enddate = $_POST['enddate'];
			  }
			  $q = "SELECT COUNT(*) FROM " . self::lTable . " WHERE created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
			  $where = " WHERE l.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
			  
		  } elseif(isset($_GET['letter'])) {
			  $letter = sanitize($_GET['letter'], 2);
			  $where = "WHERE last_name REGEXP '^" . self::$db->escape($letter) . "'";
			  $q = "SELECT COUNT(*) FROM " . self::lTable . " WHERE last_name REGEXP '^" . self::$db->escape($letter) . "' LIMIT 1"; 
		  } else {
			  $q = "SELECT COUNT(*) FROM " . self::lTable . " LIMIT 1";
			  $where = null;
		  }
		  
          $record = self::$db->query($q);
          $total = self::$db->fetchrow($record);
          $counter = $total[0];
		  
		  $pager = Paginator::instance();
		  $pager->items_total = $counter;
		  $pager->default_ipp = Registry::get("Core")->perpage;
		  $pager->paginate();
		  
		  $sql = "SELECT l.*, l.id as lid, CONCAT(l.first_name,' ',l.last_name) as name, CONCAT(co.name) as constituency, pa.name as partyname, pa.abbr as partyabbr," 
		  . "\n (SELECT COUNT(lid) FROM " . self::saTable . " WHERE lid = l.id) as attendance"
		  . "\n FROM " . self::lTable . " as l"
		  . "\n LEFT JOIN " . self::coTable . " as co ON co.id = l.constituency" 
		  . "\n LEFT JOIN " . self::paTable . " as pa ON pa.id = l.party" 
		  . "\n $where"
		  . "\n ORDER BY name ASC" . $pager->limit;
          $row = self::$db->fetch_all($sql);
		  
           return ($row) ? $row : 0;

	  }

	  /**
	   * Leaders:::processLeader()
	   * 
	   * @return
	   */
	  public function processLeader()
	  {
		  
		  Filter::checkPost('first_name', "Enter first name");
		  Filter::checkPost('last_name', "Enter last name");		  
		  Filter::checkPost('gender', "Select gender");		  
		  
		  if (!empty($_FILES['thumb']['name'])) {
			  if (!preg_match("/(\.jpg|\.png)$/i", $_FILES['thumb']['name']))
				  $core->msgs['thumb'] = "Profile picture";
		  }
		    		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'first_name' => sanitize($_POST['first_name']),
				  'other_name' => sanitize($_POST['other_name']), 
				  'last_name' => sanitize($_POST['last_name']), 
				  'slug' => (empty($_POST['slug'])) ? doSeo($_POST['first_name'].$_POST['other_name'].$_POST['last_name']) : doSeo($_POST['slug']),
				  'gender' => $_POST['gender'],
				  'dob' => $_POST['dob'],				  
				  'party' => $_POST['party'],
				  'office' => $_POST['office'],
				  'constituency' => $_POST['constituency'],
				  'active' => intval($_POST['active']),
				  'featured' => intval($_POST['featured'])
			  );
			  
			  if (!Filter::$id) {
				  $data['created'] = "NOW()";
			  }

			  if (empty($_POST['metakeys' . Lang::$lang]) or empty($_POST['metadesc'])) {
				  include (BASEPATH . 'lib/class_meta.php');
				  parseMeta::instance($_POST['first_name'] .' '.$_POST['last_name']);
				  if (empty($_POST['metakeys'])) {
					  $data['metakeys'] = parseMeta::get_keywords();
				  }
				  if (empty($_POST['metadesc'])) {
					  $data['metadesc'] = parseMeta::metaText($_POST['first_name'] .' '.$_POST['last_name']);
				  }
			  }
			  
              // Procces Thumb
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbdir = UPLOADS . "leaders/";
				  $tName = "IMG_" . randName();
				  $text = substr($_FILES['thumb']['name'], strrpos($_FILES['thumb']['name'], '.') + 1);
				  $thumbName = $thumbdir . $tName . "." . strtolower($text);
				  if (Filter::$id && $thumb = getValueById("thumb", self::lTable, Filter::$id)) {
					  @unlink($thumbdir . $thumb);
				  }
				  move_uploaded_file($_FILES['thumb']['tmp_name'], $thumbName);
	
				  $data['thumb'] = $tName . "." . strtolower($text);
			  }              

			  (Filter::$id) ? self::$db->update(self::lTable, $data, "id=" . Filter::$id) : $lastid = self::$db->insert(self::lTable, $data);
			  $message = (Filter::$id) ? "Leader profile updated" : "Leader profile added";

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);			  	  			  
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }

	  /**
	   * Leaders::renderLeader()
	   * 
	   * @return
	   */
	  public function renderLeader()
	  {
		  $is_admin = Registry::get("Users")->is_Admin() ? null : "AND l.active = 1";
		  
		  $sql = "SELECT l.*, l.id as lid, CONCAT(l.first_name,' ',l.last_name) as name, co.id as coid,co.name as coname, pa.name as pparty," 
		  . "\n (SELECT COUNT(leader_id) FROM " . self::saTable . " WHERE leader_id = l.id) as attendance,"
		  . "\n (SELECT SUM(hits) FROM " . self::sTable . " WHERE lid = l.id) as hits"
		  . "\n FROM " . self::lTable . " as l"
		  . "\n LEFT JOIN " . self::coTable . " as co ON co.id = l.constituency"
		  . "\n LEFT JOIN " . self::paTable . " as pa ON pa.id = l.party"
		  . "\n WHERE l.slug = '".$this->leaderslug."'"
		  . "\n $is_admin";
          $row = self::$db->first($sql);
		  
          if ($row) {
			  $this->updateRecentViews($row->lid);
			  $this->doStats($row->lid);
              return $row;
          } else
              return 0;

	  }
	  
	  /**
       * Leaders::mostPopLeaders()
       * 
       * @return
       */
      public function mostPopLeaders()
      {
		  
          $sql = "SELECT l.*, l.id as lid, CONCAT(l.first_name,' ',l.last_name) as fullname," 
		  . "\n (SELECT SUM(hits) FROM " . self::sTable . " WHERE lid = l.id) as hits"
		  . "\n FROM " . self::lTable . " as l"		  
		  . "\n ORDER BY hits DESC," . Registry::get("Core")->popular;
          
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : "none";
      }
	  
	  /**
       * Leaders::featuredLeaders()
       * 
       * @return
       */
      public function featuredLeaders()
      {
		  
          $sql = "SELECT l.*, l.id as lid, CONCAT(l.first_name,' ',l.last_name) as fullname, co.name as coname, pa.name as partyname" 
		  . "\n FROM " . self::lTable . " as l"	
		  . "\n LEFT JOIN " . self::coTable . " as co ON co.id = l.constituency" 
		  . "\n LEFT JOIN " . self::paTable . " as pa ON pa.id = l.party"	  
		  . "\n WHERE l.featured = 1 ORDER BY RAND() LIMIT 1";
          
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }	  
	  
	  /**
	   * Leaders:::processParty()
	   * 
	   * @return
	   */
	  public function processParty()
	  {
		  
		  Filter::checkPost('name', "Enter party name");
		  Filter::checkPost('abbr', "Enter abbreviation");	  
		    		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'name' => sanitize($_POST['name']),
				  'abbr' => sanitize($_POST['abbr'])
			  );
			  
			  if (!Filter::$id) {
				  $data['created'] = "NOW()";
			  }			 			 

			  (Filter::$id) ? self::$db->update(self::paTable, $data, "id=" . Filter::$id) : $lastid = self::$db->insert(self::paTable, $data);
			  $message = (Filter::$id) ? "Party profile updated" : "Party profile added";

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);			  	 			  
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }

	  /**
       * Leaders::getPartyList()
       * 
       * @return
       */
      public function getPartyList()
      {
          $sql = "SELECT * FROM " . self::paTable . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  /**
	   * Leaders:::processConstituency()
	   * 
	   * @return
	   */
	  public function processConstituency()
	  {
		  
		  Filter::checkPost('name', "Enter party name");
		  Filter::checkPost('district', "Enter district name");	  
		    		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'name' => sanitize($_POST['name']),
				  'district' => sanitize($_POST['district'])
			  );			 			  			 			 

			  (Filter::$id) ? self::$db->update(self::coTable, $data, "id=" . Filter::$id) : $lastid = self::$db->insert(self::coTable, $data);
			  $message = (Filter::$id) ? "Constituency updated" : "Constituency added";

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);			  	 			  
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }

	  /**
       * Leaders::getConstituencyList()
       * 
       * @return
       */
      public function getConstituencyList()
      {
          $sql = "SELECT * FROM " . self::coTable . " ORDER BY id, district";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }	
	  
	  /**
	   * Leaders:::processCalendar()
	   * 
	   * @return
	   */
	  public function processCalendar()
	  {
		  
		  Filter::checkPost('year', "Enter calendar year");
		  Filter::checkPost('date', "Enter sitting date");
		  Filter::checkPost('stype', "Enter sitting type");	  
		    		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'year' => sanitize($_POST['year']),
				  'date' => $_POST['date'], 
				  'sitting_type' => sanitize($_POST['stype'])
			  );			 			  			 			 

			  (Filter::$id) ? self::$db->update(self::scTable, $data, "id=" . Filter::$id) : $lastid = self::$db->insert(self::scTable, $data);
			  $message = (Filter::$id) ? "Sitting date updated" : "Sitting date added";

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);			  	 			  
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }	
	  
	  /**
	   * Leaders:::processAttendance()
	   * 
	   * @return
	   */
	  public function processAttendance()
	  {
		  if (!empty($_POST['leader_id'])):
			  foreach ($_POST['leader_id'] as $val):
				$leaderid = intval($val);
					  
				$data = array(	  			
					'sitting_id' => $_POST['sitting_id'],
					'leader_id' => $leaderid,		
				);								
	
				//check if MP attendance has been recorded in sitting attendance table
				$row = self::$db->first("SELECT * FROM " . self::saTable . " WHERE leader_id = " . $leaderid . " AND sitting_id = " . $_POST['sitting_id'] . " LIMIT 1");
				if($row):
					//delete record from attendance sheet
					self::$db->delete(self::saTable, "id=" . $row->id);	
					//decrement members sitting stat
					self::$db->query("UPDATE " . self::lTable . " SET sittings = sittings - 1 WHERE id = ".$leaderid.";");
				endif;
				
				//add record to attendance sheet
				self::$db->insert(self::saTable, $data);
				//increment members sitting stat
				self::$db->query("UPDATE " . self::lTable . " SET sittings = sittings + 1 WHERE id = ".$leaderid.";");	
				$message = "Attendance records updated";
			  endforeach;		  		  
			  
			  if (self::$db->affected()) {
					  $json['type'] = 'success';
					  $json['message'] = Filter::msgOk($message, false);
				  } else {
					  $json['type'] = 'success';
					  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
				  }
				  print json_encode($json);	    		  		  
			else:
				$json['message'] = Filter::msgAlert("No records have been updated.", false);;
			  	print json_encode($json);
			endif;
	  }		     
	  
	  /**
       * Leaders::getSittingList()
       * 
       * @return
       */
      public function getSittingCalendar()
      {
          $sql = "SELECT * FROM " . self::scTable . " ORDER BY date, year";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  public function calculateGeneralAttendance () 
	  {
			$totalSittings = countEntries(self::scTable, "" ,"");
			$totalLeaders = countEntries(self::lTable, "" ,"");
			
			$totalAttendance = $totalLeaders * $totalSittings;
			$actualAttendance = countEntries(self::saTable, "" ,"");
			$attendanceperc = ($actualAttendance / $totalAttendance)*100; 

		  	return number_format((float)$attendanceperc, 0, '.', '');
	  }
	  
	  public function totalSittings () 
	  {
			$totalSittings = countEntries(self::scTable, "" ,"");
		  	return $totalSittings;
	  }
	  
	  public function totalLeaders () 
	  {
			$totalLeaders = countEntries(self::lTable, "" ,"");
		  	return $totalLeaders;
	  }
	  
	  /**
       * Leaders::mostAttendances()
       * 
       * @return
       */
      public function mostAttendances()
      {
		  
          $sql = "SELECT l.*, l.id as lid, CONCAT(l.first_name,' ',l.last_name) as fullname, co.name as constituencyname, pa.name as partyname" 
		  . "\n FROM " . self::lTable . " as l"	
		  . "\n LEFT JOIN " . self::coTable . " as co ON co.id = l.constituency" 
		  . "\n LEFT JOIN " . self::paTable . " as pa ON pa.id = l.party"
		  . "\n ORDER BY l.sittings DESC LIMIT 5";
          
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }
	  
	  /**
       * Leaders::leastAttendances()
       * 
       * @return
       */
      public function leastAttendances()
      {
		  
          $sql = "SELECT l.*, l.id as lid, CONCAT(l.first_name,' ',l.last_name) as fullname, co.name as constituencyname, pa.name as partyname" 
		  . "\n FROM " . self::lTable . " as l"	
		  . "\n LEFT JOIN " . self::coTable . " as co ON co.id = l.constituency" 
		  . "\n LEFT JOIN " . self::paTable . " as pa ON pa.id = l.party"
		  . "\n ORDER BY l.sittings ASC LIMIT 5";
          
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }
	  
	  
	  /**
	   * Leaders::renderRecentViews()
	   * 
	   * @return
	   */
	  public function renderRecentViews()
	  {

		  $sql = "SELECT r.*, l.id as lid, l.first_name, l.last_name, l.slug, l.thumb"
		  . "\n FROM " . self::rTable . " as r"
		  . "\n LEFT JOIN " . self::lTable . " as l ON l.id = r.lid"
		  . "\n WHERE r.user_id = '" . self::$db->escape(Registry::get("Users")->sesid) . "'"
		  . "\n GROUP BY r.lid ORDER BY l.last_name LIMIT 10";
		  
          $row = self::$db->fetch_all($sql);
          
		  return ($row) ? $row : 0;

	  }

	  /**
	   * Leaders::getLeaderRatingRead()
	   *
	   * @param int $ratingt
	   * @param int $ratingc
	   * @return
	   */
	  public static function getLeaderRatingRead($ratingt, $ratingc)
	  {
		  $data = "<span class=\"rating-read\">";
          $rating = ($ratingc == 0) ? 0 :  $ratingt/$ratingc;
		  $count = 5;
		  for ($i = 0; $i < 5; $i++) {
			  $j = $i + 1;
			  if ($i < floor($rating))
				  $cls = "rated";
			  else
				  $cls = "norate";
			  $data .= '<b class="' . $cls . '"></b>';
		  }
		  $data .= '<i>' . number_format($rating,1) . '</i>';
		  $data .= "</span>";
	
		  print $data;
	
	  }

	  /**
	   * Leaders::getLeaderRatingWrite()
	   *
	   * @param int $ratingt
	   * @param int $ratingc
	   * @return
	   */
	  public static function getLeaderRatingWrite($id, $ratingt, $ratingc)
	  {
			$data = "<span class=\"rating-vote\">";
			$rating = ($ratingc == 0) ? 0 :  $ratingt/$ratingc;
			$count = 5;
			for ($i = 0; $i < 5; $i++) {
				$j = $i + 1;
				if ($i < floor($rating))
					$cls = "rated";
				else
					$cls = "norate";
				$data .= '<b data-id="' . $id . '" data-rate="' . $j . '" class="' . $cls . '"></b>';
			}
			$data .= '<i>' . number_format($rating,1) . '</i>';
			$data .= "</span>";
	  
			print $data;
	
	  }
	  
	  /**
	   * Leaders::getLeaderRating()
	   *
	   * @param int $ratingt
	   * @param int $ratingc
	   * @return
	   */
	  public static function getLeaderRating($id, $ratingt, $ratingc)
	  {
		  if (isset($_COOKIE['RATE_DDP_'])) {
			  if($_COOKIE['RATE_DDP_'] == $id) {
				  self::getLeaderRatingRead($ratingt, $ratingc);
			  } else {
				  self::getLeaderRatingWrite($id, $ratingt, $ratingc);
			  }
		  } else {
			  if(Registry::get("Users")->logged_in) {
				  self::getLeaderRatingWrite($id, $ratingt, $ratingc);
			  } else {
				  self::getLeaderRatingRead($ratingt, $ratingc);
			  }
			  
		  }
	
	  }
	    	  
	  	    
	  /**
	   * Leaders::getLatestLeaders()
	   * 
	   * @return
	   */
	  public function getLatestLeaders()
	  {

		  $sql = "SELECT l.*, l.id as lid, co.name, co.id as coid," 
		  . "\n (SELECT COUNT(lid) FROM " . Content::cmTable . " WHERE lid = l.id) as comments,"
		  . "\n (SELECT SUM(hits) FROM " . self::sTable . " WHERE lid = l.id) as hits"
		  . "\n FROM " . self::lTable . " as l"
		  . "\n LEFT JOIN constituencies as co ON co.id = l.cid" 
		  . "\n WHERE l.active = 1" 
		  . "\n ORDER BY l.created DESC LIMIT 0,".Registry::get('Core')->featured;
          $row = self::$db->fetch_all($sql);
		  
           return ($row) ? $row : 0;

	  }
	  	     

      /**
       * Leaders::yearlyStats()
       * 
       * @return
       */
      public function getYearlyStats()
      {
          $sql = "SELECT *, YEAR(year) as year, MONTH(year) as month," 
		  . "\n COUNT(id) as total" 
		  . "\n FROM " . self::saTable
		  . "\n WHERE YEAR(year) = '" . Registry::get("Core")->year . "'" 
		  . "\n GROUP BY year DESC, month DESC ORDER by year";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Leaders::getYearlySummary()
       * 
       * @return
       */
      public function getYearlySummary()
      {
          $sql = "SELECT YEAR(date) as year, MONTH(date) as month," 
		  . "\n COUNT(id) as total" 
		  . "\n FROM " . self::saTable
		  . "\n WHERE YEAR(year) = '" . Registry::get("Core")->year . "' GROUP BY year";

          $row = self::$db->first($sql);

          return ($row) ? $row : 0;
      }
	  	  	  	
	  
	  /**
	   * Leaders::getLeaderList()
	   * 
	   * @return
	   */
	  public function getLeaderList()
	  {
//		  $row = self::$db->fetch_all("SELECT id, CONCAT(first_name,' ',last_name) as name, slug FROM " . self::lTable . " WHERE active = 1 ORDER BY id");
//          return $row ? $row : 0;

		$sql = "SELECT l.*, CONCAT(l.first_name,' ',l.last_name) as name, co.name as constituency" 
		  . "\n FROM " . self::lTable . " as l"
		  . "\n LEFT JOIN " . self::coTable . " as co ON co.id = l.constituency"
		  . "\n WHERE active = 1"
		  . "\n ORDER BY name";

          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;

	  }

	  /**
	   * Leaders::updateRecentViews()
	   * 
	   * @return
	   */
	  private function updateRecentViews($lid)
	  {

		  if (!self::$db->first("SELECT lid FROM " . self::rTable . " WHERE user_id = '" . self::$db->escape(Registry::get("Users")->sesid) . "' AND lid = '" . $lid . "'")) {
			  $data['lid'] = $lid;
			  $data['user_id'] = Registry::get("Users")->sesid;
			  self::$db->insert(self::rTable, $data);
		  }
		  
	  }

      /**
       * Leaders::doStats()
       * 
       * @return
       */
	  private function doStats($lid)
	  {
		  if (@getenv("HTTP_CLIENT_IP")) {
			  $vInfo['ip'] = getenv("HTTP_CLIENT_IP");
		  } elseif (@getenv("HTTP_X_FORWARDED_FOR")) {
			  $vInfo['ip'] = getenv('HTTP_X_FORWARDED_FOR');
		  } elseif (@getenv('REMOTE_ADDR')) {
			  $vInfo['ip'] = getenv('REMOTE_ADDR');
		  } elseif (isset($_SERVER['REMOTE_ADDR'])) {
			  $vInfo['ip'] = $_SERVER['REMOTE_ADDR'];
		  } else {
			  $vInfo['ip'] = "Unknown";
		  }
		  
		  if (!preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/i", $vInfo['ip']) && $vInfo['ip'] != "Unknown") {
			  $pos = strpos($vInfo['ip'], ",");
			  $vInfo['ip'] = substr($vInfo['ip'], 0, $pos);
			  if ($vInfo['ip'] == "")
				  $vInfo['ip'] = "Unknown";
		  }
		  
		  $vInfo['ip'] = str_replace("[^0-9\.]", "", $vInfo['ip']);
		  setcookie("DDP_hitcookie", time(), time() + 3600);
		  $vCookie['is_cookie'] = (isset($_COOKIE['DDP_hitcookie'])) ? 1 : 0;
		  $date = date('Y-m-d');
		  
		  $sql = "SELECT * FROM " . self::sTable . " WHERE day='" . $date . "' AND lid = $lid";
		  $row = self::$db->first($sql);
		  if ($row) {
			  $hid = intval($row->id);
			  $stats['hits'] = "INC(1)";
			  self::$db->update(self::sTable, $stats, "id='" . $hid . "'");
			  
			  if (!isset($_COOKIE['DDP_unique']) && $vCookie['is_cookie']) {
				  setcookie("DDP_unique", time(), time() + 3600);
				  $stats['uhits'] = "INC(1)";
				  self::$db->update(self::sTable, $stats, "id='" . $hid . "'");
			  }
		  } else {
			  $data = array(
				  'lid' => $lid, 
				  'day' => $date, 
				  'hits' => 1,
				  'uhits' => 1,
			  );
			  self::$db->insert(self::sTable, $data);
		  }
	  }
	  
  }
?>