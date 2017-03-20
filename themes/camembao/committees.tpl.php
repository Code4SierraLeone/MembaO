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

<?php if (isset($allcommittees)):?>

<div class="corporato-grid grey">
  <div class="columns horizontal-gutters">
    <div class="screen-50 tablet-50 phone-100 white">
      <div class="clearfix">
        <h2>All committees</h2>      
      </div>
    
      <div class="corporato divider"></div>
      
      <div id="item-content" class="relative">
      <?php if($allcommittees):?>

        <div id="listview">
        <?php foreach($allcommittees as $lrow):?>
          <?php $url = ($core->seo) ? SITEURL . '/committees/' . $lrow->slug . '/' : SITEURL . '/item.php?committeename=' . $lrow->slug;?>
          <section data-id="<?php echo $lrow->id;?>">                     
            <div class="inner"> 
              <a href="<?php echo $url;?>"><div class="title"><?php echo $lrow->name;?></div></a>
            </div>
          </section>
        <?php endforeach;?>
        </div>
      <?php endif;?>
      </div>

    </div>

    <div class="screen-50 tablet-50 phone-100">
      <div class="padded-30">
        <h4>What are committees?</h4>
        <p><?php echo cleanOut($core->committees_description);?></p>
      </div>
    </div>

  </div>
    
</div>

<?php else:?>

<div class="corporato-grid grey">  
  <div class="columns horizontal-gutters">
    <div class="screen-70 tablet-60 phone-100 white">
      <h2><?php echo $committeerow->name;?></h2>
      <div>A <strong><?php echo $committeerow->committees_type_name;?></strong></div>
      <div class="corporato divider"></div>
      <div><?php echo cleanOut($committeerow->description);?></div>
      <div class="corporato divider"></div>
      
      <h4>Latest Committee Meetings</h4>

      <?php if(!$committeemeetingsrow):?>
        <div><?php echo Filter::msgSingleAlert("No committees members listed on the platform yet.");?></div>
        <?php else:?>
        <div class="committee-meetings">
        <?php foreach ($committeemeetingsrow as $mrow):?>
          <?php $url = ($core->seo) ? SITEURL . '/meetings/' . $mrow->slug . '/' : SITEURL . '/meetings.php?meetingname=' . $mrow->slug;?>                         

          <div><a href="<?php echo $url;?>"><?php echo $mrow->name;?></a></div>
          <span class="date-label"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo Filter::dodate("short_date", $mrow->meeting_date);?></span> 
          <span class="committee-label"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo getCommitteeMeetingType($mrow->meeting_type);?></span>
          <div class="corporato divider"></div>
          <p><?php echo cleanSanitize($mrow->description,300);?></p>
        <?php endforeach;?>
        <?php unset($mrow);?>
        </div>
      <?php endif;?>
      <div class="padded-30">
        <a href="<?php echo SITEURL;?>/meetings" class="corporato large positive button"><i class="fa fa-calendar" aria-hidden="true"></i> View all meetings</a>
      </div>
      
    </div>
      
    <div class="screen-30 tablet-40 phone-100">
      
      <div class="padded-30">
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