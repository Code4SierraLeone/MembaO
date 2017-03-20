<?php
  /**
   * Content Pages
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = Core::getRowById(Content::pTable, Filter::$id);?>
<div class="corporato form segment">
  <div class="corporato top right attached label"><?php echo Lang::$word->PAG_SUB1;?> / <?php echo $row->title;?></div>
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_NAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="title" value="<?php echo $row->title;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_SLUG;?></label>
        <label class="input">
          <input type="text" name="slug" value="<?php echo $row->slug;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->CREATED;?></label>
        <label class="input"><i class="icon-append icon calendar"></i>
          <input type="text" name="created" data-datepicker="true" data-value="<?php echo $row->created;?>" value="<?php echo $row->created;?>">
        </label>
      </div>
      <div class="field"> </div>
    </div>
    <div class="corporato divider"></div>
    <div class="four fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_HOME;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="home_page" value="1" <?php getChecked($row->home_page, 1); ?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="home_page" value="0" <?php getChecked($row->home_page, 0); ?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_CONTACT;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="contact" value="1" <?php getChecked($row->contact, 1); ?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="contact" value="0" <?php getChecked($row->contact, 0); ?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_FAQ;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="faq" value="1" <?php getChecked($row->faq, 1); ?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="faq" value="0" <?php getChecked($row->faq, 0); ?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_PUB;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="active" value="1" <?php getChecked($row->active, 1); ?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="active" value="0" <?php getChecked($row->active, 0); ?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="field">
      <textarea class="bodypost" name="body"><?php echo $row->body;?></textarea>
    </div>
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>edit page</button>
    <a href="index.php?do=pages" class="corporato danger button"><i class="remove icon"></i>cancel</a>
    <input name="processPage" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php case "add":?>
<div class="corporato black message"><i class="icon pin"></i> <?php echo Core::langIcon();?><?php echo Lang::$word->PAG_INFO2;?> <?php echo Lang::$word->REQFIELD1;?> <i class="icon asterisk"></i> <?php echo Lang::$word->REQFIELD2;?></div>
<div class="corporato form segment">
  <div class="corporato top right attached label"><?php echo Lang::$word->PAG_SUB2;?></div>
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_NAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="title" placeholder="<?php echo Lang::$word->PAG_NAME;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_PUB;?></label>
        <label class="input">
          <input type="text" name="slug" placeholder="<?php echo Lang::$word->PAG_SLUG;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->CREATED;?></label>
        <label class="input"><i class="icon-append icon-calendar"></i>
          <input type="text" data-datepicker="true" data-value="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" name="created">
        </label>
      </div>
      <div class="field"> </div>
    </div>
    <div class="corporato divider"></div>
    <div class="four fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_HOME;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="home_page" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="home_page" type="radio" value="0" checked="checked">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_CONTACT;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="contact" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="contact" type="radio" value="0" checked="checked">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_FAQ;?></label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="faq" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="faq" type="radio" value="0" checked="checked">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_PUB;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="active" type="radio" value="1" checked="checked">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="active" value="0">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="field">
      <textarea class="bodypost" name="body"></textarea>
    </div>
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>add page</button>
    <a href="index.php?do=pages" class="corporato danger button"><i class="remove icon"></i>cancel</a>
    <input name="processPage" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default: ?>
<?php $pagerow = $content->getPages();?>
<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=pages&amp;action=add"><i class="icon add"></i> <?php echo Lang::$word->PAG_ADD;?></a><span><?php echo Lang::$word->PAG_SUB;?></span> </div>
  <table class="corporato basic table">
    <thead>
      <tr>
        <th><?php echo Lang::$word->PAG_NAME;?></th>
        <th><?php echo Lang::$word->CREATED;?></th>
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$pagerow):?>
      <tr>
        <td colspan="3"><?php echo Filter::msgSingleAlert(Lang::$word->PAG_NOPAGE);?></td>
      </tr>
      <?php else:?>
      <?php foreach ($pagerow as $row):?>
      <tr>
        <td><?php echo $row->title;?></td>
        <td data-sort-value="<?php echo strtotime($row->created);?>"><?php echo Filter::dodate("short_date", $row->created);?></td>
        <td class="push-right">
          <a class="corporato purple button" href="index.php?do=pages&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="purple icon pencil"></i>edit</a> 
          <a class="delete corporato danger button" data-title="<?php echo Lang::$word->PAG_DELETE;?>" data-option="deletePage" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->title;?>"><i class="danger inverted remove icon"></i>delete</a></td>
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
<?php break;?>
<?php endswitch;?>