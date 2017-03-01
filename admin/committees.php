<?php
/**
* Committees
*
* @package Membao
* @author Alan Kawamara
* @copyright 2017
*/

if (!defined("_VALID_PHP"))
  die('Direct access to this location is not allowed.');
?>

<?php switch(Filter::$action): case "edit": ?>
<?php $row = $core->getRowById(Committees::cTable, Filter::$id);?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Editing <?php echo $row->name;?></div>
  <form id="corporato_form" name="corporato_form" method="post">

    <div class="field">
      <label>Name of committee</label>
      <label class="input"><i class="icon-append icon asterisk"></i>
        <input type="text" name="name" value="<?php echo $row->name;?>">
      </label>
    </div>      
    
    <div class="field">
      <label>Type of committee</label>
      <?php echo $core->getDropList($committee->getCommitteesTypeList(), "committees_type", $row->committees_type, "Select type of committee");?>
    </div>       
  
    
    <div class="corporato divider"></div>
    
    <div class="field">
      <label>About the committee</label>
      <textarea class="bodypost" name="description"><?php echo $row->description;?></textarea>
    </div>
        
    <div class="corporato fitted divider"></div>
    
    <button type="button" name="dosubmit" class="corporato button">Update Committee Data</button>
    <a href="index.php?do=committees" class="corporato basic button">Cancel Edit</a>
    <input name="processCommittee" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>

<div id="msgholder"></div>

<script type="text/javascript"> 

// <![CDATA[
$(document).ready(function () {
	$("#filter").on("keyup", function() {
		var filter = $(this).val(),
			count = 0;
		$("#fsearch .row").each(function() {
			if ($(this).text().search(new RegExp(filter, "i")) < 0) {
				$(this).fadeOut();
			} else {
				$(this).show();
				count++;
			}
		});
	});
});
// ]]>
</script>
<?php break;?>
<?php case"add": ?>

<div class="corporato form segment">
	<div class="corporato top right attached label">Add a committee</div>
  <form id="corporato_form" name="corporato_form" method="post">

    <div class="field">
      <label>Committee name</label>
      <label class="input"><i class="icon-append icon asterisk"></i>
      	<input type="text" name="name" placeholder="Name of committee">
      </label>
    </div>          

    <div class="corporato divider"></div>
    
    <div class="field">
      <label>About the committee</label>
      <textarea class="bodypost" name="description"></textarea>
    </div>

    <div class="field">
      <label>Type of committee</label>
      <?php echo $core->getDropList($committee->getCommitteesTypeList(), "committees_type", "", "Select type of committee");?>
    </div>     
    
    <div class="corporato fitted divider"></div>

    <div class="two fields">
      <div class="field">
        <label>Committee Chairperson</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "chair", "", "Select committee chair");?>
      </div>

      <div class="field">
        <label>Committee Deputy Chairperson</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "deputy-chair", "", "Select committee deputy chair");?>
      </div>
    </div>

    <div class="two fields">
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member3", "", "Select 3rd committee member");?>
      </div>

      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member4", "", "Select 4th committee member");?>
      </div>
    </div>

    <div class="two fields">
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member5", "", "Select 5th committee member");?>
      </div>

      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member6", "", "Select 6th committee member");?>
      </div>
    </div>    
    
    <div class="two fields">
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member7", "", "Select 7th committee member");?>
      </div>

      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member8", "", "Select 8th committee member");?>
      </div>
    </div>

    <div class="two fields">
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member9", "", "Select 9th committee member");?>
      </div>

      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member10", "", "Select 10th committee member");?>
      </div>
    </div>

    <div class="two fields">
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member11", "", "Select 11th committee member");?>
      </div>

      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member12", "", "Select 12th committee member");?>
      </div>
    </div>

    <div class="two fields">
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member13", "", "Select 13th committee member");?>
      </div>
    
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member14", "", "Select 14th committee member");?>
      </div>
    </div>  

    <div class="two fields">
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member15", "", "Select 15th committee member");?>
      </div>
    
      <div class="field">
        <label>Member</label>
        <?php echo $core->getDropList($leader->getLeaderList(), "member16", "", "Select 16th committee member");?>
      </div>
    </div>
    

    <button type="button" name="dosubmit" class="corporato button">Add Committee</button>
    <a href="index.php?do=committees" class="corporato basic button">Return to list of committees</a>
    <input name="processCommittee" type="hidden" value="1">
  </form>
</div>

<div id="msgholder"></div>

<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
	$("#filter").on("keyup", function() {
		var filter = $(this).val(),
			count = 0;
		$("#fsearch .row").each(function() {
			if ($(this).text().search(new RegExp(filter, "i")) < 0) {
				$(this).fadeOut();
			} else {
				$(this).show();
				count++;
			}
		});
	});
});
// ]]>
</script>

<?php break;?>

<?php default: ?>
<?php $committeesrow = $committee->getCommittees();?>

<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=committees&amp;action=add"><i class="icon add"></i> Add Committee</a><span>Viewing Committees</span> </div>
  <div class="corporato small segment form">
    <div class="two fields">
      <div class="field">
        <div class="corporato icon input">
          <input type="text" name="searchcommittee" placeholder="Search by committee name" id="searchfield"  />
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
    <div class="content-center"> <?php echo alphaBits('index.php?do=committees', "letter");?> </div>
  </div>
  <table class="corporato basic sortable table">
    <thead>
      <tr>
        <th data-sort="string">Name</th>
        <th data-sort="string">Type</th>
        <th data-sort="string">Created</th>        
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$committeesrow):?>
      <tr>
        <td colspan="6"><?php echo Filter::msgSingleAlert("No committees listed on the platform yet.");?></td>
      </tr>
      <?php else:?>
      <?php foreach ($committeesrow as $row):?>
      <tr>
        <td><?php echo $row->name;?></td>
        <td><?php echo $row->committees_name;?></td>
        <td><?php echo Filter::dodate("short_date", $row->created);?></td>        
        <td class="push-right"><a href="index.php?do=committees&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="circular inverted success icon pencil link"></i></a> <a class="delete" data-title="Delete committee" data-option="deleteCommittee" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="circular danger inverted remove icon link"></i></a></td>
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