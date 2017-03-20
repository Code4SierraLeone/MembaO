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
    
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update committee data</button>
    <a href="index.php?do=committees" class="corporato danger button"><i class="remove icon"></i>cancel edit</a>
    <input name="processCommittee" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>

<div id="msgholder"></div>
<?php break;?>

<?php case"meeting-attendance": ?>
<?php $cmrow = $core->getRowById(Committees::cmsTable, Filter::$id);?>
<?php $listrow = $committee->getCommitteeMembers($cmrow->committee);?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Committee Meeting Attendance Records / <?php echo Filter::dodate("short_date", $cmrow->meeting_date);?></div>
    <form id="corporato_form" name="corporato_form" method="post">
      
      
        <?php if(!$listrow):?>
          <tr>
            <td colspan="3"><?php Filter::msgSingleAlert("Sorry, no committee members listed yet.");?></td>
          </tr>
        <?php else:?>

        <table class="corporato basic table celled">
        <thead>
          <tr>
            <th class="disabled"> <label class="checkbox">
              <input type="checkbox" name="masterCheckbox" id="masterCheckbox">
              <i></i>Select as present</label>
            </th>
            <th>MP</th>
                    
          </tr>
        </thead>

        <tbody>
          
        <?php foreach($listrow as $lrow):?>
          <tr>
            <td class="hide-tablet"><label class="checkbox">
              <input name="leader_id[<?php echo $lrow->member;?>]" type="checkbox" value="<?php echo $lrow->member;?>">
              <i></i></label></td>
            
            <td><strong><?php echo $lrow->name;?></strong> <br />              
            </td>
                      
          </tr>
        <?php endforeach;?>      

        <?php endif;?>
        </tbody>              
      </table>              
      
      <div class="corporato divider"></div>

      <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update attendance register</button>
      <button onclick="goBack()" class="corporato danger button"><i class="remove icon"></i>go back to meetings</a>
      <input name="processCommitteeMeetingAttendance" type="hidden" value="1">
      <input name="meeting_id" type="hidden" value="<?php echo Filter::$id;?>" />
    </form>
</div>
<script>
function goBack() {
    window.history.back();
}
</script>
<div id="msgholder"></div>

<?php break;?>

<?php case"edit-meeting": ?>
<?php $row = $core->getRowById(Committees::cmsTable, Filter::$id);?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Editing <?php echo $row->name;?></div>
  <form id="corporato_form" name="corporato_form" method="post">    
    
    <div class="three fields">
      <div class="field">
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="name" value="<?php echo $row->name;?>">
        </label>
      </div>
      <div class="field">
        <div class="corporato input"> <i class="icon-prepend icon calendar"></i>
          <input name="meeting_date" type="text" data-datepicker="true" placeholder="<?php echo Filter::dodate("short_date", $row->meeting_date);?>" />
        </div>
      </div>
      <div class="field">        
        <select name="meeting_type">
          <option value="0">--- Select meeting type ---</option>
          <option value="1"<?php if ($row->meeting_type == 1) echo " selected=\"selected\"";?>>In camera</option>
          <option value="2"<?php if ($row->meeting_type == 2) echo " selected=\"selected\"";?>>Public</option>          
        </select>
      </div>
    </div>
    
    <div class="corporato divider"></div>
    
    <div class="field">
      <label>About the meeting</label>
      <textarea class="bodypost" name="description"><?php echo $row->description;?></textarea>
    </div>
        
    <div class="corporato fitted divider"></div>
    
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update committee meeting</button>
    <a href="index.php?do=committees" class="corporato danger button"><i class="remove icon"></i>cancel edit</a>
    <input name="processCommitteeMeeting" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
    <input name="committee" type="hidden" value="<?php echo $row->committee;?>" />
  </form>
</div>

<div id="msgholder"></div>

<?php break;?>

<?php case"add-meeting": ?>

<div class="corporato form segment">
  <div class="header"><span>Add Meeting</span> </div>
  <form id="corporato_form" name="corporato_form" method="post">      
    
    <div class="three fields">
      <div class="field">      
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="name" placeholder="Meeting title">
        </label>
      </div>
      <div class="field">
        <div class="corporato input"> <i class="icon-prepend icon calendar"></i>
          <input name="meeting_date" type="text" data-datepicker="true" placeholder="Select meeting date" />
        </div>
      </div>
      <div class="field">        
        <select name="meeting_type">
          <option value="0">--- Select meeting type ---</option>
          <option value="1">In camera</option>
          <option value="2">Public</option>
        </select>
      </div>        
    </div>
    
    <div class="corporato divider"></div>
    
    <div class="field">
      <label>About the meeting</label>
      <textarea class="bodypost" name="description"></textarea>
    </div>
        
    <div class="corporato fitted divider"></div>
    
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>add committee meeting</button>
    <a href="index.php?do=committees" class="corporato danger button"><i class="remove icon"></i>back to committees</a>
    <input name="processCommitteeMeeting" type="hidden" value="1">
    <input name="committee" type="hidden" value="<?php echo Filter::$id;?>" />
    
  </form>
</div>

<div id="msgholder"></div>

<?php break;?>


<?php case"meetings": ?>
<?php $committeemeetingsrow = $committee->getCommitteeMeetings();?>

<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=committees&amp;action=add-meeting&amp;id=<?php echo Filter::$id;?>"><i class="icon add"></i> Add Committee Meeting</a><span>Viewing Committee Meetings</span> </div>
  <div class="corporato small segment form">
    <form method="post" id="corporato_form" name="corporato_form">
      <div class="three fields">
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
            <input type="text" name="usersearchfield" placeholder="Search by meeting name" id="searchfield"  />
            <i class="search icon"></i>
            <div id="suggestions"> </div>
          </div>
        </div>
        
      </div>
    </form>

  </div>
  <table class="corporato basic table">
    <thead>
      <tr>
        <th>Date</th> 
        <th>Name</th>
        <th>Type</th>       
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$committeemeetingsrow):?>
      <tr>
        <td colspan="6"><?php echo Filter::msgSingleAlert("No committee meetings listed on the platform yet.");?></td>
      </tr>
      <?php else:?>
      <?php foreach ($committeemeetingsrow as $row):?>
      <tr>
        <td><?php echo Filter::dodate("short_date", $row->meeting_date);?></td>
        <td><?php echo $row->name;?></td>
        <td><?php echo getCommitteeMeetingType($row->meeting_type);?></td>                
        <td class="push-right">
          <a class="corporato positive button" href="index.php?do=committees&action=meeting-attendance&id=<?php echo $row->id;?>">
            <i class="positive checkmark icon"></i>update attendance register</a>
          <a class="corporato purple button" href="index.php?do=committees&amp;action=edit-meeting&amp;id=<?php echo $row->id;?>">
            <i class="purple icon pencil"></i>edit</a> 
          <a class="delete corporato danger button" data-title="Delete meeting" data-option="deleteCommitteeMeeting" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="danger inverted remove icon"></i>delete</a></td>
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

<?php case"members": ?>

<div class="corporato form segment">
  <?php $committeemembersrow = $committee->getCommitteeMembers(Filter::$id);?>

  <div class="corporato basic segment">
    <div class="header"><a class="corporato button push-right" href="index.php?do=committees&amp;action=update-members&amp;id=<?php echo Filter::$id;?>"><i class="icon add"></i> Update Committee Members</a><span>Viewing Committee Members</span> </div>

    <table class="corporato basic table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Constituency</th>
          <th>Role</th>                
        </tr>
      </thead>
      <tbody>
        <?php if(!$committeemembersrow):?>
        <tr>
          <td colspan="6"><?php echo Filter::msgSingleAlert("No committees members listed on the platform yet.");?></td>
        </tr>
        <?php else:?>
        <?php $i = 1; foreach ($committeemembersrow as $row):?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row->name;?></td>
            <td><?php echo $row->constituencyid;?></td>
            <td><?php echo getCommitteeMemberRole($row->role);?></td>                
          </tr>
        <?php $i++; endforeach;?>
        <?php unset($row);?>
        <?php endif;?>
      </tbody>
    </table>
  </div>

  <div class="corporato divider"></div>

  <a href="index.php?do=committees&amp;action=members&amp;id=<?php echo Filter::$id;?>" class="corporato positive button">
    <i class="positive checkmark icon"></i>update committee members</a>
  <a href="index.php?do=committees" class="corporato danger button"><i class="remove icon"></i>Return to list of committees</a>
</div>


<?php break;?>

<?php case"update-members": ?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Add or edit committee members</div>
  <form id="corporato_form" name="corporato_form" method="post">

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
    

    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update committee members</button>
    <a href="index.php?do=committees" class="corporato danger button"><i class="remove icon"></i>Return to list of committees</a>
    <input name="processCommitteeMembers" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>

<div id="msgholder"></div>

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
    

    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>add committee</button>
    <a href="index.php?do=committees" class="corporato danger button"><i class="remove icon"></i>Return to list of committees</a>
    <input name="processCommittee" type="hidden" value="1">
  </form>
</div>

<div id="msgholder"></div>

<?php break;?>

<?php default: ?>
<?php $committeesrow = $committee->getCommittees();?>

<div class="corporato basic segment">
  <div class="header">
    <a class="corporato button push-right" href="index.php?do=committees&amp;action=add"><i class="icon add"></i> Add Committee</a> 
     <a class="corporato button push-right" href="index.php?do=committees-type"><i class="icon add"></i> Committee Types</a>
    <span>Viewing Committees</span> </div>
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
  <table class="corporato basic table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Created</th>        
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
        <td class="push-right">        
          <a class="corporato teal button" href="index.php?do=committees&amp;action=members&amp;id=<?php echo $row->id;?>">
            <i class="teal inverted icon user"></i>members</a>  
          <a class="corporato info button" href="index.php?do=committees&amp;action=meetings&amp;id=<?php echo $row->id;?>">
            <i class="info inverted icon calendar"></i>meetings</a> 
          <a class="corporato purple button" href="index.php?do=committees&amp;action=edit&amp;id=<?php echo $row->id;?>">
            <i class="purple icon pencil"></i>edit</a>
          <a class="delete corporato danger button" data-title="Delete committee" data-option="deleteCommittee" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="danger inverted remove icon"></i>delete</a></td>
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