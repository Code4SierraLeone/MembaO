<?php
  /**
   * Calendar
   *
   * @package MembaO
   * @author Alan Kawamara
   * @copyright 2017
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "attendance": ?>
<?php $crow = $core->getRowById(Leaders::scTable, Filter::$id);?>
<?php $listrow = $leader->getLeaderList();?>

<div class="corporato form segment">
	<div class="corporato top right attached label">Attendance Records / <?php echo Filter::dodate("short_date", $crow->date);?></div>
  	<form id="corporato_form" name="corporato_form" method="post">
    	
      <table class="corporato basic table celled">
        <thead>
          <tr>
            <th class="disabled"> <label class="checkbox">
              <input type="checkbox" name="masterCheckbox" id="masterCheckbox">
              <i></i></label>
            </th>
            <th>MP</th>
                    
          </tr>
        </thead>

        <tbody>
        <?php if(!$listrow):?>
          <tr>
            <td colspan="3"><?php Filter::msgSingleAlert("Sorry, no MPs listed on the application yet.");?></td>
          </tr>
        <?php else:?>
        <?php foreach($listrow as $row):?>
          <tr>
            <td class="hide-tablet"><label class="checkbox">
              <input name="leader_id[<?php echo $row->id;?>]" type="checkbox" value="<?php echo $row->id;?>">
              <i></i></label></td>
            
            <td><strong><?php echo $row->name;?></strong> <br />
              <div><small><?php echo $row->constituency;?></small></div>
            </td>
                      
          </tr>
        <?php endforeach;?>      

        <?php endif;?>
        </tbody>              
      </table>              
    	
      <div class="corporato divider"></div>

      <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update attendance register</button>
      <a href="index.php?do=calendar" class="corporato danger button"><i class="remove icon"></i>go back to parliamentary calendar</a>
      <input name="processAttendance" type="hidden" value="1">
      <input name="sitting_id" type="hidden" value="<?php echo Filter::$id;?>" />
  	</form>
</div>
<div id="msgholder"></div>

<?php break;?>
<?php case "edit": ?>
<?php $row = $core->getRowById(Leaders::scTable, Filter::$id);?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Editing Sitting Date / <?php echo Filter::dodate("short_date", $row->date);?></div>
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="three fields">
      <div class="field">
        <label>Calendar year</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="year" value="<?php echo $row->year;?>">
        </label>
      </div>      
      <div class="field">
        <label>Sitting date</label>
        <input type="date" name="date" value="<?php echo $row->date;?>">
      </div>
      <div class="field">
      <label>Sitting type</label>
        <select name="stype">
          <option value="0">--- Select sitting type ---</option>
          <option value="1"<?php if ($row->stype == 1) echo " selected=\"selected\"";?>>House session</option>
          <option value="2"<?php if ($row->stype == 2) echo " selected=\"selected\"";?>>Committee session</option>
          <option value="3"<?php if ($row->stype == 3) echo " selected=\"selected\"";?>>Budget session</option>
        </select>
      </div>
    </div>       
        
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update caledar</button>
    <a href="index.php?do=calendar" class="corporato danger button"><i class="remove icon"></i>cancel edit</a>
    <input name="processCalendar" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php case"add": ?>

<div class="corporato form segment">
	<div class="corporato top right attached label">Add a sitting date</div>
  	<form id="corporato_form" name="corporato_form" method="post">
    <div class="three fields">
    	<div class="field">
        	<label>Calendar year</label>
        	<label class="input"><i class="icon-append icon asterisk"></i>
          		<input type="text" name="year" placeholder="Calendar year">
        	</label>
      	</div>
      	<div class="field">
        	<label>Sitting date</label>
          <div class="corporato input"> <i class="icon-prepend icon calendar"></i>
            <input name="date" type="text" data-datepicker="true" placeholder="Meeting date" />
          </div>
          
      </div> 
      <div class="field">
        <label>Sitting type</label>
        <select name="stype">
          <option value="0">--- Select sitting type ---</option>
          <option value="1">House session</option>
          <option value="2">Committee session</option>
          <option value="2">Budget session</option>
        </select>
      	</div>   
    </div>      
    
    <div class="corporato fitted divider"></div>
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>add sitting date</button>
    <a href="index.php?do=calendar" class="corporato danger button"><i class="remove icon"></i>cancel</a>
    <input name="processCalendar" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>

<?php default: ?>
<?php $calendarrow = $leader->getSittingCalendar();?>
<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=calendar&amp;action=add"><i class="icon add"></i> Add Sitting Date</a><span>Viewing Sitting Calendar</span> </div>

  <table class="corporato basic sortable table">
    <thead>
      <tr>
        <th data-sort="string">Date</th>
        <th data-sort="string">Year</th>
        <th data-sort="string">Sitting type</th>
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$calendarrow):?>
      <tr>
        <td colspan="6"><?php echo Filter::msgSingleAlert("No sitting dates listed on the platform yet.");?></td>
      </tr>
      <?php else:?>
      <?php foreach ($calendarrow as $row):?>
      <tr>
        <td><?php echo Filter::dodate("short_date", $row->date);?></td>
        <td><?php echo $row->year;?></td>
        <td><?php echo getSType($row->sitting_type);?></td>
        <td class="push-right">                    
          <a class="corporato positive button" href="index.php?do=calendar&action=attendance&id=<?php echo $row->id;?>">
            <i class="positive checkmark icon"></i>attendance register</a>
          <a class="corporato purple button" href="index.php?do=calendar&action=edit&amp;id=<?php echo $row->id;?>">
            <i class="purple pencil icon"></i>edit</a>
          <a class="delete corporato danger button" data-title="Delete sitting date listing" data-option="deleteSittingDate" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->id;?>"><i class="danger inverted remove icon"></i>delete</a>
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