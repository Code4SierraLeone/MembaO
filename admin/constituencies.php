<?php
  /**
   * Constituencies
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = $core->getRowById(Leaders::coTable, Filter::$id);?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Editing Constituency / <?php echo $row->name;?></div>
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="two fields">
      <div class="field">
        <label>Constituency name</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="name" value="<?php echo $row->name;?>">
        </label>
      </div>      
      <div class="field">
        <label>District</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="district" value="<?php echo $row->district;?>">
        </label>
      </div>
    </div>       
        
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update constituency</button>
    <a href="index.php?do=constituencies" class="corporato danger button"><i class="remove icon"></i>cancel edit</a>
    <input name="processConstituency" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>
<div id="msgholder"></div>

<?php break;?>
<?php case"add": ?>

<div class="corporato form segment">
	<div class="corporato top right attached label">Add a constituency</div>
  	<form id="corporato_form" name="corporato_form" method="post">
    <div class="two fields">
    	<div class="field">
        	<label>Constituency name</label>
        	<label class="input"><i class="icon-append icon asterisk"></i>
          		<input type="text" name="name" placeholder="Constituency name">
        	</label>
      	</div>
      	<div class="field">
        	<label>District name</label>
        	<label class="input"><i class="icon-append icon asterisk"></i>
          		<input type="text" name="district" placeholder="District name">
        	</label>
      </div>    
    </div>      
    
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>add constituency</button>
    <a href="index.php?do=constituencies" class="corporato danger button"><i class="remove icon"></i>cancel</a>

    <input name="processConstituency" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>

<?php default: ?>
<?php $partiesrow = $leader->getConstituencyList();?>
<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=constituencies&amp;action=add"><i class="icon add"></i> Add Constituency</a><span>Viewing Constituencies</span> </div>

  <table class="corporato basic table">
    <thead>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$partiesrow):?>
      <tr>
        <td colspan="6"><?php echo Filter::msgSingleAlert("No constituencies listed on the platform yet.");?></td>
      </tr>
      <?php else:?>
      <?php foreach ($partiesrow as $row):?>
      <tr>
        <td><?php echo $row->name;?></td>
        <td><?php echo $row->district;?></td>
        <td class="push-right">
          <a class="corporato purple button" href="index.php?do=constituencies&amp;action=edit&amp;id=<?php echo $row->id;?>">
            <i class="purple pencil icon"></i>edit</a> 
          <a class="delete corporato danger button" data-title="Delete constituency listing" data-option="deleteConstituency" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="danger inverted remove icon"></i>delete</a>          
        </td>
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