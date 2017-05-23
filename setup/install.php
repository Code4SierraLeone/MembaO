<?php
  /**
   * Install.php
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
?>
<?php
  define("_VALID_PHP", true);
  require_once ("functions.php");

  session_start();

  $msg = '';

  error_reporting(E_ALL);
  define("CMS_DS", DIRECTORY_SEPARATOR);
  define("BASE", dirname(__file__));
  define("DDPBASE", str_replace('setup', '', BASE));

  $script_path = str_replace('/setup', '', dirname($_SERVER['SCRIPT_NAME']));

  $_SERVER['REQUEST_TIME'] = time();

  $step = !isset($_GET['step']) ? 0 : (int)$_GET['step'];

  if (isset($_POST['db_action'])) {
      $err = false;

      if (!$_POST['dbhost'])
          $err[] = 1;

      if (!$_POST['dbuser'])
          $err[] = 2;

      if (!$_POST['dbname'])
          $err[] = 3;

      if (!$_POST['admin_username'])
          $err[] = 4;

      if (!$_POST['admin_password'])
          $err[] = 5;

      if ($_POST['admin_password'] != $_POST['admin_password2'])
          $err[] = 6;

      if (!$_POST['site_email'])
          $err[] = 7;

      if (!$err) {
          $link = mysqli_connect($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpwd']);

          $error = false;

          if (!$link) {
              $error = true;
              $msg = 'Could not connect to MySQL server: ' . mysqli_error($link) . '<br />';
          }

          if (!mysqli_select_db($link, $_POST['dbname'])) {
              $error = true;
              $msg .= 'Could not select database ' . sanitize($_POST['dbname']) . ': ' . mysqli_error($link);
          }

          /** Writing to database **/
          if (!$error) {
              mysqli_query($link, "CREATE DATABASE `" . $_POST['dbname'] . "`;");
              mysqli_select_db($link, $_POST['dbname']);

              $success = true;
              parse_mysql_dump("sql/structure.sql", $link);

              if ($success)
                  writeConfigFile($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpwd'], $_POST['dbname']);

              if ($script_path == "/")
                  $script_path = "";

              if ($content = @file_get_contents("../.htaccess")) {
                  if (!stristr($content, "RewriteBase " . $script_path . "/")) {
                      $content = str_replace("RewriteBase /", "RewriteBase " . $script_path . "/", $content);
                      $content = str_replace("ErrorDocument 404 /404.php", "ErrorDocument 404 " . $script_path . "/404.php", $content);
                      if (is_writable("../.htaccess")) {
                          $continue = true;
                      } else {
                          if (@chmod("../.htaccess", 0755)) {
                              $continue = true;
                          } else {
                              $continue = false;
                          }
                      }
                      if ($continue) {
                          if ($handle = @fopen("../.htaccess", "w")) {
                              @fwrite($handle, $content);
                              @fclose($handle);
                          }
                          @chmod("../.htaccess", 0644);
                      }
                  }
              }
          }

          if (!$error && isset($_POST['install_data'])) {
              $success = true;
              parse_mysql_dump("sql/sampledata.sql", $link);
              if (!$success) {
                  $msg = "Error in adding demo data<br /><em>The installation can continue, but the application will be blank, without any data.</em>";
              }
          }

          $user = (isset($_POST['admin_username'])) ? $_POST['admin_username'] : "";
          $pass = (isset($_POST['admin_password'])) ? sanitize($_POST['admin_password']) : "";
          $modrew = (isset($_COOKIE['modrew']) == "true") ? 1 : 0;
          $url = (isset($_POST['site_url'])) ? $_POST['site_url'] : "";
          $sdir = (isset($_POST['site_dir'])) ? $_POST['site_dir'] : "";
          $sitename = (isset($_POST['site_name'])) ? $_POST['site_name'] : "";
          $company = (isset($_POST['company'])) ? $_POST['company'] : "";
          $site_email = (isset($_POST['site_email'])) ? $_POST['site_email'] : "";

          mysqli_query($link, "INSERT INTO `users` (id, username, password, email, fname, lname, created, userlevel, active)
        VALUES ('1','" . sanitize($user) . "','" . sha1($pass) . "','" . sanitize($site_email) . "','App', 'Admin',NOW(),'9','y')");

          mysqli_query($link, "UPDATE `settings` SET 
		  site_name = '" . sanitize($sitename) . "', 
		  company = '" . sanitize($company) . "', 
		  site_url = '" . sanitize($url) . "', 
		  site_dir = '" . sanitize($sdir) . "', 
		  site_email = '" . sanitize($site_email) . "', 
		  seo ='" . $modrew . "'");

          mysqli_close($link);

          if (!$error) {
              if (!file_exists("../lib/config.inc.php")) {
                  cmsHeader();
                  include ("templates/finish.tpl.php");
                  cmsFooter();
                  exit;
              }
          }
      }
  }

?>
<?php cmsHeader();?>
<?php
  if (!$step):
      clearstatcache();
      include ("templates/pre_install.tpl.php");
  elseif ($step == '1'):
      include ("templates/configuration.tpl.php");
  else:
      echo 'Wrong step. Kindly follow installation instructions.';
  endif;

?>
<?php cmsFooter();?>