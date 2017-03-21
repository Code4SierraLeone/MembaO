<?php
  /**
   * Configuration
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>

<div class="corporato form segment">
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="two fields">
      <div class="field">
        <label>Application Name</label>
        <label class="input"> <i class="icon-append icon asterisk"></i>
          <input type="text" name="site_name" value="<?php echo $core->site_name;?>">
        </label>
      </div>
      <div class="field">
        <label>Organisation Name</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="company" value="<?php echo $core->company;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Live URL</label>
        <label class="input"> <i class="icon-append icon asterisk"></i>
          <input type="text" name="site_url" value="<?php echo $core->site_url;?>">
        </label>
      </div>
      <div class="field">
        <label>Installation Directory</label>
        <label class="input">
          <input type="text" name="site_dir" value="<?php echo $core->site_dir;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Application Email</label>
        <label class="input">
          <input type="text" name="site_email" value="<?php echo $core->site_email;?>">
        </label>
      </div>
      <div class="field">
        <label>Put Application Offline</label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="offline" onclick="$('.offline-data').slideDown();" value="1" <?php getChecked($core->offline, 1); ?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="offline" onclick="$('.offline-data').slideUp();" value="0" <?php getChecked($core->offline, 0); ?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="corporato divider"></div>
    <div class="two fields offline-data"<?php echo ($core->offline) ? "" : " style=\"display:none\""; ?>>
      <div class="field">
        <label>Offline date</label>
        <label class="input"><i class="icon-prepend icon calendar"></i> <i class="icon-append icon asterisk"></i>
          <input name="offline_d" data-datepicker="true" type="text" value="<?php echo $core->offline_d;?>">
        </label>
        <div class="small-top-space"></div>
        <label>Offline time</label>
        <label class="input"><i class="icon-prepend icon time"></i> <i class="icon-append icon asterisk"></i>
          <input name="offline_t" data-timepicker="true" type="text" value="<?php echo $core->offline_t;?>">
        </label>
      </div>
      <div class="field">
        <label>Offline message</label>
        <textarea id="altpost" class="altpost" name="offline_msg"><?php echo $core->offline_msg;?></textarea>
      </div>
      <div class="corporato divider"></div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Application Logo</label>
        <label class="input">
          <input type="file" id="logo" name="logo" class="filefield">
        </label>
      </div>
      <div class="field">
        <label>Show Application Logo</label>
        <div class="inline-group">
          <label class="checkbox">
            <input name="dellogo" type="checkbox" value="1" class="checkbox"/>
            <i></i>Yes</label>
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Print logo</label>
        <label class="input">
          <input type="file" id="plogo" name="plogo" class="filefield">
        </label>
      </div>
      <div class="field">
        <label>Preview Logo</label>
        <div class="corporato normal image"> <a class="lightbox" href="<?php echo UPLOADURL;?>print_logo.png"><img src="<?php echo UPLOADURL;?>print_logo.png" alt=""></a> </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Short Date Format</label>
        <select name="short_date">
          <?php echo $core->getShortDate();?>
        </select>
      </div>
      <div class="field">
        <label>Long Date Format</label>
        <select name="long_date">
          <?php echo $core->getLongDate();?>
        </select>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Default Language</label>
        <select name="lang">
          <?php foreach(Lang::fetchLanguage() as $langlist):?>
          <option value="<?php echo $langlist;?>"<?php if($core->lang == $langlist) echo ' selected="selected"';?>><?php echo strtoupper($langlist);?></option>
          <?php endforeach;?>
        </select>
      </div>
      <div class="field">
        <label>Time Format</label>
        <select name="time_format">
          <?php echo Core::getTimeFormat($core->time_format);?>
        </select>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Default Timezone</label>
        <?php echo $core->getTimezones();?> </div>
      <div class="field">
        <label>Default Locale</label>
        <select name="locale">
          <?php echo $core->getlocaleList();?>
        </select>
      </div>
    </div>
    <div class="corporato divider"></div>
    <div class="four fields">
      <div class="field">
        <label>Enable SEO</label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="seo" value="1" <?php getChecked($core->seo, 1); ?>>
            <i></i>Yes</label>
          <label class="radio">
            <input type="radio" name="seo" value="0" <?php getChecked($core->seo, 0); ?>>
            <i></i>No</label>
        </div>
      </div>
      
      <div class="field">
        <label>Show Slider</label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="show_slider" value="1" <?php getChecked($core->show_slider, 1); ?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="show_slider" value="0" <?php getChecked($core->show_slider, 0); ?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>

      <div class="field">
        <label>Items Per Page</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="perpage" value="<?php echo $core->perpage;?>">
        </label>
      </div>
      <div class="field">
        <label>Default Theme</label>
        <select name="theme">
          <?php getTemplates(BASEPATH."/themes/", $core->theme)?>
        </select>
      </div>
    </div>
    <div class="corporato divider"></div>
    <div class="four fields">
      <div class="field">
        <label>Registration Verification</label>
        <label class="radio">
          <input type="radio" name="reg_verify" value="1" <?php getChecked($core->reg_verify, 1); ?>>
          <i></i>Yes</label>
        <label class="radio">
          <input type="radio" name="reg_verify" value="0" <?php getChecked($core->reg_verify, 0); ?>>
          <i></i>No</label>
      </div>
      <div class="field">
        <label>Auto Register Users</label>
        <label class="radio">
          <input type="radio" name="auto_verify" value="1" <?php getChecked($core->auto_verify, 1); ?>>
          <i></i>Yes</label>
        <label class="radio">
          <input type="radio" name="auto_verify" value="0" <?php getChecked($core->auto_verify, 0); ?>>
          <i></i>No</label>
      </div>
      <div class="field">
        <label>Allow User Registration</label>
        <label class="radio">
          <input type="radio" name="reg_allowed" value="1" <?php getChecked($core->reg_allowed, 1); ?>>
          <i></i>Yes</label>
        <label class="radio">
          <input type="radio" name="reg_allowed" value="0" <?php getChecked($core->reg_allowed, 0); ?>>
          <i></i>No</label>
      </div>
      <div class="field">
        <label>User Registration Notification</label>
        <label class="radio">
          <input type="radio" name="notify_admin" value="1" <?php getChecked($core->notify_admin, 1); ?>>
          <i></i>Yes</label>
        <label class="radio">
          <input type="radio" name="notify_admin" value="0" <?php getChecked($core->notify_admin, 0); ?>>
          <i></i>No</label>
      </div>
    </div>

    <div class="corporato divider"></div>
    
    <div class="two fields">
      <div class="field">
        <label>Uploads directory</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="file_dir" value="<?php echo $core->file_dir;?>">
        </label>
      </div>
      <div class="field">
        <label>Featured items</label>
        <label class="input">
          <input type="text" class="slrange" name="featured" value="<?php echo $core->featured;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <div class="two fields">
          
          <div class="field">
        <label>Thumbnail Width</label>
        <label class="input"><i class="icon-append icon-asterisk"></i>
          <input type="text" name="thumb_w" value="<?php echo $core->thumb_w;?>">
        </label>
      </div>
      <div class="field">
        <label>Thumbnail Height</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="thumb_h" value="<?php echo $core->thumb_h;?>">
        </label>
      </div>
          
        </div>
      </div>
      <div class="field">
        <label>Popular items</label>
        <label class="input">
          <input type="text" class="slrange" name="popular" value="<?php echo $core->popular;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <div class="two fields">
          <div class="field">
            <label><?php echo Lang::$word->CONF_LAYOUT;?></label>
            <div class="inline-group">
              <label class="radio">
                <input type="radio" name="hlayout" value="1" <?php getChecked($core->hlayout, 1); ?>>
                <i></i>Grid</label>
              <label class="radio">
                <input type="radio" name="hlayout" value="0" <?php getChecked($core->hlayout, 0); ?>>
                <i></i>List</label>
            </div>
          </div>
          
          <div class="field">
            <label>Show Hometext</label>
            <div class="inline-group">
              <label class="radio">
                <input type="radio" name="show_home" value="1" <?php getChecked($core->show_home, 1); ?>>
                <i></i><?php echo Lang::$word->YES;?></label>
                <label class="radio">
                  <input type="radio" name="show_home" value="0" <?php getChecked($core->show_home, 0); ?>>
                  <i></i><?php echo Lang::$word->NO;?></label>
            </div>
          </div>
        </div>
      </div>
      <div class="field">
        <label>Featured Items Grid</label>
        <label class="input">
          <input type="text" class="slrange" name="homelist" value="<?php echo $core->homelist;?>">
        </label>
      </div>
    </div>
    
    <div class="corporato divider"></div>

    <div class="field">
      <label>What is a bill?</label>
      <textarea class="bodypost" name="bills_description"><?php echo $core->bills_description;?></textarea>
    </div>

    <div class="field">
      <label>What is a committee?</label>
      <textarea class="bodypost" name="committees_description"><?php echo $core->committees_description;?></textarea>
    </div>

    <div class="field">
      <label>About committee meetings</label>
      <textarea class="bodypost" name="meetings_description"><?php echo $core->meetings_description;?></textarea>
    </div>

    <div class="corporato divider"></div>
      
    <div class="two fields">
      <div class="field">
        <label>Default Mailer</label>
        <select name="mailer" id="mailerchange">
          <option value="PHP" <?php if ($core->mailer == "PHP") echo "selected=\"selected\"";?>>PHP Mailer</option>
          <option value="SMAIL" <?php if ($core->mailer == "SMAIL") echo "selected=\"selected\"";?>>Sendmail</option>
          <option value="SMTP" <?php if ($core->mailer == "SMTP") echo "selected=\"selected\"";?>>SMTP Mailer</option>
        </select>
      </div>
      <div class="field showsmail">
        <label>Sendmail Path</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="sendmail" value="<?php echo $core->sendmail;?>" type="text">
        </label>
      </div>
    </div>
    <div class="showsmtp">
      <div class="corporato divider"></div>
      <div class="two fields">
        <div class="field">
          <label>SMTP Hostname</label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input name="smtp_host" value="<?php echo $core->smtp_host;?>" placeholder="<?php echo Lang::$word->CONF_SMTP_HOST;?>" type="text">
          </label>
        </div>
        <div class="field">
          <label>SMTP Username</label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input name="smtp_user" value="<?php echo $core->smtp_user;?>" placeholder="<?php echo Lang::$word->CONF_SMTP_USER;?>" type="text">
          </label>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>SMTP Password</label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input name="smtp_pass" value="<?php echo $core->smtp_pass;?>" placeholder="<?php echo Lang::$word->CONF_SMTP_PASS;?>" type="text">
          </label>
        </div>
        <div class="field">
          <label>SMTP Port</label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input name="smtp_port" value="<?php echo $core->smtp_port;?>" placeholder="<?php echo Lang::$word->CONF_SMTP_PORT;?>" type="text">
          </label>
        </div>
        <div class="field">
          <label>Requires SSL</label>
          <div class="inline-group">
            <label class="radio">
              <input name="is_ssl" type="radio" value="1" <?php getChecked($core->is_ssl, 1); ?>>
              <i></i><?php echo Lang::$word->YES;?></label>
            <label class="radio">
              <input name="is_ssl" type="radio" value="0" <?php getChecked($core->is_ssl, 0); ?>>
              <i></i> <?php echo Lang::$word->NO;?> </label>
          </div>
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Meta Keywords</label>
        <textarea name="metakeys"><?php echo $core->metakeys;?></textarea>
      </div>
      <div class="field">
        <label>Meta Description</label>
        <textarea name="metadesc"><?php echo $core->metadesc;?></textarea>
      </div>
    </div>
    <div class="field">
      <label>Google Analytics</label>
      <textarea name="analytics"><?php echo $core->analytics;?></textarea>
    </div>
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>Update settings</button>
    <input name="processConfig" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<script type="text/javascript">
// <![CDATA[
 $(document).ready(function () {
     var res2 = '<?php echo $core->mailer;?>';
     (res2 == "SMTP") ? $('.showsmtp').show() : $('.showsmtp').hide();
     $('#mailerchange').change(function () {
         var res = $("#mailerchange option:selected").val();
         (res == "SMTP") ? $('.showsmtp').show() : $('.showsmtp').hide();
     });

     (res2 == "SMAIL") ? $('.showsmail').show() : $('.showsmail').hide();
     $('#mailerchange').change(function () {
         var res = $("#mailerchange option:selected").val();
         (res == "SMAIL") ? $('.showsmail').show() : $('.showsmail').hide();
     });
	 
    $("input[name=popular]").ionRangeSlider({
		min: 2,
		max: 10,
        step: 1,
		postfix: " itm",
        type: 'single',
        hasGrid: true
    });
	
    $("input[name=featured]").ionRangeSlider({
		min: 2,
		max: 20,
        step: 1,
		postfix: " itm",
        type: 'single',
        hasGrid: true
    });

    $("input[name=homelist]").ionRangeSlider({
		min: 2,
		max: 5,
        step: 1,
		postfix: " itm",
        type: 'single',
        hasGrid: true
    });
 });
// ]]>
</script> 