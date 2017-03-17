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
<?php include("header.tpl.php");?>

<div class="page-container">

<?php if (isset($allcommittees)):?>

<div class="corporato-grid">
  <div class="columns horizontal-gutters">
    <div class="screen-70 tablet-60 phone-100">
      <div class="clearfix">
        <h2>All committees</h2>      
      </div>
    
      <div class="corporato divider"></div>
      
      <div id="item-content" class="relative">
      <?php if($allcommittees):?>

        <div id="listview" class="clearfix relative">
        <?php foreach($allcommittees as $lrow):?>
          <?php $url = ($core->seo) ? SITEURL . '/committees/' . $lrow->slug . '/' : SITEURL . '/item.php?committeename=' . $lrow->slug;?>
          <section data-id="<?php echo $lrow->cid;?>">                     
            <div class="inner"> 
              <a href="<?php echo $url;?>"><div class="title"><?php echo $lrow->name;?></div></a>
            </div>
          </section>
        <?php endforeach;?>
        </div>
      <?php endif;?>
      </div>
    </div>

    <div class="screen-30 tablet-40 phone-100">
      <div class="padded-30">
        <h4>What are committees?</h4>
        <p>Parliamentary committees investigate specific matters of policy or government administration or performance.</p>
        <p>Committees provide an opportunity for organisations and individuals to participate in policy making and to have their views placed on the public record and considered as part of the decision-making process.</p>
      </div>
    </div>

  </div>

  <div class="corporato divider"></div>
  <div class="corporato tabular segment pagi">
    <aside> <span class="corporato label"><?php echo Lang::$word->TOTAL . ': ' . $pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $pager->current_page . ' ' . Lang::$word->OF . ' ' . $pager->num_pages;?></span> </aside>
    <aside class="right"> <?php echo $pager->display_pages();?> </aside>
  </div> 
    
</div>

<?php else:?>

<div class="corporato-grid">  
  <div class="columns horizontal-gutters">
    <div class="screen-70 tablet-60 phone-100">
      <h2><?php echo $committeerow->name;?></h2>
      <div>A <strong><?php echo $committeerow->committees_type_name;?></strong></div>
      <div class="corporato divider"></div>
      <div><?php echo cleanOut($committeerow->description);?></div>
      <div class="corporato divider"></div>
      <h4>Committee Meetings</h4>

      <?php if(!$committeemeetingsrow):?>
        <div><?php echo Filter::msgSingleAlert("No committees members listed on the platform yet.");?></div>
        <?php else:?>
        <div class="committee-meetings">
        <?php foreach ($committeemeetingsrow as $mrow):?>
        <?php $url = ($core->seo) ? SITEURL . '/committee-meetings/' . $mrow->slug . '/' : SITEURL . '/committee-meetings.php?meetingname=' . $mrow->slug;?>
          <?php echo Filter::dodate("short_date", $mrow->meeting_date);?> - <a href="<?php echo $url;?>"><?php echo $mrow->name;?></a>
          <p><?php echo cleanSanitize($mrow->description,300);?></p>
        <?php endforeach;?>
        <?php unset($mrow);?>
        </div>
      <?php endif;?>
      
    </div>
      
    <div class="screen-30 tablet-40 phone-100">
      <div class="padded-30">
        <button type="submitfollow" class="corporato large black button">Follow for updates</button>
      </div>
      
      <div>
        <h4>Committee Members</h4>

        <?php if(!$committeemembersrow):?>
        <div><?php echo Filter::msgSingleAlert("No committees members listed on the platform yet.");?></div>
        <?php else:?>
        <ol class="committee-members">
        <?php foreach ($committeemembersrow as $row):?>
        <?php $url = ($core->seo) ? SITEURL . '/leaders/' . $row->slug . '/' : SITEURL . '/leaders.php?leadername=' . $row->slug;?>
        <li><a href="<?php echo $url;?>"><?php echo $row->name;?></a> / <span class="smallest"><?php echo getCommitteeMemberRole($row->role);?></span></li>
        <?php endforeach;?>
        <?php unset($row);?>
        </ol>
        <?php endif;?>
       
      </div>
    </div>
  </div>
</div>  

<?php endif;?>

</div>

<?php include("footer.tpl.php");?>