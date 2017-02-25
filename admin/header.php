<?php
  /**
   * Header
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $core->site_name;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:300,400,700" rel="stylesheet">
<link href="<?php echo 'assets/cache/' . Minify::cache(array('css/base.css','css/button.css','css/image.css','css/icon.css','css/breadcrumb.css','css/popup.css','css/form.css','css/input.css','css/table.css','css/label.css','css/segment.css','css/message.css','css/divider.css','css/dropdown.css','css/list.css','css/breadcrumb.css','css/progress.css','css/header.css','css/menu.css','css/datepicker.css','css/editor.css','css/utility.css','css/style.css'),'css');?>" rel="stylesheet" type="text/css" />

<link rel="icon" type="image/png" href="assets/images/favicon.png" />

<script type="text/javascript" src="../assets/jquery.js"></script>
<script type="text/javascript" src="../assets/jquery-ui.js"></script>
<script type="text/javascript" src="../assets/modernizr.mq.js"></script>
<script type="text/javascript" src="../assets/global.js"></script>
<script type="text/javascript" src="../assets/editor.js"></script>
<script type="text/javascript" src="../assets/jquery.ui.touch-punch.js"></script>
<script type="text/javascript" src="../assets/editor.js"></script>
<script type="text/javascript" src="assets/js/master.js"></script>

</head>
<body>
<div id="helpbar" class="corporato wide floating info right sidebar"></div>