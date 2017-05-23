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
?>
<?php

  /**
   * getWritableCell()
   * 
   * @param mixed $aDir
   * @return
   */
  function getIniSettings($aSetting)
  {
      $out = (ini_get($aSetting) == '1' ? 'ON' : 'OFF');
      return $out;
  }

  /**
   * getWritableCell()
   * 
   * @param mixed $aDir
   * @return
   */
  function getWritableCell($aDir)
  {
	  echo '<tr>';
	  echo '<td class="elem">'.$aDir .CMS_DS.'</td>';
	  echo '<td>';
	  echo is_writable(DDPBASE.$aDir) ? '<span class="yes">Writeable</span>' : '<span class="no">Unwriteable</span>';
	  echo '</td>';
	  echo '</tr>';
  }

  /**
   * sanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function sanitize($string, $trim = false)
  {
	$string = filter_var($string, FILTER_SANITIZE_STRING); 
	$string = trim($string);
	$string = stripslashes($string);
	$string = strip_tags($string);
	$string = str_replace(array('‘','’','“','”'), array("'","'",'"','"'), $string);
	if($trim)
	$string = substr($string, 0, $trim);
	
	return $string;
  }

  /**
   * parse_mysql_dump()
   * 
   * @param mixed $filename
   * @param mixed $dblink
   * @return
   */
  function parse_mysql_dump($filename, $dblink)
  {
      global $success, $msg;

      $templine = '';
      $lines = file($filename);
      foreach ($lines as $line_num => $line) {
          if (substr($line, 0, 2) != '--' && $line != '') {
              $templine .= $line;
              if (substr(trim($line), -1, 1) == ';') {
                  if (!mysqli_query($dblink, $templine)) {
                      $success = false;
                      $msg = "<div class=\"qerror\">'" . mysqli_errno($dblink) . " " . mysqli_errno($dblink) . "' during the following query:</div> 
					  <div class=\"query\">{$templine} </div>";
                  }
                  $templine = '';
              }

          }
      }
  }

  /**
   * testModRewrite()
   * 
   * @return
   */
  function testModRewrite()
  {
      global $script_path;

      if ($script_path == "/")
          $script_path = "";

      if ($content = @file_get_contents(".htaccess")) {
          $content = str_replace("RewriteBase /setup/", "RewriteBase " . $script_path . "/setup/", $content);
          if (is_writable(".htaccess")) {
              $continue = true;
          } else {
              if (@chmod(".htaccess", 0755)) {
                  $continue = true;
              } else {
                  $continue = false;
              }
          }
          if ($continue) {
              if ($handle = @fopen(".htaccess", "w")) {
                  @fwrite($handle, $content);
                  @fclose($handle);
              }
              @chmod(".htaccess", 0644);
          }
      }
  }
  
  /**
   * writeConfigFile()
   * 
   * @param mixed $host
   * @param mixed $username
   * @param mixed $password
   * @param mixed $name
   * @return
   */
  function writeConfigFile($host, $username, $password, $name)
  {
      
          $content = "<?php \n" 
		  . "\t/** \n" 
		  . "\t* Configuration\n"
		  . "\n"
		  . "\t* @package Membao\n"
		  . "\t* @author Alan Kawamara\n"
		  . "\t* @copyright 2017\n"
		  . "\t*/\n"

		  . " \n" 
		  . "\t if (!defined(\"_VALID_PHP\")) \n"
		  . "     die('Direct access to this location is not allowed.');\n"
		  
		  . " \n" 
		  . "\t/** \n" 
		  . "\t* Database Constants - the constants refer to \n"
		  . "\t* the database config settings. \n"
		  . "\t*/\n"
		  . "\t define('DB_SERVER', '".$host."'); \n" 
		  . "\t define('DB_USER', '".$username."'); \n"  
		  . "\t define('DB_PASS', '".$password."'); \n"  
		  . "\t define('DB_DATABASE', '" . $name . "');\n" 

		  . " \n" 
		  . "\t/** \n" 
		  . "\t* Show MySql Errors. \n"
		  . "\t* Not recomended for live site. true/false \n"
		  . "\t*/\n"
		  . "\t define('DEBUG', false);\n"

		  . " \n" 
		  . "\t/** \n" 
		  . "\t* Cookie Constants - these are the parameters \n"
		  . "\t* to the setcookie function call, change them \n"
		  . "\t* if necessary to fit your website \n"
		  . "\t*/\n"
		  . "\t define('COOKIE_EXPIRE', 60 * 60 * 24 * 60); \n"  
		  . "\t define('COOKIE_PATH', '/');\n" 
		  . "?>";
      
      $confile = '../lib/config.ini.php';
      if (is_writable('../lib/')) {
          $handle = fopen($confile, 'w');
          fwrite($handle, $content);
          fclose($handle);
          $success = true;
      } else {
          $success = false;
      }
  }

  /**
   * safeConfig()
   * 
   * @param mixed $host
   * @param mixed $username
   * @param mixed $password
   * @param mixed $name
   * @return
   */
  function safeConfig($host, $username, $password, $name)
  {
	  $content = "<?php \n" 
	  . "\t/** \n" 
	  . "\t* Configuration\n"
	  . "\n"
	  . "\t* @package Membao\n"
	  . "\t* @author Alan Kawamara\n"
	  . "\t* @copyright 2017\n"
	  . "\t*/\n"

	  . " \n" 
	  . "\t if (!defined(\"_VALID_PHP\")) \n"
	  . "     die('Direct access to this location is not allowed.');\n"
	  
	  . " \n" 
	  . "\t/** \n" 
	  . "\t* Database Constants - the constants refer to \n"
	  . "\t* the database config settings. \n"
	  . "\t*/\n"
	  . "\t define('DB_SERVER', '".$host."'); \n" 
	  . "\t define('DB_USER', '".$username."'); \n"  
	  . "\t define('DB_PASS', '".$password."'); \n"  
	  . "\t define('DB_DATABASE', '" . $name . "');\n" 

	  . " \n" 
	  . "\t/** \n" 
	  . "\t* Show MySql Errors. \n"
	  . "\t* Not recomended for live site. true/false \n"
	  . "\t*/\n"
	  . "\t define('DEBUG', false);\n"

	  . " \n" 
	  . "\t/** \n" 
	  . "\t* Cookie Constants - these are the parameters \n"
	  . "\t* to the setcookie function call, change them \n"
	  . "\t* if necessary to fit your website \n"
	  . "\t*/\n"
	  . "\t define('COOKIE_EXPIRE', 60 * 60 * 24 * 60); \n"  
	  . "\t define('COOKIE_PATH', '/');\n" 
	  . "?>";
	  
	  return $content;
  }
  
  /**
   * cmsHeader()
   * 
   * @return
   */
  function cmsHeader()
  {
      echo '<!doctype html>';
      echo '<html>';
      echo '<head>';
      echo '<meta charset="utf-8">';
      echo '<title>Mem - Quickstart</title>';
      echo '<link rel="stylesheet" type="text/css" href="style.css" />';
      echo '</head>';
      echo '<body>';
      echo '<div class="logo"></div><div id="installation">';
  }


  /**
   * cmsFooter()
   * 
   * @return
   */
  function cmsFooter()
  {
      global $err;

      echo '</div>';
      echo '<div id="copyright">';
      echo 'Copyright &copy; ' . date("Y") . ' Memba-O!';
      echo '</div>';
      echo '<script type="text/javascript">';

      if ($err) {
          $j = 0;
          foreach ($err as $key => $i) {
              if ($i > 0) {
                  $first = ($j > 0) ? $i : '';
                  echo "document.getElementById('err{$i}').style.display = 'block';\n";
                  echo "document.getElementById('t{$i}').style.background = '#982420';\n";
                  $j++;
              }
          }
          echo "document.getElementById('t{$err[0]}').focus();\n";
      }

      echo '</script>';
      echo '</body>';
      echo '</html>';
  }
?>