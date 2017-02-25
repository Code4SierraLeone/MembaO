<?php
/**
* Committees Class
*
* @package Membao
* @author Alan Kawamara
* @copyright 2017
*/
  
if (!defined("_VALID_PHP"))
	die('Direct access to this location is not allowed.');
  
class Committees
	{
    	const cTable = "committees";
      	const ctTable = "committees_type";
	  
	  	public $committeeslug = null;
	  	private static $db;
      
	    /**
	    * Committees::__construct()
	    * 
	    * @return
	    */
    
    	public function __construct()
      		{
        		self::$db = Registry::get("Database");
		  		$this->getCommitteeSlug();

      		}

		/**
		* Committee::getCommitteeSlug()
		* 
		* @return
		*/
	
		private function getCommitteeSlug()
	  		{		  
		  		if (isset($_GET['committeename'])) {
				  	$this->committeeslug = sanitize($_GET['committeename'],100);
				  	return self::$db->escape($this->committeeslug);
			  	}
		  	}
	  
	  	/**
	   	* Committees::getCommittees()
	  	* 
	   	* @param bool $sort
	   	* @return
	   	*/
	  
	  	public function getCommittees($from = '')
	  		{
		  		if (isset($_GET['letter']) and (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '')) {
			  		$enddate = date("Y-m-d");
			  		$letter = sanitize($_GET['letter'], 2);
			  		$fromdate = (empty($from)) ? $_POST['fromdate'] : $from;
			  		
			  		if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
				  		$enddate = $_POST['enddate'];
			  		}
			  		
			  		$q = "SELECT COUNT(*) FROM " . self::cTable . " WHERE created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'"
			  		. "\n AND name REGEXP '^" . self::$db->escape($letter) . "'";
			  		$where = " WHERE c.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59' AND name REGEXP '^" . self::$db->escape($letter) . "'";
			  
			  		} elseif (isset($_POST['fromdate']) && $_POST['fromdate'] <> "" || isset($from) && $from != '') {
				  		$enddate = date("Y-m-d");
				  		$fromdate = (empty($from)) ? $_POST['fromdate'] : $from;
				  		
				  		if (isset($_POST['enddate']) && $_POST['enddate'] <> "") {
					  		$enddate = $_POST['enddate'];
				  		}
				  		
				  		$q = "SELECT COUNT(*) FROM " . self::cTable . " WHERE created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
				  		$where = " WHERE c.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
				  
			  		} elseif(isset($_GET['letter'])) {
				  		$letter = sanitize($_GET['letter'], 2);
				  		$where = "WHERE name REGEXP '^" . self::$db->escape($letter) . "'";
				  		$q = "SELECT COUNT(*) FROM " . self::cTable . " WHERE name REGEXP '^" . self::$db->escape($letter) . "' LIMIT 1"; 
			  		} else {
				  		$q = "SELECT COUNT(*) FROM " . self::cTable . " LIMIT 1";
				  		$where = null;
			  		}
			  
		        $record = self::$db->query($q);
		        $total = self::$db->fetchrow($record);
		        $counter = $total[0];
				 
				$pager = Paginator::instance();
				$pager->items_total = $counter;
				$pager->default_ipp = Registry::get("Core")->perpage;
				$pager->paginate();
				  
				$sql = "SELECT c.*" 
				. "\n FROM " . self::cTable . " as c"
				. "\n $where"
				. "\n ORDER BY c.created DESC" . $pager->limit;
		        
		         $row = self::$db->fetch_all($sql);
				  
		        return ($row) ? $row : 0;
	  		}

	  	/**
	   	* Committees:::processCommittee()
	   	* 
	   	* @return
	   	*/
	  	public function processCommittee()
	  		{		  
		  		Filter::checkPost('name', "Enter committee name");
		  		Filter::checkPost('description', "Enter committee description");
		  		Filter::checkPost('committees_type', "Select committee type");		  		  
		    		  
		  		if (empty(Filter::$msgs)) {
			  		$data = array(
				  	'name' => sanitize($_POST['name']),				  
				  	'slug' => doSeo($_POST['name']),
				  	'description' => $_POST['description'],
				  	'committees_type' => $_POST['committees_type']
			  		);	
			  
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
			                              

				  	(Filter::$id) ? self::$db->update(self::cTable, $data, "id=" . Filter::$id) : $lastid = self::$db->insert(self::cTable, $data);
				  	$message = (Filter::$id) ? "Committee updated" : "Committee added";

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
	   	* Committees::renderCommittee()
	   	* 
	   	* @return
	   	*/
	  	
	  	public function renderCommittee()
	  		{
		  		$is_admin = Registry::get("Users")->is_Admin();
		  
		  		$sql = "SELECT c.*, c.id as cid," 		  		
		  		. "\n FROM " . self::cTable . " as c"		  
		  		. "\n WHERE c.slug = '".$this->committeeslug."'"
		  		. "\n $is_admin";
          		$row = self::$db->first($sql);		           
	  		}
	  	  	     	  
	  
	  	/**
	   	* Committees::getCommitteesList()
	   	* 
	   	* @return
	   	*/
	  	public function getCommitteesList()
	  		{
		  		$row = self::$db->fetch_all("SELECT id, name, slug FROM " . self::cTable . " ORDER BY created");
          		return $row ? $row : 0;
	  		}

		
		/**
		* Committees:::processCommitteeType()
		* 
		* @return
		*/
	
		public function processCommitteeType()
	  		{		  
				Filter::checkPost('name', "Enter committee name");			  		  		 
		    		  
		  		if (empty(Filter::$msgs)) {
			  		$data = array(
				  	'name' => sanitize($_POST['name']),
				  	'description' => $_POST['description']
			  		);			  			  	
			                              

			  		(Filter::$id) ? self::$db->update(self::ctTable, $data, "id=" . Filter::$id) : $lastid = self::$db->insert(self::ctTable, $data);
			  		$message = (Filter::$id) ? "Committee type updated" : "Committee type added";

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
	   	* Committees::getCommitteesList()
	   	* 
	   	* @return
	   	*/
	  	public function getCommitteesTypeList()
	  		{
		  		$row = self::$db->fetch_all("SELECT id, name FROM " . self::ctTable . " ORDER BY name");
          		return $row ? $row : 0;
	  		}	
  	}
?>