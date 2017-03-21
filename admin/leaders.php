<?php
  /**
   * Leaders
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = $core->getRowById(Leaders::lTable, Filter::$id);?>

<div class="corporato form segment">
  <div class="corporato top right attached label">Editing / Hon. <?php echo $row->last_name;?></div>
  <form id="corporato_form" name="corporato_form" method="post">
    <div class="three fields">
      <div class="field">
        <label>First name</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="first_name" value="<?php echo $row->first_name;?>">
        </label>
      </div>      
      <div class="field">
        <label>Last name</label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" name="last_name" value="<?php echo $row->last_name;?>">
        </label>
      </div>
      <div class="field">
        <label>Other name </label>
        <label class="input"><i class="icon-append icon"></i>
          <input type="text" name="other_name" value="<?php echo $row->other_name;?>">
        </label>
      </div>
    </div>
    
    <div class="three fields">        
        <div class="field">
        <label>Gender</label>
        <select name="gender">
          <option value="0">--- Select gender ---</option>
          <option value="1"<?php if ($row->gender == 1) echo " selected=\"selected\"";?>>Male</option>
          <option value="2"<?php if ($row->gender == 2) echo " selected=\"selected\"";?>>Female</option>
        </select>
      	</div>
        <div class="field">
    	    <label>Date of birth</label>               
	        <input type="date" data-datepicker="true" placeholder="Select date" value="<?php echo $row->dob;?>" name="dob">      	
        </div>
        
        <div class="field">
        <label>Political party</label>
        <?php echo $core->getDropList($leader->getPartyList(), "party", $row->party, "Select Party");?>
      	</div>       
    </div>
    
    <div class="two fields">                        
        <div class="field">
        <label>Constituency</label>
        <?php echo $core->getDropList($leader->getConstituencyList(), "constituency", $row->constituency, "Select Constituency");?>
      	</div> 
        <div class="field">
        <label>Office</label>
        <select name="office">
          <option value="0">--- Select office ---</option>
          <option value="1"<?php if ($row->office == 1) echo " selected=\"selected\"";?>>Ordinary Member of Parliament</option>
          <option value="2"<?php if ($row->office == 2) echo " selected=\"selected\"";?>>Paramount Chief Member of Parliament</option>
        </select>
      	</div>       
    </div>
    
    <div class="corporato divider"></div>
    <div class="two fields">
      <div class="field">
        <label>Upload profile picture</label>
        <label class="input">
          <input type="file" name="thumb" id="thumbid" class="filefield">
        </label>
      </div>
      <div class="field">
        <label>Profile picture</label>
        <div class="corporato avatar image">
          <?php if($row->thumb):?>
          <img src="<?php echo UPLOADURL;?>leaders/<?php echo $row->thumb;?>" alt="<?php echo $row->thumb;?>">
          <?php else:?>
          <img src="<?php echo UPLOADURL;?>leaders/blank.png" alt="<?php echo $row->thumb;?>">
          <?php endif;?>
        </div>
      </div>
    </div>
    
    <div class="corporato divider"></div>    
    
    <div class="three fields">
        <div class="field">
          <label>Published</label>
          <div class="inline-group">
            <label class="radio">
              <input type="radio" name="active" value="1" <?php getChecked($row->active, 1); ?>>
              <i></i><?php echo Lang::$word->YES;?></label>
            <label class="radio">
              <input type="radio" name="active" value="0" <?php getChecked($row->active, 0); ?>>
              <i></i><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
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
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>update leader profile</button>
    <a href="index.php?do=leaders" class="corporato danger button"><i class="remove icon"></i>cancel edit</a>
    <input name="processLeader" type="hidden" value="1">
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>
<div id="msgholder"></div>

<?php break;?>
<?php case"add": ?>

<div class="corporato form segment">
	<div class="corporato top right attached label">Add a leader</div>
  	<form id="corporato_form" name="corporato_form" method="post">
    <div class="three fields">
    	<div class="field">
        	<label>First name</label>
        	<label class="input"><i class="icon-append icon asterisk"></i>
          		<input type="text" name="first_name" placeholder="First name">
        	</label>
      	</div>
      	<div class="field">
        	<label>Last name</label>
        	<label class="input"><i class="icon-append icon asterisk"></i>
          		<input type="text" name="last_name" placeholder="Last name">
        	</label>
      </div>
      <div class="field">
        	<label>Other name</label>
        	<label class="input"><i class="icon-append icon"></i>
          		<input type="text" name="other_name" placeholder="Other name">
        	</label>
      </div>
      
    </div>
    
    <div class="three fields">        
        <div class="field">
        <label>Gender</label>
        <select name="gender">
          <option value="0">--- Select gender ---</option>
          <option value="1">Male</option>
          <option value="2">Female</option>
        </select>
      	</div>
        <div class="field">
    	    <label>Date of birth</label>               
	        <input type="date" data-datepicker="true" placeholder="Select date" name="dob">      	
        </div>
        
        <div class="field">
        <label>Political party</label>
        <?php echo $core->getDropList($leader->getPartyList(), "party", "", "Select Party");?>
      	</div>
        
    </div>   
    
    <div class="corporato divider"></div>
    <div class="three fields">
      <div class="field">
        <label>Profile picture</label>
        <label class="input">
          <input name="thumb" type="file" id="thumbid" class="filefield">
        </label>
      </div>
      
      <div class="field">
        <label>Office</label>
        <select name="office">
          <option value="0">--- Select office ---</option>
          <option value="1">Ordinary Member of Parliament</option>
          <option value="2">Paramount Chief Member of Parliament</option>
        </select>
      </div>
      <div class="field">
        <label>Constituency</label>
        <?php echo $core->getDropList($leader->getConstituencyList(), "constituency", "", "Select Constituency");?>
      	</div>
    </div>

    <div class="corporato divider"></div>    

    <div class="three fields">
        <div class="field">
          <label>Published</label>
          <div class="inline-group">
            <label class="radio">
              <input type="radio" name="active" value="1" checked="checked">
              <i></i><?php echo Lang::$word->YES;?></label>
            <label class="radio">
              <input type="radio" name="active" value="0" >
              <i></i><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
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
    <button type="button" name="dosubmit" class="corporato positive button"><i class="positive checkmark icon"></i>add leader</button>
    <a href="index.php?do=leaders" class="corporato danger button"><i class="remove icon"></i>cancel</a>
    <input name="processLeader" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>

<?php break;?>

<?php default: ?>
<?php $leadersrow = $leader->getLeaders();?>
<div class="corporato basic segment">
  <div class="header"><a class="corporato button push-right" href="index.php?do=leaders&amp;action=add"><i class="icon add"></i> Add Leader</a><span>Viewing Members of Parliament</span> </div>
  <div class="corporato small segment form">
    
    <div class="field">
      <div class="corporato icon input">
        <input type="text" name="serachprod" placeholder="Search by last name" id="searchfield"  />
        <i class="search icon"></i>
        <div id="suggestions"> </div>
      </div>
    </div>      

  </div>
  <table class="corporato basic sortable table">
    <thead>
      <tr>
        <th data-sort="string">Names</th>
        <th data-sort="string">Constituency</th>
        <th data-sort="string">Party</th>
        <th data-sort="string">Gender</th>
        <th>Age</th>
        <th class="disabled push-right"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$leadersrow):?>
      <tr>
        <td colspan="6"><?php echo Filter::msgSingleAlert("No leaders listed on the platform yet.");?></td>
      </tr>
      <?php else:?>
      <?php foreach ($leadersrow as $row):?>
      <tr>
        <td><?php if($row->thumb):?>
          <img src="<?php echo UPLOADURL;?>leaders/<?php echo $row->thumb;?>" alt="<?php echo $row->title;?>" class="corporato avatar image"/>
          <?php else:?>
          <img src="<?php echo UPLOADURL;?>leaders/blank.jpg" alt="<?php echo $row->name;?>" class="corporato avatar image"/>
          <?php endif;?>
          <?php echo $row->name;?></td>
        <td><?php echo $row->constituency;?></td>
        <td><?php if($row->partyname): ?>
          <?php echo $row->partyname.' ('. $row->partyabbr;?>)
          <?php else: ?>
            N/A
          <?php endif; ?>  
        </td>
        <td><?php echo getGender($row->gender);?></td>
        <td><?php echo getAge($row->dob);?></td>                
        <td class="push-right">
          <a class="corporato purple button" href="index.php?do=leaders&amp;action=edit&amp;id=<?php echo $row->id;?>">
            <i class="purple icon pencil"></i>edit</a> 
          <a class="delete corporato danger button" data-title="Delete leader listing" data-option="deleteLeader" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->title;?>"><i class="danger inverted remove icon"></i>delete</a></td>
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