<?php
/**
* Bills
*
* @package Membao
* @author Alan Kawamara
* @copyright 2017
*/

if (!defined("_VALID_PHP"))
  die('Direct access to this location is not allowed.');
?>

<?php switch(Filter::$action): case "edit": ?>
<?php $row = $core->getRowById(Bills::bTable, Filter::$id);?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Editing <?php echo $row->title;?></div>
  <form id="corporato_form" name="corporato_form" method="post">

    <div class="field">
      <label>Title of bill</label>
      <label class="input"><i class="icon-append icon asterisk"></i>
        <input type="text" name="title" value="<?php echo $row->title;?>">
      </label>
    </div>      


    <div class="four fields">        
      <div class="field">
        <label>Date of introduction</label>               
	      <input type="date" data-datepicker="true" placeholder="Select date" value="<?php echo $row->date_introduced;?>" name="date_introduced">      	
      </div>

      <div class="field">        
        <label>Bill type</label>
        <select name="bill_type">
          <option value="0">--- Select bill type ---</option>
          <option value="1"<?php if ($row->bill_type == 1) echo " selected=\"selected\"";?>>Private Member's</option>
          <option value="2"<?php if ($row->bill_type == 2) echo " selected=\"selected\"";?>>Government</option>          
        </select>
      </div>

      <div class="field">
        <label>Committee assigned to</label>
        <?php echo $core->getDropList($committee->getCommitteesList(), "committee", $row->committee, "Select Committee");?>
      </div>       
        
      <div class="field">
        <label>Mover of bill <span class="small">(only for Private Member's Bill)</span></label>
        <?php echo $core->getDropList($leader->getLeaderList(), "mover", $row->mover, "Select Mover of Bill");?>
      </div>       
    </div>
    
    <div class="corporato divider"></div>
    
    <div class="field">
      <label>About the bill</label>
      <textarea class="bodypost" name="description"><?php echo $row->description;?></textarea>
    </div>
    
    <div class="three fields">
      <div class="field">
        <label>Featured</label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="featured" value="1" <?php getChecked($row->featured, 1); ?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="featured" value="0" <?php getChecked($row->featured, 0); ?>>
            <i></i><?php echo Lang::$word->NO;?></label>
         </div>
      </div>
    </div>
        
    <div class="corporato fitted divider"></div>
    
    <button type="button" name="dosubmit" class="corporato button">Update Bill Data</button>
    <a href="index.php?do=bills" class="corporato basic button">Cancel Edit</a>
    <input name="processBill" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>

<div id="msgholder"></div>

<?php break;?>

<?php case"status": ?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Add a bill</div>
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="two fields">        
      <div class="field">
        <label>Date of bill activity</label>               
        <input type="date" data-datepicker="true" placeholder="Select date" name="status_date">       
      </div>

      <div class="field">
      <label>Bill status</label>        
        <select name="bill_status">
          <option value="0">--- Select bill status ---</option>
          <option value="1">Reference to Standing Committee</option>
          <option value="2">2nd Reading</option>
          <option value="3">3rd Reading</option>
          <option value="4">Passed by Parliament</option>
          <option value="5">Rejected by Parliament</option>
          <option value="6">Submitted for Presidential Ascent</option>
        </select>
      </div>      
    </div>         
    
    <div class="corporato fitted divider"></div>
    
    <button type="button" name="dosubmit" class="corporato button">Add Bill Status</button>
    <a href="index.php?do=bills" class="corporato basic button">Return to list of bills</a>
    <input name="processBillStatus" type="hidden" value="1">
    <input name="bill" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>

<div id="msgholder"></div>
<?php break;?>

<?php case"add": ?>

<div class="corporato form segment">
	<div class="corporato top right attached label">Add a bill</div>
  <form id="corporato_form" name="corporato_form" method="post">

    <div class="field">
      <label>Bill title</label>
      <label class="input"><i class="icon-append icon asterisk"></i>
      	<input type="text" name="title" placeholder="Enter name of bill">
      </label>
    </div>

      
    <div class="four fields">        
      <div class="field">
        <label>Date of introduction</label>               
  	    <input type="date" data-datepicker="true" placeholder="Select date" name="date_introduced">      	
      </div>

      <div class="field">
      <label>Bill type</label>        
        <select name="bill_type">
          <option value="0">--- Select bill type ---</option>
          <option value="1">Private Member's</option>
          <option value="2">Government</option>
        </select>
      </div>

      <div class="field">
        <label>Committee assigned to</label>
        <?php echo $core->getDropList($committee->getCommitteesList(), "committee", "", "Select Committee");?>
      </div>
          
      <div class="field">
        <label>Mover of bill <span class="small">(only for Private Member's Bill)</span></label>
        <?php echo $core->getDropList($leader->getLeaderList(), "mover", "", "Select mover of bill");?>
      </div>    
    </div>   
          

    <div class="corporato divider"></div>
    
    <div class="field">
      <label>About the bill</label>
      <textarea class="bodypost" name="description"></textarea>
    </div>

    <div class="three fields">
      <div class="field">
        <label>Featured</label>
        <div class="inline-group">
          <label class="radio">
            <input type="radio" name="featured" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input type="radio" name="featured" value="0" checked="checked">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
  	</div>    
    
    <div class="corporato fitted divider"></div>
    
    <button type="button" name="dosubmit" class="corporato button">Add Bill</button>
    <a href="index.php?do=bills" class="corporato basic button">Return to list of bills</a>
    <input name="processBill" type="hidden" value="1">
  </form>
</div>

<div id="msgholder"></div>

<?php break;?>

<?php default: ?>
<?php $billsrow = $bill->getBills();?>

<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=bills&amp;action=add"><i class="icon add"></i> Add Bill</a><span>Viewing Bills</span> </div>
  <div class="corporato small segment form">
    <div class="field">
      <div class="corporato icon input">
        <input type="text" name="searchbill" placeholder="Search by bill name" id="searchfield"  />
        <i class="search icon"></i>
        <div id="suggestions"> </div>
      </div>
    </div>
    
    <div class="content-center"> <?php echo alphaBits('index.php?do=bills', "letter");?> </div>
  </div>
  <table class="corporato basic sortable table">
    <thead>
      <tr>
        <th data-sort="string">Title</th>
        <th>Mover</th>
        <th>Introduced</th>
        <th>Assigned Committee</th>
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$billsrow):?>
      <tr>
        <td colspan="6"><?php echo Filter::msgSingleAlert("No bills listed on the platform yet.");?></td>
      </tr>
      <?php else:?>
      <?php foreach ($billsrow as $row):?>
      <tr>
        <td><?php echo $row->title;?></td>
        <td>
          <?php if($row->mover): ?>
            <?php echo $row->mover;?>)
          <?php else: ?>
            Goverment official
          <?php endif; ?>                
        </td>
        <td><?php echo Filter::dodate("short_date", $row->date_introduced);?></td>
        <td><?php echo $row->committee;?></td>
        <td class="push-right"><a href="index.php?do=bills&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="circular inverted success icon pencil link"></i></a> <a href="index.php?do=bills&amp;action=status&amp;id=<?php echo $row->id;?>"><i class="circular inverted success icon refresh link"></i></a> <a class="delete" data-title="Delete bill" data-option="deleteBill" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->title;?>"><i class="circular danger inverted remove icon link"></i></a></td>
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
    $("#searchfield").on('keyup', function () {
        var srch_string = $(this).val();
        var data_string = 'leaderSearch=' + srch_string;
        if (srch_string.length > 4) {
            $.ajax({
                type: "post",
                url: "controller.php",
                data: data_string,
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
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>