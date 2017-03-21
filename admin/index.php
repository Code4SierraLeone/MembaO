<?php
/**
* Index
*
* @package Membao
* @author Alan Kawamara
* @copyright 2017
*/

define("_VALID_PHP", true);
require_once("init.php");

if (is_dir("../setup"))
  : die("<div style='text-align:center'>" 
	. "<span style='padding: 5px; border: 1px solid #999; background-color:#EFEFEF;" 
	. "font-family: Verdana; font-size: 11px; margin-left:auto; margin-right:auto'>" 
	. "<b>Warning:</b> Please delete setup directory!</div>");
endif;
  
if (!$user->is_Admin())
  redirect_to("login.php");
?>

<?php include("header.php");?>
<!-- Start Content-->
<div class="clearfix">
	<div class="tablebox">
   	<div id="leftpanel">
   		<div class="content-center vspace">
   			<a href="index.php"><?php echo ($core->logo) ? '<img src="../uploads/'.$core->logo.'" alt="'.$core->site_name.'" class="logo"/>': '<span class="logo">' . $core->site_name . '</span>';?></a>       
   		</div>
      		
      <nav>
     		<ul>          
     			<li class="<?php if (!Filter::$do) echo ' active';?>"><a href="index.php"><i class="icon dashboard"></i> <span><?php echo Lang::$word->ADM_DASH;?></span></a></li>
     			<li class="<?php echo (Filter::$do == 'leaders') ? "active" : "normal";?>"><a href="index.php?do=leaders"><i class="icon user"></i> <span>Leaders</span></a></li>
          <li class="<?php echo (Filter::$do == 'bills') ? "active" : "normal";?>"><a href="index.php?do=bills"><i class="icon user"></i> <span>Bills</span></a></li>

          <li class="<?php echo (Filter::$do == 'committees') ? "active" : "normal";?>"><a href="index.php?do=committees"><i class="icon briefcase"></i> <span>Committees</span></a></li>          

          <li class="<?php echo (Filter::$do == 'parties') ? "active" : "normal";?>"><a href="index.php?do=parties"><i class="icon user"></i> <span>Parties</span></a></li>
          <li class="<?php echo (Filter::$do == 'constituencies') ? "active" : "normal";?>"><a href="index.php?do=constituencies"><i class="icon user"></i> <span>Constituencies</span></a></li>
          <li class="<?php echo (Filter::$do == 'calendar') ? "active" : "normal";?>"><a href="index.php?do=calendar"><i class="icon calendar"></i> <span>Parliamentary Calendar</span></a></li>
          <li class="<?php echo (Filter::$do == 'users') ? "active" : "normal";?>"><a href="index.php?do=users"><i class="icon user"></i><span>Users</span></a></li>
          <li class="<?php echo (Filter::$do == 'pages') ? "active" : "normal";?>"><a href="index.php?do=pages"><i class="icon file text"></i> <span>Pages</span></a></li>                
          <li class="<?php echo (Filter::$do == 'config') ? "active" : "normal";?>"><a href="index.php?do=config"><i class="icon laptop"></i><span>Settings</span></a></li>          		                  
        </ul>
      </nav>
      
      <!-- Footer -->
      <footer id="footer" class="clearfix">
        <div class="copyright">Copyright &copy;<?php echo date('Y');?></div>
      </footer>
    </div>
    
    <div id="rightpanel">
      <header>
        <div class="columns">
          <div class="screen-40 tablet-30 hide-phone"><div class="corporato avatar image">
          <?php if($user->avatar):?>
          <img src="<?php echo UPLOADURL;?>avatars/<?php echo $user->avatar;?>" alt="<?php echo $user->username;?>">
          <?php else:?>
          <img src="<?php echo UPLOADURL;?>avatars/blank.jpg" alt="<?php echo $user->username;?>">
          <?php endif;?>
        </div>
        <p class="hide-phone">Karibu, <?php echo $user->username;?></p>  </div>
          <div class="screen-60 tablet-70 phone-100">
            <div class="corporato secondary menu"> 
              
              <div class="right menu"> 
                <a class="item" href="../" target="_blank"> <i class="home icon"></i> Go to website </a> 
                <a class="item" href="index.php?do=users&amp;action=edit&amp;id=<?php echo $user->uid;?>"> <i class="user icon"></i> Account</a>
                <a class="corporato item" href="logout.php"> <i class="sign out icon"></i> Logout </a> 
              </div>

            </div>
          </div>
        </div>
      </header>
      <div class="corporato breadcrumb relative">
        <?php include_once("helper.php");?>
        <?php include_once("crumbs.php");?>
      </div>
      <div class="corporato-content">
        <?php (Filter::$do && file_exists(Filter::$do.".php")) ? include(Filter::$do.".php") : include("main.php");?>
      </div>
    </div>
  </div>
</div>
<!-- End Content/-->
<?php include("footer.php");?>