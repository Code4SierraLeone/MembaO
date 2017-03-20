<?php
/**
* Committees Type
*
* @package Membao
* @author Alan Kawamara
* @copyright 2017
*/

if (!defined("_VALID_PHP"))
  die('Direct access to this location is not allowed.');
?>

<?php switch(Filter::$action): case "edit": ?>
<?php $row = $core->getRowById(Committees::ctTable, Filter::$id);?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Editing <?php echo $row->name;?></div>
  <form id="corporato_form" name="corporato_form" method="post">

    <div class="field">
      <label>Name of committee type</label>
      <label class="input"><i class="icon-append icon asterisk"></i>
        <input type="text" name="name" value="<?php echo $row->name;?>">
      </label>
    </div>      
    
    <div class="field">
      <label>About the committee type</label>
      <textarea class="bodypost" name="description"><?php echo $row->description;?></textarea>
    </div>      
        
    <div class="corporato fitted divider"></div>
    
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update committee type</button>
    <a href="index.php?do=committees-type" class="corporato danger button"><i class="remove icon"></i>cancel edit</a>
    <input name="processCommitteeType" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>

<div id="msgholder"></div>


s<?php break;?>
<?php case"add": ?>

<div class="corporato form segment">
	<div class="corporato top right attached label">Add a committee type</div>
  <form id="corporato_form" name="corporato_form" method="post">

    <div class="field">
      <label>Committee type name</label>
      <label class="input"><i class="icon-append icon asterisk"></i>
      	<input type="text" name="name" placeholder="Name of committee type">
      </label>
    </div>  

    <div class="field">
      <label>About the committee type</label>
      <textarea class="bodypost" name="description"></textarea>
    </div>           
    
    <div class="corporato fitted divider"></div>
    
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>add committee type</button>
    <a href="index.php?do=committees-type" class="corporato danger button"><i class="remove icon"></i>back to committee types</a>
    <input name="processCommitteeType" type="hidden" value="1">
  </form>
</div>

<div id="msgholder"></div>

<?php break;?>

<?php default: ?>
<?php $committeestyperow = $committee->getCommitteesTypeList();?>

<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=committees-type&amp;action=add"><i class="icon add"></i> Add Committee Type</a><span>Viewing Committee Types</span> </div>
  
  <table class="corporato basic sortable table">
    <thead>
      <tr>
        <th data-sort="string">Name</th>              
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$committeestyperow):?>
      <tr>
        <td colspan="6"><?php echo Filter::msgSingleAlert("No committee types listed on the platform yet.");?></td>
      </tr>
      <?php else:?>
      <?php foreach ($committeestyperow as $row):?>
      <tr>
        <td><?php echo $row->name;?></td>               
        <td class="push-right">
          <a class="corporato purple button" href="index.php?do=committees-type&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="purple icon pencil"></i>edit</a> 
          <a class="delete corporato danger button"  data-title="Delete committee type" data-option="deleteCommitteeType" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="danger inverted remove icon"></i>delete</a></td>
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