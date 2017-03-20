<?php
  /**
   * Users
   *
   * @package Visible Polls
   * @author Alan Kawamara
   * @copyright 2016
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = Core::getRowById(Users::uTable, Filter::$id);?>
<div class="corporato form segment">
  <div class="corporato top right attached label"><?php echo Lang::$word->USR_SUB;?> / <?php echo $row->username;?></div>
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USERNAME;?></label>
        <label class="input state-disabled"> <i class="icon-append icon asterisk"></i>
          <input type="text" disabled="disabled" name="username" readonly value="<?php echo $row->username;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PASSWORD;?></label>
        <label class="input"> <i class="icon-prepend icon-lock"></i>
          <input type="text" name="password">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->FNAME;?></label>
        <label class="input"> <i class="icon-append icon asterisk"></i>
          <input type="text" name="fname" value="<?php echo $row->fname;?>" >
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LNAME;?></label>
        <label class="input"> <i class="icon-append icon asterisk"></i>
          <input type="text" name="lname" value="<?php echo $row->lname;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->EMAIL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" value="<?php echo $row->email;?>" name="email">
        </label>
      </div>
      <div class="field">
        <div class="two fields">
          <div class="field">
            <label><?php echo Lang::$word->USR_AVATAR;?></label>
            <label class="input">
              <input type="file" name="avatar" class="filefield">
            </label>
          </div>
          <div class="field">
            <label><?php echo Lang::$word->USR_AVATAR;?></label>
            <div class="corporato avatar image">
              <?php if($row->avatar):?>
              <img src="<?php echo UPLOADURL;?>avatars/<?php echo $row->avatar;?>" alt="<?php echo $row->username;?>">
              <?php else:?>
              <img src="<?php echo UPLOADURL;?>avatars/blank.jpg" alt="<?php echo $row->username;?>">
              <?php endif;?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="corporato divider"></div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_LEVEL;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="userlevel" value="9" <?php getChecked($row->userlevel, 9); ?>>
            <i></i><?php echo Lang::$word->USR_ADMIN;?></label>
          <label class="radio">
            <input type="radio" name="userlevel" value="1" <?php getChecked($row->userlevel, 1); ?>>
            <i></i><?php echo Lang::$word->USER;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_STATUS;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="active" value="y" <?php getChecked($row->active, "y"); ?>>
            <i></i><?php echo Lang::$word->ACTIVE;?></label>
          <label class="radio">
            <input type="radio" name="active" value="n" <?php getChecked($row->active, "n"); ?>>
            <i></i><?php echo Lang::$word->INACTIVE;?></label>
          <label class="radio">
            <input type="radio" name="active" value="b" <?php getChecked($row->active, "b"); ?>>
            <i></i><?php echo Lang::$word->BANNED;?></label>
          <label class="radio">
            <input type="radio" name="active" value="t" <?php getChecked($row->active, "t"); ?>>
            <i></i><?php echo Lang::$word->PENDING;?></label>
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_REGDATE;?></label>
        <input type="text" value="<?php echo Filter::dodate("long_date", $row->created);?>" name="created" disabled="disabled">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_NEWS;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="newsletter" type="radio" value="1" <?php echo getChecked($row->newsletter, 1);?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="newsletter" type="radio" value="0" <?php echo getChecked($row->newsletter, 0);?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_BIO;?></label>
        <textarea name="info"><?php echo $row->info;?></textarea>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_NOTES;?></label>
        <textarea name="notes"><?php echo $row->notes;?></textarea>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_LASTLOGIN;?></label>
        <input type="text" value="<?php echo Filter::dodate("long_date", $row->lastlogin);?>" name="lastlogin" disabled="disabled">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_LASTIP;?></label>
        <input type="text" value="<?php echo $row->lastip;?>" name="lastip" disabled="disabled">
      </div>
    </div>
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update user</button>
    <a href="index.php?do=users" class="corporato danger button"><i class="remove icon"></i>cancel</a>
    <input name="processUser" type="hidden" value="1">
    <input name="username" type="hidden" value="<?php echo $row->username;?>" />
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php case"add": ?>

<div class="corporato form segment">
  <div class="corporato top right attached label"><?php echo Lang::$word->USR_SUB1;?></div>
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USERNAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->USERNAME;?>" name="username">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PASSWORD;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->PASSWORD;?>" name="password">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->FNAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->FNAME;?>" name="fname">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LNAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->LNAME;?>" name="lname">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->EMAIL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->EMAIL;?>" name="email">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_AVATAR;?></label>
        <label class="input">
          <input type="file" name="avatar" class="filefield">
        </label>
      </div>
    </div>
    <div class="corporato fitted divider"></div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_LEVEL;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="userlevel" type="radio" value="9" >
            <i></i><?php echo Lang::$word->USR_ADMIN;?></label>
          <label class="radio">
            <input type="radio" name="userlevel" value="1" checked="checked">
            <i></i><?php echo Lang::$word->USER;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_STATUS;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="active" type="radio" value="y" checked="checked" >
            <i></i><?php echo Lang::$word->ACTIVE;?></label>
          <label class="radio">
            <input type="radio" name="active" value="n" >
            <i></i><?php echo Lang::$word->INACTIVE;?></label>
          <label class="radio">
            <input type="radio" name="active" value="b" >
            <i></i><?php echo Lang::$word->BANNED;?></label>
          <label class="radio">
            <input type="radio" name="active" value="t">
            <i></i><?php echo Lang::$word->PENDING;?></label>
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_BIO;?></label>
        <textarea placeholder="<?php echo Lang::$word->USR_BIO;?>" name="info"></textarea>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_NOTES;?></label>
        <textarea placeholder="<?php echo Lang::$word->USR_NOTES;?>" name="notes"></textarea>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_NEWS;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="newsletter" type="radio" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="newsletter" type="radio" value="0" checked="checked">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_NOTIFY;?></label>
        <div class="inline-group">
          <label class="checkbox">
            <input name="notify" type="checkbox" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
    </div>
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>add user</button>
    <a href="index.php?do=users" class="corporato danger button"><i class="remove icon"></i>cancel</a>
    <input name="processUser" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default:?>
<?php  $userrow = $user->getUsers();?>

<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=users&amp;action=add"><i class="icon add"></i> <?php echo Lang::$word->USR_ADD;?></a><span><?php echo Lang::$word->USR_SUB2;?></span> </div>
  <div class="corporato small segment form">
    <form method="post" id="corporato_form" name="corporato_form">
      <div class="four fields">
        <div class="field">
          <div class="corporato input"> <i class="icon-prepend icon calendar"></i>
            <input name="fromdate" type="text" data-datepicker="true" placeholder="<?php echo Lang::$word->FROM;?>" id="fromdate" />
          </div>
        </div>
        <div class="field">
          <div class="corporato action input"> <i class="icon-prepend icon calendar"></i>
            <input name="enddate" type="text" data-datepicker="true" placeholder="<?php echo Lang::$word->TO;?>" id="enddate" />
            <a id="doDates" class="corporato icon button"><?php echo Lang::$word->FIND;?></a> </div>
        </div>
        <div class="field">
          <div class="corporato icon input">
            <input type="text" name="usersearchfield" placeholder="<?php echo Lang::$word->USR_SEARCHU;?>" id="searchfield"  />
            <i class="search icon"></i>
            <div id="suggestions"> </div>
          </div>
        </div>
        <div class="field">
          <div class="two fields">
            <div class="field"> <?php echo $pager->items_per_page();?> </div>
            <div class="field"> <?php echo $pager->jump_menu();?> </div>
          </div>
        </div>
      </div>
    </form>
    <div class="content-center"> <?php echo alphaBits('index.php?do=users', "letter");?> </div>
  </div>
  <table class="corporato basic sortable table">
    <thead>
      <tr>
        <th data-sort="string"><?php echo Lang::$word->USERNAME;?></th>
        <th data-sort="string"><?php echo Lang::$word->USR_FULLNAME;?></th>
        <th data-sort="string"><?php echo Lang::$word->STATUS;?></th>
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$userrow):?>
      <tr>
        <td colspan="5"><?php echo Filter::msgSingleAlert(Lang::$word->USR_NOUSER);?></td>
      </tr>
      <?php else:?>
      <?php foreach ($userrow as $row):?>
      <tr>
        <td><?php if($row->avatar):?>
          <img src="<?php echo UPLOADURL;?>avatars/<?php echo $row->avatar;?>" alt="<?php echo $row->username;?>" class="corporato image avatar"/>
          <?php else:?>
          <img src="<?php echo UPLOADURL;?>avatars/blank.jpg" alt="<?php echo $row->username;?>" class="corporato image avatar"/>
          <?php endif;?>
          <a href="index.php?do=newsletter&amp;emailid=<?php echo urlencode($row->email);?>"><?php echo $row->username;?></a></td>
        <td><?php echo $row->name;?></td>
        <td><?php echo userStatus($row->active, $row->id);?></td>      
        <td class="push-right"><a class="corporato purple button" href="index.php?do=users&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="purple icon pencil"></i>edit</a>
          <?php if($row->id == 1):?>
          <a class="delete corporato danger button"><i class="black remove icon"></i>delete</a>
          <?php else:?>
          <a class="delete corporato danger button" data-title="<?php echo Lang::$word->USR_DELUSER;?>" data-option="deleteUser" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->username;?>"><i class="danger inverted remove icon"></i>delete</a>
          <?php endif;?></td>
      </tr>
      <?php endforeach;?>
      <?php unset($row);?>
      <?php endif;?>
    </tbody>
  </table>
</div>
<div class="corporato divider"></div>
<div class="two columns">
  <div class="row"> <span class="corporato label"><?php echo Lang::$word->TOTAL . ': ' . $pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $pager->current_page . ' ' . Lang::$word->OF . ' ' . $pager->num_pages;?></span> </div>
  <div class="row">
    <div class="push-right"><?php echo $pager->display_pages();?></div>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
    /* == User Search == */
    $("#searchfield").on('keyup', function () {
        var srch_string = $(this).val();
        var data_string = 'userSearch=' + srch_string;
        if (srch_string.length > 4) {
            $.ajax({
                type: "post",
                url: "controller.php",
                data: data_string,
                beforeSend: function () {

                },
                success: function (res) {
                    $('#suggestions').html(res).show();
                    $("input").blur(function () {
                        $('#suggestions').fadeOut();
                    });
                }
            });
        }
        return false;
    });
    $('a.activate').on('click', function () {
        var uid = $(this).data('id')
        var text = "<div class=\"messi-warning\"><i class=\"massive icon warn warning sign\"></i></p><p><?php echo Lang::$word->USR_ACCT1;?><br /><strong><?php echo Lang::$word->USR_ACCT2;?></strong></p></div>";
        new Messi(text, {
            title: "<?php echo Lang::$word->USR_ACCT;?>",
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: "<?php echo Lang::$word->ACTIVATE;?>",
                val: 'Y',
				class: 'positive'
            }],
			  callback: function (val) {
				  $.ajax({
					  type: 'post',
					  ataType: 'json',
					  url: "controller.php",
					  data: {
						  activateAccount: 1,
						  id: uid,
					  },
					  cache: false,
					  success: function (json) {
						  $.sticky(decodeURIComponent(json.message), {
							  type: json.type,
							  title: json.title
						  });
					  }
				  });
			  }
        });
    });
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>