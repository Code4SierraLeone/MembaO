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
	  
   $menu = $content->getMenu();
?>
<!doctype html>

<head>
<?php $row = isset($row) ? $row : null;?>
<?php echo $content->renderMetaData($row);?>
<script type="text/javascript">
var SITEURL = "<?php echo SITEURL; ?>";
</script>
<link href="<?php echo THEMEURL . '/cache/' . Minify::cache(array('css/base.css','css/button.css','css/image.css','css/icon.css','css/breadcrumb.css','css/popup.css','css/form.css','css/input.css','css/table.css','css/label.css','css/segment.css','css/message.css','css/divider.css','css/dropdown.css','css/list.css','css/header.css','css/menu.css','css/datepicker.css','css/progress.css','css/utility.css','css/comments.css','css/editor.css','css/style.css'),'css');?>" rel="stylesheet" type="text/css" />
<script src="<?php echo SITEURL;?>/assets/jquery.js"></script>
<script src="<?php echo SITEURL;?>/assets/jquery-ui.js"></script>
<script src="<?php echo SITEURL;?>/assets/modernizr.mq.js"></script>
<script src="<?php echo SITEURL;?>/assets/global.js"></script>
<script src="<?php echo SITEURL;?>/assets/jquery.ui.touch-punch.js"></script>
<script src="<?php echo THEMEURL;?>/master.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Lato:400,700'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="https://use.fontawesome.com/956530256e.js"></script>
<link rel="icon" type="image/png" href="<?php echo SITEURL;?>/assets/favicon.png" />
</head>
<body>

<header>	   
  
	<div class="corporato-grid">
    	<div id="middlemenu">
      		<div class="corporato tabular segment">
        		
            <div class="corporato cell logoset">
          			<div class="logo"><a href="<?php echo SITEURL; ?>/"><?php echo ($core->logo) ? '<img src="'.UPLOADURL . $core->logo.'" alt="'.$core->company.'" />': $core->company;?></a></div>

        		</div>        		
            <div class="menu-trigger"><a><i class="icon reorder"></i></a></div>
        
        		<div class="corporato cell">
        			<div id="searchbar" class="clearfix">
            			<div id="livesearch" class="corporato icon input">
              				<input id="searchfield" placeholder="Search by MP's last name, Bill or Committee" type="text">
              				<i class="search link icon"></i>
              				<div id="suggestions"> </div>
            			</div>                       
          			</div>
        		</div>

            <div class="corporato cell right">

            <!-- Menu Start -->
            <nav>
              <?php if($menu):?>
                <div class="corporato horizontal divided list menux"> 
                  <a href="<?php echo SITEURL ?>/leaders" class="item menu">MPs</a>
                  <a href="<?php echo SITEURL ?>/bills" class="item menu">Bills</a>
                  <a href="<?php echo SITEURL ?>/committees" class="item menu">Committees</a>                                  
                </div>
              <?php endif;?>
            </nav>
            <!--/ Menu End -->
            </div>

      		</div>
    	</div>
  	</div>    
</header>
