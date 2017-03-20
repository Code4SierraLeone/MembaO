<?php
  /**
   * Bills Class
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Bills
  {
      const bTable = "bills";
      const brTable = "bills_recent";
      const bsTable = "bills_stats";
      const btTable = "bills_status";
	  
	  public $billslug = null;
	  private static $db;
      
      /**
       * Bills::__construct()
       * 
       * @return
       */
      public function __construct()
      {
          self::$db = Registry::get("Database");
		  $this->getBillSlug();

      }

	  /**
	   * Bills::getCommitteeSlug()
	   * 
	   * @return
	   */
	  private function getBillSlug()
	  {
		  
		  if (isset($_GET['billname'])) {
			  $this->billslug = sanitize($_GET['billname'],100);
			  return self::$db->escape($this->billslug);
		  }
	  }
	  
	  /**
	   * Bills::getBills()
	   * 
	   * @param bool $sort
	   * @return
	   */
	  public function getBills($from = '')
	  {

		  if (isset($_GET['letter']) and (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '')) {
			  $enddate = date("Y-m-d");
			  $letter = sanitize($_GET['letter'], 2);
			  $fromdate = (empty($from)) ? $_POST['fromdate'] : $from;
			  if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
				  $enddate = $_POST['enddate'];
			  }
			  $q = "SELECT COUNT(*) FROM " . self::bTable . " WHERE created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'"
			  . "\n AND title REGEXP '^" . self::$db->escape($letter) . "'";
			  $where = " WHERE b.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59' AND title REGEXP '^" . self::$db->escape($letter) . "'";
			  
		  } elseif (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '') {
			  $enddate = date("Y-m-d");
			  $fromdate = (empty($from)) ? $_POST['fromdate'] : $from;
			  if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
				  $enddate = $_POST['enddate'];
			  }
			  $q = "SELECT COUNT(*) FROM " . self::bTable . " WHERE created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
			  $where = " WHERE b.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
			  
		  } elseif(isset($_GET['letter'])) {
			  $letter = sanitize($_GET['letter'], 2);
			  $where = "WHERE title REGEXP '^" . self::$db->escape($letter) . "'";
			  $q = "SELECT COUNT(*) FROM " . self::bTable . " WHERE title REGEXP '^" . self::$db->escape($letter) . "' LIMIT 1"; 
		  } else {
			  $q = "SELECT COUNT(*) FROM " . self::bTable . " LIMIT 1";
			  $where = null;
		  }
		  
          $record = self::$db->query($q);
          $total = self::$db->fetchrow($record);
          $counter = $total[0];
		  
		  $pager = Paginator::instance();
		  $pager->items_total = $counter;
		  $pager->default_ipp = Registry::get("Core")->perpage;
		  $pager->paginate();
		  
		  $sql = "SELECT b.*, c.name as committeename, CONCAT(l.first_name,' ',l.last_name) as movername" 
		  . "\n FROM " . self::bTable . " as b"
		  . "\n LEFT JOIN " . Committees::cTable . " as c ON c.id = b.committee"
		  . "\n LEFT JOIN " . Leaders::lTable . " as l ON l.id = b.mover"	  
		  . "\n $where"
		  . "\n ORDER BY b.created DESC" . $pager->limit;
          $row = self::$db->fetch_all($sql);          
		  
           return ($row) ? $row : 0;

	  }

	  /**
	   * Bills:::processBill()
	   * 
	   * @return
	   */
	  public function processBill()
	  {
		  
		  Filter::checkPost('title', "Enter bill name");
		  Filter::checkPost('description', "Enter bill description");
		  Filter::checkPost('date_introduced', "Select date introduced");
		  Filter::checkPost('bill_type', "Select bill type");		  
		  Filter::checkPost('committee', "Assign this bill to a committee");		  
		  
		    		  
		  if (empty(Filter::$msgs)) {

		  		$date_introduced = $_POST['date_introduced'];
				$fdate = DateTime::createFromFormat('d F, Y', $date_introduced);
				$fdate = $fdate->format("Y-m-d");

			  $data = array(
				  'title' => sanitize($_POST['title']),				  
				  'slug' => doSeo($_POST['title']),
				  'description' => $_POST['description'],
				  'bill_type' => $_POST['bill_type'],
				  'date_introduced' => $fdate,				  
				  'committee' => $_POST['committee'],				  				  
				  'featured' => intval($_POST['featured'])
			  );
			  
			  if (!empty($_POST['mover'])) {
				  $data['mover'] = $_POST['mover'];
			  }

			  if (!Filter::$id) {
				  $data['created'] = "NOW()";
			  }

			  if (empty($_POST['metakeys' . Lang::$lang]) or empty($_POST['metadesc'])) {
				  include (BASEPATH . 'lib/class_meta.php');
				  parseMeta::instance($_POST['description']);
				  if (empty($_POST['metakeys'])) {
					  $data['metakeys'] = parseMeta::get_keywords();
				  }
				  if (empty($_POST['metadesc'])) {
					  $data['metadesc'] = parseMeta::metaText($_POST['description']);
				  }
			  }
			                              

			  (Filter::$id) ? self::$db->update(self::bTable, $data, "id=" . Filter::$id) : $lastid = self::$db->insert(self::bTable, $data);
			  $message = (Filter::$id) ? "Bill updated" : "Bill added";

			  if (self::$db->affected()) {
					$btdata = array(				  	
				  	'bill' => $lastid,
				  	'status_date' => $fdate,
				  	'status' => 1
			  		);
			  		self::$db->insert(self::btTable, $btdata);
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
	   * Bills::renderBill()
	   * 
	   * @return
	   */
	  public function renderBill()
	  {
		  
		  $sql = "SELECT b.*, b.id as bid, c.name as committeename, c.slug as cslug, CONCAT(l.first_name,' ',l.last_name) as movername, l.slug as mslug," 		  
		  . "\n (SELECT SUM(hits) FROM " . self::bsTable . " WHERE bid = b.id) as hits"
		  . "\n FROM " . self::bTable . " as b"	
		  . "\n LEFT JOIN " . Committees::cTable . " as c ON c.id = b.committee"
		  . "\n LEFT JOIN " . Leaders::lTable . " as l ON l.id = b.mover"	  
		  . "\n WHERE b.slug = '".$this->billslug."'";
		  
          $row = self::$db->first($sql);
		  
          if ($row) {
			  $this->updateRecentViews($row->bid);
			  $this->doStats($row->bid);
              return $row;
          } else
              return 0;

	  }


	  /**
       * Bills::getBillHistory()
       * 
       * @return
       */
      public function getBillHistory($bill_id)
      {
		  
          $sql = "SELECT bt.*, bt.id as bid" 		  
		  . "\n FROM " . self::btTable . " as bt"
		  . "\n WHERE bt.bill = ".$bill_id
		  . "\n ORDER BY id DESC";
          
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : "0";
      }


	  /**
       * Bills::mostPopBills()
       * 
       * @return
       */
      public function mostPopBills()
      {
		  
          $sql = "SELECT b.*, b.id as bid" 
		  . "\n (SELECT SUM(hits) FROM " . self::bsTable . " WHERE bid = b.id) as hits"
		  . "\n FROM " . self::bTable . " as b"		  
		  . "\n ORDER BY hits DESC," . Registry::get("Core")->popular;
          
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : "none";
      }
	  
	  /**
       * Bills::featuredBills()
       * 
       * @return
       */
      public function featuredBills()
      {
		  
          $sql = "SELECT b.*, b.id as bid" 
		  . "\n FROM " . self::bTable . " as b"			  	 
		  . "\n WHERE b.featured = 1 ORDER BY RAND() LIMIT 1";
          
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }	  
	  

	  
	  /**
	   * Bills::renderRecentViews()
	   * 
	   * @return
	   */
	  public function renderRecentViews()
	  {

		  $sql = "SELECT br.*, b.id as bid, b.title, b.slug"
		  . "\n FROM " . self::brTable . " as br"
		  . "\n LEFT JOIN " . self::bTable . " as b ON b.id = r.bid"
		  . "\n WHERE br.user_id = '" . self::$db->escape(Registry::get("Users")->sesid) . "'"
		  . "\n GROUP BY br.bid ORDER BY b.title LIMIT 10";
		  
          $row = self::$db->fetch_all($sql);
          
		  return ($row) ? $row : 0;

	  }

  
	  	    
	  /**
	   * Bills::getLatestBills()
	   * 
	   * @return
	   */
	  public function getLatestBills()
	  {

		  $sql = "SELECT b.*, b.id as bid" 		
		  . "\n (SELECT SUM(hits) FROM " . self::bsTable . " WHERE bid = b.id) as hits"
		  . "\n FROM " . self::bTable . " as b"		  
		  . "\n ORDER BY b.created DESC LIMIT 0,".Registry::get('Core')->featured;
          $row = self::$db->fetch_all($sql);
		  
           return ($row) ? $row : 0;

	  }

	  /**
	   	* Committees:::processBillStatus()
	   	* 
	   	* @return
	   	*/
	  	public function processBillStatus()
	  		{		  
		  		Filter::checkPost('status_date', "Enter date");
		  		Filter::checkPost('bill_status', "Select new status");		 
		    		  
		  		if (empty(Filter::$msgs)) {

		  			$status_date = $_POST['status_date'];
					$sdate = DateTime::createFromFormat('d F, Y', $status_date);
					$sdate = $sdate->format("Y-m-d");

			  		$data = array(				  	
				  	'bill' => $_POST['bill'],
				  	'status_date' => $sdate,
				  	'status' => $_POST['bill_status']
			  		);				  				  					  
			                              

				  	$lastid = self::$db->insert(self::btTable, $data);
				  	$message = "Bill status added";

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
	   * Bills::getBillsList()
	   * 
	   * @return
	   */
	  public function getBillsList()
	  {
		  $row = self::$db->fetch_all("SELECT id, title, slug FROM " . self::bTable . " WHERE active = 1 ORDER BY created");
          return $row ? $row : 0;
	  }

	  /**
	   * Bills::updateRecentViews()
	   * 
	   * @return
	   */
	  private function updateRecentViews($bid)
	  {

		  if (!self::$db->first("SELECT bid FROM " . self::brTable . " WHERE user_id = '" . self::$db->escape(Registry::get("Users")->sesid) . "' AND bid = '" . $bid . "'")) {
			  $data['bid'] = $bid;
			  $data['user_id'] = Registry::get("Users")->sesid;
			  self::$db->insert(self::brTable, $data);
		  }
		  
	  }

      /**
       * Bills::doStats()
       * 
       * @return
       */
	  private function doStats($bid)
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
		  
		  $sql = "SELECT * FROM " . self::bsTable . " WHERE day='" . $date . "' AND bid = $bid";
		  $row = self::$db->first($sql);
		  if ($row) {
			  $hid = intval($row->id);
			  $stats['hits'] = "INC(1)";
			  self::$db->update(self::bsTable, $stats, "id='" . $hid . "'");
			  
			  if (!isset($_COOKIE['DDP_unique']) && $vCookie['is_cookie']) {
				  setcookie("DDP_unique", time(), time() + 3600);
				  $stats['uhits'] = "INC(1)";
				  self::$db->update(self::bsTable, $stats, "id='" . $hid . "'");
			  }
		  } else {
			  $data = array(
				  'bid' => $bid, 
				  'day' => $date, 
				  'hits' => 1,
				  'uhits' => 1,
			  );
			  self::$db->insert(self::bsTable, $data);
		  }
	  }
	  
  }
?>