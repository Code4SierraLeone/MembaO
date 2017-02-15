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
          			<li class="parent<?php if (!Filter::$do) echo ' active';?>"><a href="index.php"><i class="icon dashboard"></i> <span><?php echo Lang::$word->ADM_DASH;?></span></a></li>
          			<li class="parent <?php echo (Filter::$do == 'leaders') ? "active" : "normal";?>"><a href="index.php?do=leaders"><i class="icon user"></i> <span>Leaders</span></a></li>
                    <li class="parent <?php echo (Filter::$do == 'parties') ? "active" : "normal";?>"><a href="index.php?do=parties"><i class="icon user"></i> <span>Parties</span></a></li>
                    <li class="parent <?php echo (Filter::$do == 'constituencies') ? "active" : "normal";?>"><a href="index.php?do=constituencies"><i class="icon user"></i> <span>Constituencies</span></a></li>
                    <li class="parent <?php echo (Filter::$do == 'calendar') ? "active" : "normal";?>"><a href="index.php?do=calendar"><i class="icon user"></i> <span>Calendar</span></a></li>                              			
          		
                        
        </ul>
      </nav>
    </div>
    <div id="rightpanel">
      <header>
        <div class="columns">
          <div class="screen-40 tablet-30 hide-phone"><div class="corporato avatar image">
          <?php if($user->avatar):?>
          <img src="<?php echo UPLOADURL;?>avatars/<?php echo $user->avatar;?>" alt="<?php echo $user->username;?>">
          <?php else:?>
          <img src="<?php echo UPLOADURL;?>avatars/blank.png" alt="<?php echo $user->username;?>">
          <?php endif;?>
        </div>
        <p class="hide-phone"><?php echo Lang::$word->WELCOME;?>, <?php echo $user->username;?>!</p>  </div>
          <div class="screen-60 tablet-70 phone-100">
            <div class="corporato secondary menu"> <a class="item" href="../"> <i class="home icon"></i> <?php echo Lang::$word->ADM_M_FRONT;?> </a> <a class="item" href="index.php?do=users&amp;action=edit&amp;id=<?php echo $user->uid;?>"> <i class="user icon"></i> <?php echo Lang::$word->ADM_PROFILE;?> </a>
              <div class="corporato dropdown item"> <i class="language icon"></i> <?php echo Lang::$word->ADM_M_LANG;?> <i class="dropdown icon"></i>
                <div class="inverted menu">
                  <?php foreach(Lang::fetchLanguage() as $lang):?>
                  <?php if(Core::$language == $lang):?>
                  <a class="item active">
                  <div class="corporato label"><?php echo strtoupper($lang);?></div>
                  <?php echo Lang::$word->ADM_M_LANG;?></a>
                  <?php else:?>
                  <a class="item langchange" href="index.php?<?php echo $_SERVER['QUERY_STRING'];?>" data-lang="<?php echo $lang;?>">
                  <div class="corporato label"><?php echo strtoupper($lang);?></div>
                  <?php echo Lang::$word->ADM_M_LANG_C;?></a>
                  <?php endif?>
                  <?php endforeach;?>
                </div>
              </div>
              <div class="right menu"> <a class="corporato item" href="logout.php"> <i class="sign out icon"></i> <?php echo Lang::$word->LOGOUT;?> </a> </div>
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