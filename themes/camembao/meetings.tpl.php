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

<div class="corporato-grid crumbs">
  <div class="crumbs">
      <div class="corporato breadcrumb">
          <div class="section"><?php echo Lang::$word->CRB_HERE;?></div>
          : <a href="<?php echo SITEURL;?>/" class="section"><?php echo Lang::$word->CRB_HOME;?></a>
          <div class="divider"></div>
          <?php include_once("crumbs.php");?>
      </div>
    </div>
</div>

<div class="page-container">

<?php if (isset($allmeetings)):?>

<div class="corporato-grid">
  <div class="columns horizontal-gutters">
    <div class="screen-70 tablet-60 phone-100 white">
      <div class="clearfix">
        <h2>All meetings</h2>      
      </div>
    
      <div class="corporato divider"></div>
      
      <div id="item-content" class="relative">
      <?php if($allmeetings):?>

        <div id="listview meetings" class="clearfix relative">
        <?php foreach($allmeetings as $lrow):?>
          <?php $url = ($core->seo) ? SITEURL . '/meetings/' . $lrow->slug . '/' : SITEURL . '/item.php?meetingname=' . $lrow->slug;?>
          <section data-id="<?php echo $lrow->id;?>">                     
            <div class="inner">               
              <a href="<?php echo $url;?>"><div class="title"><?php echo $lrow->name;?></div></a>
              <span class="date-label"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo Filter::dodate("short_date", $lrow->meeting_date);?></span> 
              <span class="committee-label"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $lrow->committees_name;?></span>
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

<div class="corporato-grid grey">  
  <div class="columns horizontal-gutters">
    <div class="screen-60 tablet-50 phone-100 white">
      <h2><?php echo $meetingrow->name;?></h2>
      <div>
        <span class="date-label"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo Filter::dodate("short_date", $meetingrow->meeting_date);?></span> 
        <span class="committee-label"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $meetingrow->committees_name;?></span>
        <span class="committee-label"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo getCommitteeMeetingType($meetingrow->meeting_type);?></span></div>
        
      <div class="corporato divider"></div>
      <div><?php echo cleanOut($meetingrow->description);?></div>
      
      
    </div>
      
    <div class="screen-40 tablet-50 phone-100">      
      
      <div class="padded-30">
      <h4>Committee Members Attendance</h4>  

        <?php if(!$attendancerow):?>
        <div><?php echo Filter::msgSingleAlert("No attendance records for this meeting updated.");?></div>
        <?php else:?>
        <ol class="committee-members">
        <?php foreach ($attendancerow as $arow):?>
        <?php $url = ($core->seo) ? SITEURL . '/leaders/' . $arow->leader_slug . '/' : SITEURL . '/leaders.php?leadername=' . $arow->leader_slug;?>
        <?php 
          if($arow->status == 1):
            $class = "bold";
          else:
            $class = "normal";
          endif;
        ?>
        <li class="<?php echo $class;?>"><a href="<?php echo $url;?>"><?php echo $arow->leader_name;?></a> / <span><?php echo getAttendanceStatus($arow->status);?></span></li>
        <?php endforeach;?>
        <?php unset($arow);?>
        </ol>
        <?php endif;?>
       <div class="smallest">* All MPs not present marked as absent, even if they had leave of absence.</div>
      </div>
    </div>
  </div>
</div>  

<?php endif;?>

</div>

<?php include("footer.tpl.php");?>