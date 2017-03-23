<?php
  /**
   * Functions
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  /**
   * redirect_to()
   * 
   * @param mixed $location
   * @return
   */
  function redirect_to($location)
  {
      if (!headers_sent()) {
          header('Location: ' . $location);
		  exit;
	  } else
          echo '<script type="text/javascript">';
          echo 'window.location.href="' . $location . '";';
          echo '</script>';
          echo '<noscript>';
          echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
          echo '</noscript>';
  }
  
  /**
   * countEntries()
   * 
   * @param mixed $table
   * @param string $where
   * @param string $what
   * @return
   */
  function countEntries($table, $where = '', $what = '')
  {
      if (!empty($where) && isset($what)) {
          $q = "SELECT COUNT(*) FROM " . $table . "  WHERE " . $where . " = '" . $what . "' LIMIT 1";
      } else
          $q = "SELECT COUNT(*) FROM " . $table . " LIMIT 1";
      
      $record = Registry::get("Database")->query($q);
      $total = Registry::get("Database")->fetchrow($record);
      return $total[0];
  }
  
  /**
   * getChecked()
   * 
   * @param mixed $row
   * @param mixed $status
   * @return
   */
  function getChecked($row, $status)
  {
      if ($row == $status) {
          echo "checked=\"checked\"";
      }
  }
  
  /**
   * pluralize()
   * 
   * @param mixed $count
   * @param mixed $singular
   * @param mixed $plural
   * @return
   */
   
  function pluralize($count, $singular, $plural = false)
  {
	   if (!$plural) $plural = $singular . 's';
	
	  return ($count == 1 ? $singular : $plural) ;
  }
  
  /**
   * post()
   * 
   * @param mixed $var
   * @return
   */
  function post($var)
  {
      if (isset($_POST[$var]))
          return $_POST[$var];
  }
  
  /**
   * get()
   * 
   * @param mixed $var
   * @return
   */
  function get($var)
  {
      if (isset($_GET[$var]))
          return $_GET[$var];
  }
  
  /**
   * sanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function sanitize($string, $trim = false,  $end_char = '&#8230;', $int = false, $str = false)
  {
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim) {
        if (strlen($string) < $trim)
        {
            return $string;
        }

        $string = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $string));

        if (strlen($string) <= $trim)
        {
            return $string;
        }

        $out = "";
        foreach (explode(' ', trim($string)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $trim)
            {
                $out = trim($out);
                return (strlen($out) == strlen($string)) ? $out : $out.$end_char;
            }       
        }
		  
          //$string = substr($string, 0, $trim);
		  
	  }
      if ($int)
		  $string = preg_replace("/[^0-9\s]/", "", $string);
      if ($str)
		  $string = preg_replace("/[^a-zA-Z\s]/", "", $string);
		  
      return $string;
  }

  /**
   * truncate()
   * 
   * @param mixed $string
   * @param mixed $length
   * @param bool $ellipsis
   * @return
   */
  function truncate($string, $length, $ellipsis = true)
  {
      $wide = strlen(preg_replace('/[^A-Z0-9_@#%$&]/', '', $string));
      $length = round($length - $wide * 0.2);
      $clean_string = preg_replace('/&[^;]+;/', '-', $string);
      if (strlen($clean_string) <= $length)
          return $string;
      $difference = $length - strlen($clean_string);
      $result = substr($string, 0, $difference);
      if ($result != $string and $ellipsis) {
          $result = add_ellipsis($result);
      }
      return $result;
  }

  /**
   * add_ellipsis()
   * 
   * @param mixed $string
   * @return
   */
  function add_ellipsis($string)
  {
      $string = substr($string, 0, strlen($string) - 3);
      return trim(preg_replace('/ .{1,3}$/', '', $string)) . '...';
  }
   
  /**
   * getValue()
   * 
   * @param mixed $stwhatring
   * @param mixed $table
   * @param mixed $where
   * @return
   */
  function getValue($what, $table, $where)
  {
      $sql = "SELECT $what FROM $table WHERE $where";
      $row = Registry::get("Database")->first($sql);
      return ($row) ? $row->$what : '';
  }  

  /**
   * getValueById()
   * 
   * @param mixed $what
   * @param mixed $table
   * @param mixed $id
   * @return
   */
  function getValueById($what, $table, $id)
  {
      $sql = "SELECT $what FROM $table WHERE id = $id";
      $row = Registry::get("Database")->first($sql);
      return ($row) ? $row->$what : '';
  } 
  
  /**
   * tooltip()
   * 
   * @param mixed $tip
   * @return
   */
  function tooltip($tip)
  {
      return '<img src="'.ADMINURL.'/images/tooltip.png" alt="Tip" class="tooltip" title="' . $tip . '" />';
  }
  
  /**
   * required()
   * 
   * @return
   */
  function required()
  {
      return '<img src="'.ADMINURL.'/images/required.png" alt="Required Field" class="tooltip" title="Required Field" />';
  }

  /**
   * cleanOut()
   * 
   * @param mixed $text
   * @return
   */
  function cleanOut($text) {
	 $text =  strtr($text, array('\r\n' => "", '\r' => "", '\n' => ""));
	 $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
	 //$text = str_replace('<br>', '<br />', $text);
	 return stripslashes($text);
  }
    
  /**
   * cleanSanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function cleanSanitize($string, $trim = false,  $end_char = '&#8230;')
  {
	  $string = cleanOut($string);
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim) {
        if (strlen($string) < $trim)
        {
            return $string;
        }

        $string = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $string));

        if (strlen($string) <= $trim)
        {
            return $string;
        }

        $out = "";
        foreach (explode(' ', trim($string)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $trim)
            {
                $out = trim($out);
                return (strlen($out) == strlen($string)) ? $out : $out.$end_char;
            }       
        }
	  }
      return $string;
  }
 

  /**
   * phpself()
   * 
   * @return
   */
  function phpself()
  {
      return htmlspecialchars($_SERVER['PHP_SELF']);
  }
  
  /**
   * alphaBits()
   * 
   * @param bool $all
   * @param array $vars
   * @return
   */
  function alphaBits($all = false, $vars)
  {
      if (!empty($_SERVER['QUERY_STRING'])) {
          $parts = explode("&amp;", $_SERVER['QUERY_STRING']);
          $vars = str_replace(" ", "", $vars);
          $c_vars = explode(",", $vars);
          $newParts = array();
          foreach ($parts as $val) {
              $val_parts = explode("=", $val);
              if (!in_array($val_parts[0], $c_vars)) {
                  array_push($newParts, $val);
              }
          }
          if (count($newParts) != 0) {
              $qs = "&amp;" . implode("&amp;", $newParts);
          } else {
              return false;
          }
          
		  $html = '';
          $charset = explode(",", Lang::$word->ALPHA);
          $html .= "<div class=\"corporato small pagination menu\">\n";
          foreach ($charset as $key) {
			  $active = ($key == get('letter')) ? ' active' : null;
              $html .= "<a class=\"item$active\" href=\"" . phpself() . "?letter=" . $key . $qs . "\">" . $key . "</a>\n";
          }
          $viewAll = ($all === false) ? phpself() : $all;
          $html .= "<a class=\"item\" href=\"" . $viewAll . "\">" . Lang::$word->VIEWALL . "</a>\n";
          $html .= "</div>\n";
		  unset($key);
		  
		  return $html;
	  } else {
		  return false;
	  }
  }
  
  /**
   * isAdmin()
   * 
   * @param mixed $userlevel
   * @return
   */
  function isAdmin($userlevel)
  {
	  switch ($userlevel) {
		  case 9:
		     $display = '<img src="'.SITEURL.'/images/superadmin.png" alt="" class="tooltip" title="Super Admin"/>';
			 break;

		  case 7:
		     $display = '<img src="'.SITEURL.'/images/level7.png" alt="" class="tooltip" title="User Level 7"/>';
			 break;

		  case 6:
		     $display = '<img src="'.SITEURL.'/images/level6.png" alt="" class="tooltip" title="User Level 6"/>';
			 break;

		  case 5:
		     $display = '<img src="'.SITEURL.'/images/level5.png" alt="" class="tooltip" title="User Level 5"/>';
			 break;
			 
		  case 4:
		     $display = '<img src="'.SITEURL.'/images/level4.png" alt="" class="tooltip" title="User Level 4"/>';
			 break;		  

		  case 3:
		     $display = '<img src="'.SITEURL.'/images/level6.png" alt="" class="tooltip" title="User Level 3"/>';
			 break;

		  case 2:
		     $display = '<img src="'.SITEURL.'/images/level5.png" alt="" class="tooltip" title="User Level 2"/>';
			 break;
			 
		  case 1:
		     $display = '<img src="'.SITEURL.'/images/user.png" alt="" class="tooltip" title="User"/>';
			 break;			  
	  }

      return $display;;
  }

  /**
   * userStatus()
   * 
   * @param mixed $id
   * @return
   */
  function userStatus($status, $id)
  {
      switch ($status) {
          case "y":
              $display = '<span class="corporato positive label">' . Lang::$word->ACTIVE . '</span>';
              break;

          case "n":
              $display = '<a data-id="' . $id . '" class="activate corporato info label"><i class="icon adjust"></i> ' . Lang::$word->INACTIVE . '</a>';
              break;

          case "t":
              $display = '<span class="corporato warning label">' . Lang::$word->PENDING . '</span>';
              break;

          case "b":
              $display = '<span class="corporato negative label">' . Lang::$word->BANNED . '</span>';
              break;
      }

      return $display;
      ;
  }
  
  /**
   * getGender()
   * 
   * @param mixed $pos
   * @return
   */  
  function getGender($gender)
  {
      switch ($gender) {
          case 1:
              return "Male";
          case 2:
              return "Female";
      }
  }

  /**
   * getGenderForm()
   * 
   * @param mixed $pos
   * @return
   */  
  function getGenderForm($gender)
  {
      switch ($gender) {
          case 1:
              return "him";
          case 2:
              return "her";
      }
  }


   /**
   * getCommitteeMeetingType()
   * 
   * @param mixed $pos
   * @return
   */  
  function getCommitteeMeetingType($mtype)
  {
      switch ($mtype) {
          case 1:
              return "In camera";
          case 2:
              return "Public";
      }
  }

    /**
   * getCommitteeMemberRole()
   * 
   * @param mixed $pos
   * @return
   */  
  function getCommitteeMemberRole($role)
  {
      switch ($role) {
          case 1:
              return "Chairperson";
          case 2:
              return "Deputy Chairperson";
          case 3:
              return "Member";    
      }
  } 

    /**
   * getAttendanceStatus()
   * 
   * @param mixed $pos
   * @return
   */  
  function getAttendanceStatus($status)
  {
      switch ($status) {
          case 0:
              return "Absent";
          case 1:
              return "Present";
          case 2:
              return "Absent with leave";    
      }
  }  

  /**
   * getBillType()
   * 
   * @param mixed $pos
   * @return
   */  
  function getBillType($type)
  {
      switch ($type) {
          case 1:
              return "Private Member's Bill";
          case 2:
              return "Govermment Bill";		  
      }
  }

  /**
   * getBillStatus()
   * 
   * @param mixed $pos
   * @return
   */  
  function getBillStatus($status)
  {
      switch ($status) {
          case 1:
              return "1st Reading";
          case 2:
              return "Reference to Standing Committee";
          case 3:
              return "2nd Reading";
          case 4:
              return "3rd Reading";
          case 5:
              return "Passed by Parliament";
          case 6:
              return "Rejected by Parliament";
          case 7:
              return "Submitted for Presidential Ascent";
          case 8:
              return "Vetoed by President";                             
          case 9:
              return "Became an Act";    
      }
  }

  /**
   * getSType()
   * 
   * @param mixed $pos
   * @return
   */  
  function getSType($type)
  {
      switch ($type) {
          case 1:
              return "House session";
          case 2:
              return "Committee session";
      case 3:
              return "Budget session";    
      }
  }  
  
	 /**
       * getAge()
       * 
       * @return
       */
      function getAge($dob = false)
      {         		 
		    if($dob == '0000-00-00'){
          $age = "Age not given";
        } else {
          $diff = abs(strtotime(date("Y-m-d")) - strtotime($dob));
          $age = floor($diff / (365*60*60*24)). " years";      
        }
        
		    return $age;		 
      }

      /**
       * getAttendanceAverage($leaderav, $generalav)
       * 
       * @return
       */
      function getAttendanceAverage($leaderav, $generalav)
      {              
        if($leaderav > $generalav){
          $av = "an above-average";
        } elseif ($leaderav == $generalav) {          
          $av = "an average";      
        }
        else {
          $av = "a below-average";
        }
        
        return $av;     
      }      

  /**
       * getLeaderAttendancePc()
       * 
       * @return
       */
      function getLeaderAttendancePc($lsittings, $tsittings)
      {              
        $leaderattendancepc = ($lsittings / $tsittings)*100;
        
        return round($leaderattendancepc,1);     
      }         

  /**
   * isActive()
   * 
   * @param mixed $id
   * @return
   */
  function isActive($id)
  {
      if ($id == 1) {
          $display = '<i data-content="' . Lang::$word->ACTIVE . '" class="circular inverted icon check"></i>';
      } else {
          $display = '<i data-content="' . Lang::$word->PENDING . '" class="circular inverted icon time"></i>';
      }

      return $display;
  }

  /**
   * getTemplates()
   * 
   * @param mixed $dir
   * @param mixed $site
   * @return
   */
  function getTemplates($dir, $site)
  {
      $getDir = dir($dir);
      while (false !== ($templDir = $getDir->read())) {
          if ($templDir != "." && $templDir != ".." && $templDir != "index.php") {
              $selected = ($site == $templDir) ? " selected=\"selected\"" : "";
              echo "<option value=\"{$templDir}\"{$selected}>{$templDir}</option>\n";
          }
      }
      $getDir->close();
  }

  /**
   * timesince()
   * 
   * @param int $original
   * @return
   */
  function timesince($original)
  {
      // array of time period chunks
      $chunks = array(
          array(60 * 60 * 24 * 365, 'year'),
          array(60 * 60 * 24 * 30, 'month'),
          array(60 * 60 * 24 * 7, 'week'),
          array(60 * 60 * 24, 'day'),
          array(60 * 60, 'hour'),
          array(60, 'min'),
          array(1, 'sec'),
          );

      $today = time();
       /* Current unix time  */
      $since = $today - $original;

      // $j saves performing the count function each time around the loop
      for ($i = 0, $j = count($chunks); $i < $j; $i++) {
          $seconds = $chunks[$i][0];
          $name = $chunks[$i][1];

          // finding the biggest chunk (if the chunk fits, break)
          if (($count = floor($since / $seconds)) != 0) {
              break;
          }
      }

      $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";

      if ($i + 1 < $j) {
          // now getting the second item
          $seconds2 = $chunks[$i + 1][0];
          $name2 = $chunks[$i + 1][1];

          // add second item if its greater than 0
          if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
              $print .= ($count2 == 1) ? ', 1 ' . $name2 : " $count2 {$name2}s";
          }
      }
      return $print . ' ' . Lang::$word->AGO;
  } 

  /**
   * compareFloatNumbers()
   * 
   * @param mixed $float1
   * @param mixed $float2
   * @param string $operator
   * @return
   */
  function compareFloatNumbers($float1, $float2, $operator='=')  
  {  
	  // Check numbers to 5 digits of precision  
	  $epsilon = 0.00001;  
		
	  $float1 = (float)$float1;  
	  $float2 = (float)$float2;  
		
	  switch ($operator)  
	  {  
		  // equal  
		  case "=":  
		  case "eq":  
			  if (abs($float1 - $float2) < $epsilon) {  
				  return true;  
			  }  
			  break;    
		  // less than  
		  case "<":  
		  case "lt":  
			  if (abs($float1 - $float2) < $epsilon) {  
				  return false;  
			  } else {  
				  if ($float1 < $float2) {  
					  return true;  
				  }  
			  }  
			  break;    
		  // less than or equal  
		  case "<=":  
		  case "lte":  
			  if (compareFloatNumbers($float1, $float2, '<') || compareFloatNumbers($float1, $float2, '=')) {  
				  return true;  
			  }  
			  break;    
		  // greater than  
		  case ">":  
		  case "gt":  
			  if (abs($float1 - $float2) < $epsilon) {  
				  return false;  
			  } else {  
				  if ($float1 > $float2) {  
					  return true;  
				  }  
			  }  
			  break;    
		  // greater than or equal  
		  case ">=":  
		  case "gte":  
			  if (compareFloatNumbers($float1, $float2, '>') || compareFloatNumbers($float1, $float2, '=')) {  
				  return true;  
			  }  
			  break;    
		
		  case "<>":  
		  case "!=":  
		  case "ne":  
			  if (abs($float1 - $float2) > $epsilon) {  
				  return true;  
			  }  
			  break;    
		  default:  
			  die("Unknown operator '".$operator."' in compareFloatNumbers()");    
	  }  
		
	  return false;  
  } 
  
  /**
   * getSize()
   * 
   * @param mixed $size
   * @param integer $precision
   * @param bool $long_name
   * @param bool $real_size
   * @return
   */
  function getSize($size, $precision = 2, $long_name = false, $real_size = true)
  {
	  $base = $real_size ? 1024 : 1000;
	  $pos = 0;
	  while ($size > $base) {
		  $size /= $base;
		  $pos++;
	  }
	  $prefix = _getSizePrefix($pos);
	  @$size_name = ($long_name) ? $prefix . "bytes" : $prefix[0] . "B";
	  return round($size, $precision) . ' ' . ucfirst($size_name);
  }
  
  /**
   * _getSizePrefix()
   * 
   * @param mixed $pos
   * @return
   */
  function _getSizePrefix($pos)
  {
	  switch ($pos) {
		  case 00:
			  return "";
		  case 01:
			  return "kilo";
		  case 02:
			  return "mega";
		  case 03:
			  return "giga";
		  default:
			  return "?-";
	  }
  }
  
  /**
   * getFileType()
   * 
   * @param mixed $filename
   * @return
   */
  function getFileType($filename)
  {
	  if (preg_match("/^.*\.(jpg|jpeg|png|gif|bmp)$/i", $filename) != 0) {
		  return 'image';

	  } elseif (preg_match("/^.*\.(txt|css|php|sql|js)$/i", $filename) != 0) {
		  return 'text';

	  } elseif (preg_match("/^.*\.(zip)$/i", $filename) != 0) {
		  return 'zip';
	  }
	  return 'generic';
  }
  /**
   * getMIMEtype()
   * 
   * @param mixed $filename
   * @return
   */
  function getMIMEtype($filename)
  {
	  preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);
	  
	  $fs = (isset($fileSuffix[1])) ? $fileSuffix[1] : null;
	  
	  switch(strtolower($fs))
	  {
		  case "js" :
			  return "application/x-javascript";

		  case "json" :
			  return "application/json";

		  case "jpg" :
		  case "jpeg" :
		  case "jpe" :
			  return "image/jpg";

		  case "png" :
		  case "gif" :
		  case "bmp" :
		  case "tiff" :
			  return "image/".strtolower($fs);

		  case "css" :
			  return "text/css";

		  case "xml" :
			  return "application/xml";

		  case "doc" :
		  case "docx" :
			  return "application/msword";

		  case "xls" :
		  case "xlt" :
		  case "xlm" :
		  case "xld" :
		  case "xla" :
		  case "xlc" :
		  case "xlw" :
		  case "xll" :
			  return "application/vnd.ms-excel";

		  case "ppt" :
		  case "pps" :
			  return "application/vnd.ms-powerpoint";

		  case "rtf" :
			  return "application/rtf";

		  case "pdf" :
			  return "application/pdf";

		  case "html" :
		  case "htm" :
		  case "php" :
			  return "text/html";

		  case "txt" :
			  return "text/plain";

		  case "mpeg" :
		  case "mpg" :
		  case "mpe" :
			  return "video/mpeg";

		  case "mp3" :
			  return "audio/mpeg3";

		  case "wav" :
			  return "audio/wav";

		  case "aiff" :
		  case "aif" :
			  return "audio/aiff";

		  case "avi" :
			  return "video/msvideo";

		  case "wmv" :
			  return "video/x-ms-wmv";

		  case "mov" :
			  return "video/quicktime";

		  case "zip" :
			  return "application/zip";

		  case "tar" :
			  return "application/x-tar";

		  case "swf" :
			  return "application/x-shockwave-flash";

		  default :
		  if(function_exists("mime_content_type"))
		  {
			  $fileSuffix = mime_content_type($filename);
		  }

		  return "unknown/" . trim($fs, ".");
	  }
  }

  /**
   * randName()
   * 
   * @return
   */ 
  function siteurl(){
	  if(isset($_SERVER['HTTPS'])){
		  $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	  }
	  else{
		  $protocol = 'http';
	  }
	    $ds = '/';
		$url = preg_replace("#/+#", "/", $_SERVER['HTTP_HOST'] . $ds . Registry::get("Core")->site_dir);
		
	  return $protocol . "://" . $url;
  }
	  
  /**
   * randName()
   * 
   * @return
   */ 
  function randName() {
	  $code = '';
	  for($x = 0; $x<6; $x++) {
		  $code .= '-'.substr(strtoupper(sha1(rand(0,999999999999999))),2,6);
	  }
	  $code = substr($code,1);
	  return $code;
  }
  
  /**
   * downloadFile()
   * 
   * @return
   */ 
  function downloadFile($fileLocation, $fileName, $update = false, $tid = 1, $maxSpeed = 1024)
  {
      if (connection_status() != 0)
          return (false);
      //$extension = strtolower(end(explode('.', $fileName)));
	  $extension = strtolower(substr($fileName, strrpos($fileName, '.') + 1));

      /* List of File Types */
      $fileTypes['swf'] = 'application/x-shockwave-flash';
      $fileTypes['pdf'] = 'application/pdf';
      $fileTypes['exe'] = 'application/octet-stream';
      $fileTypes['zip'] = 'application/zip';
      $fileTypes['doc'] = 'application/msword';
      $fileTypes['xls'] = 'application/vnd.ms-excel';
      $fileTypes['ppt'] = 'application/vnd.ms-powerpoint';
      $fileTypes['gif'] = 'image/gif';
      $fileTypes['png'] = 'image/png';
      $fileTypes['jpeg'] = 'image/jpg';
      $fileTypes['jpg'] = 'image/jpg';
      $fileTypes['rar'] = 'application/rar';

      $fileTypes['ra'] = 'audio/x-pn-realaudio';
      $fileTypes['ram'] = 'audio/x-pn-realaudio';
      $fileTypes['ogg'] = 'audio/x-pn-realaudio';

      $fileTypes['wav'] = 'video/x-msvideo';
      $fileTypes['wmv'] = 'video/x-msvideo';
      $fileTypes['avi'] = 'video/x-msvideo';
      $fileTypes['asf'] = 'video/x-msvideo';
      $fileTypes['divx'] = 'video/x-msvideo';

      $fileTypes['mp3'] = 'audio/mpeg';
      $fileTypes['mp4'] = 'audio/mpeg';
      $fileTypes['mpeg'] = 'video/mpeg';
      $fileTypes['mpg'] = 'video/mpeg';
      $fileTypes['mpe'] = 'video/mpeg';
      $fileTypes['mov'] = 'video/quicktime';
      $fileTypes['swf'] = 'video/quicktime';
      $fileTypes['3gp'] = 'video/quicktime';
      $fileTypes['m4a'] = 'video/quicktime';
      $fileTypes['aac'] = 'video/quicktime';
      $fileTypes['m3u'] = 'video/quicktime';

      $contentType = $fileTypes[$extension];


      header("Cache-Control: public");
      header("Content-Transfer-Encoding: binary\n");
      header('Content-Type: $contentType');

      $contentDisposition = 'attachment';

      if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
          $fileName = preg_replace('/\./', '%2e', $fileName, substr_count($fileName, '.') - 1);
          header("Content-Disposition: $contentDisposition;filename=\"$fileName\"");
      } else {
          header("Content-Disposition: $contentDisposition;filename=\"$fileName\"");
      }

      header("Accept-Ranges: bytes");
      $range = 0;
      $size = filesize($fileLocation);

      if (isset($_SERVER['HTTP_RANGE'])) {
          list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
          str_replace($range, "-", $range);
          $size2 = $size - 1;
          $new_length = $size - $range;
          header("HTTP/1.1 206 Partial Content");
          header("Content-Length: $new_length");
          header("Content-Range: bytes $range$size2/$size");
      } else {
          $size2 = $size - 1;
          header("Content-Range: bytes 0-$size2/$size");
          header("Content-Length: " . $size);
      }

      if ($size == 0) {
          die('Zero byte file! Aborting download');
      }

      $fp = fopen("$fileLocation", "rb");

      fseek($fp, $range);

      while (!feof($fp) and (connection_status() == 0)) {
          set_time_limit(0);
          print (fread($fp, 1024 * $maxSpeed));
          flush();
          @ob_flush();
          sleep(1);
      }
      fclose($fp);
	  
	  if($update){
		  $data['downloads'] = "INC(1)";
		  Registry::get("Database")->update(Products::tTable, $data, "id='" . $tid . "'");
	  }
      exit;

      return ((connection_status() == 0) and !connection_aborted());
  } 
?>