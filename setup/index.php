<?php
  /**
   * Index
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
?>
<?php
  if (!file_exists("../lib/config.ini.php")) {
      if (file_exists("install.php")) {
          header("Location: install.php");
      } else {
          die("<div style='text-align:center'>" 
			  . "<span style='padding: 5px; background-color:#f8f8f8;" 
			  . "font-family: Open Sans; font-size: 12px; margin-left:auto; margin-right:auto; display:inline-block'>" 
			  . "<b>Note:</b>The config file is missing, therefore installation cannot commence.</span></div>");
      }
  } else {
      die("<div style='text-align:center'>" 
		  . "<span style='padding: 5px; background-color:#f8f8f8;" 
		  . "font-family: Open Sans; font-size: 12px; margin-left:auto; margin-right:auto; display:inline-block'>" 
		  . "<b>Note:</b> The file config.ini.php already exists.<br>If you want to reinstall Membao, first delete config.ini.php</span></div>");
  }
?>