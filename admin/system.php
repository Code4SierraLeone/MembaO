<?php
  /**
  * System
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<h1 class="main-header"><?php echo Lang::$word->SYS_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->SYS_TITLE;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="desktop icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->SYS_TITLE;?> </div>
    <p><?php echo Lang::$word->SYS_INFO;?></p>
  </div>
</div>
<div class="wojo segment">
  <div class="wojo header"><?php echo Lang::$word->SYS_SUB;?></div>
  <div class="wojo buttons" id="tabs"> <a class="wojo button" data-tab="#cms"><?php echo Lang::$word->SYS_CMS_INF;?></a> <a class="wojo button" data-tab="#php"><?php echo Lang::$word->SYS_PHP_INF;?></a> <a class="wojo button" data-tab="#server"><?php echo Lang::$word->SYS_SER_INF;?></a> </div>
  <div id="cms" class="tab_content">
    <table class="wojo two cols table">
      <thead>
        <tr>
          <th colspan="2"><?php echo Lang::$word->SYS_CMS_INF;?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo Lang::$word->SYS_CMS_VER;?>:</td>
          <td>v<?php echo $core->ver;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_SITE_URL;?>:</td>
          <td><?php echo SITEURL;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_ROOT_PATH;?>:</td>
          <td><?php echo BASEPATH;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_SITE_DIR;?>:</td>
          <td><?php echo $core->site_dir;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_UPL_URL;?>:</td>
          <td><?php echo UPLOADURL;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_UPL_PATH;?>:</td>
          <td><?php echo UPLOADS;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_DEF_LANG;?>:</td>
          <td><?php echo strtoupper($core->lang);?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="php" class="tab_content">
    <table class="wojo two cols table">
      <thead>
        <tr>
          <th colspan="2"><?php echo Lang::$word->SYS_PHP_INF;?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo Lang::$word->SYS_PHP_VER; ?>:</td>
          <td><?php echo phpversion();?></td>
        </tr>
        <tr>
          <?php $gdinfo = gd_info();?>
          <td><?php echo Lang::$word->SYS_GD_VER; ?>:</td>
          <td><?php echo $gdinfo['GD Version'];?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_MQR; ?>:</td>
          <td><?php echo (ini_get('magic_quotes_gpc')) ? Lang::$word->ON : Lang::$word->OFF;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_LOG_ERR; ?>:</td>
          <td><?php echo (ini_get('log_errors')) ? Lang::$word->ON : Lang::$word->OFF;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_MEM_LIM; ?>:</td>
          <td><?php echo ini_get('memory_limit'); ?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_RG; ?>:</td>
          <td><?php echo (ini_get('register_globals')) ? Lang::$word->ON : Lang::$word->OFF;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_SM; ?>:</td>
          <td><?php echo (ini_get('safe_mode')) ? Lang::$word->ON : Lang::$word->OFF;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_UMF; ?>:</td>
          <td><?php echo ini_get('upload_max_filesize'); ?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_SSP; ?>:</td>
          <td><?php echo ini_get('session.save_path' );?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="server" class="tab_content">
    <table class="wojo two cols table">
      <thead>
        <tr>
          <th colspan="2"><?php echo Lang::$word->SYS_SER_INF;?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo Lang::$word->SYS_SER_OS;?>:</td>
          <td><?php echo php_uname('s')." (".php_uname('r').")";?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_SER_API;?>:</td>
          <td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_SER_DB; ?>:</td>
          <td><?php echo mysqli_get_client_info();?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_DBV;?>:</td>
          <td><?php echo mysqli_get_server_info($db->getLink());?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_MEMALO;?>:</td>
          <td><?php echo ini_get('memory_limit');?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SYS_STS;?>:</td>
          <td><?php echo getSize(disk_free_space("."));?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>