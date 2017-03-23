<?php
  /**
   * Leader
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

<?php if (isset($allleaders)):?>

<div class="corporato-grid">
  <div class="columns">
    <div class="screen-100 tablet-100 phone-100">
      <div>
        <h2>All MPs</h2>      
      </div>
    
      <div class="corporato divider"></div>
      
      <div id="item-content" class="relative">
      <?php if($allleaders):?>

        <div id="gridview" class="clearfix relative">
        <?php foreach($allleaders as $lrow):?>
          <?php $url = ($core->seo) ? SITEURL . '/leaders/' . $lrow->slug . '/' : SITEURL . '/item.php?leadername=' . $lrow->slug;?>
          <section class="gridmode" data-id="<?php echo $lrow->lid;?>">                     
            <div class="inner"> 
              <a href="<?php echo $url;?>"> <img src="thumbmaker.php?src=<?php echo UPLOADURL;?>leaders/<?php echo ($lrow->thumb) ? $lrow->thumb : "blank.jpg";?>&amp;w=<?php echo round($core->thumb_w);?>&amp;h=<?php echo round($core->thumb_h);?>&amp;s=1&amp;a=t1" alt=""/></a>
              <a href="<?php echo $url;?>"><div class="leader-title"><?php echo $lrow->name;?></div></a>
              <div class="small-details list"><?php echo $lrow->constituency;?></div>
              <div class="small-details list"><?php echo $lrow->partyabbr;?></div>            
            </div>
          </section>
        <?php endforeach;?>
        </div>
      <?php endif;?>
      </div>
    </div>

    

  </div>

</div>
<div class="corporato tabular segment pagi darkergrey">
  <aside> <span class="corporato label"><?php echo 'Total MPs: ' . $pager->items_total;?> / <?php echo 'Page ' . $pager->current_page . ' of ' . $pager->num_pages;?></span> </aside>
  <aside class="right"> <?php echo $pager->display_pages();?> </aside>
</div>

<script type="text/javascript">
// <![CDATA[
$(window).on("orientationchange", function(e) {
    $('#gridview').waitForImages(function() {
        $('#gridview').elasticColumns('refresh');
    });
   $('#gridview-series').waitForImages(function() {
        $('#gridview-series').elasticColumns('refresh');
    });
});
$(document).ready(function() {    

    $('#gridview').waitForImages(function() {
        $('#gridview').Grid({
            inner: 28,
            outer: 0,
            cols: Math.round(1440 / 8 )
        });
    });
  
  $('#gridview-series').waitForImages(function() {
        $('#gridview-series').Grid({
            inner: 28,
            outer: 0,
            cols: Math.round(1440 / 8 )
        });
    });
});
// ]]>
</script>     

<?php else:?>

<div class="corporato-grid grey">
  <div class="columns horizontal-gutters">
    
    <div class="screen-60 tablet-40 phone-100 white">
      <h2><?php echo $leaderrow->name;?></h2>
      <div>Representing <strong><?php echo $leaderrow->coname;?></strong> 
      <?php if($leaderrow->party == 0) { ?>as a Paramount Chief <?php } else { ?> on <strong><?php echo $leaderrow->pparty;?></strong> ticket <?php } ?></div>

      <div class="corporato divider"></div>

      <div id="listview">
        <section class="listmode" data-id="<?php echo $leaderrow->lid;?>">
          <div>
            <div class="corporato tabular segment">
              <aside class="top small nopadding"><a href="<?php echo UPLOADURL;?>leaders/<?php echo $leaderrow->thumb;?>" class="lightbox" title="<?php echo $leaderrow->name;?>"><img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL;?>leaders/<?php echo ($leaderrow->thumb) ? $leaderrow->thumb : "blank.png";?>&amp;w=<?php echo round($core->thumb_w);?>&amp;h=<?php echo round($core->thumb_h);?>&amp;s=1&amp;a=t1" alt=""/></a>                
              </aside>
              <aside>
                <div class="description">                  

                  
                  <div class="corporato divider"></div>
                  <div class="corporato divided horizontal list">                   
                    <div class="item" data-content="Attendance"><?php echo $leaderrow->attendance;?> sittings</div>
                    <div class="item" data-content="Profile views"><i class="icon eye"></i> <?php echo $leaderrow->hits;?></div>
                    <div class="item" data-content="Rate">
                      <?php Leaders::getLeaderRating($leaderrow->lid, $leaderrow->rating, $leaderrow->ratingc);?>
                    </div>
                    <div class="item"> <a class="like toggle" data-content="Like" data-total="<?php echo $leaderrow->vote_up;?>" data-id="<?php echo $leaderrow->lid;?>"><i class="icon danger heart"></i> <small><?php echo $leaderrow->vote_up;?></small></a></div>
                  </div>
                  <div class="corporato divider"></div>                                    
                </div>
              </aside>
            </div>            

          </div>
        </section>
      </div>
    </div>

    <div class="screen-40 tablet-40 phone-100">
      <div class="padded-30">
      <h4>MP's Attendance Record</h4> 
      <p class="item">Has been recorded present for <strong><?php echo $leaderrow->attendance;?></strong> parliamentary sittings out of a possible total of <strong><?php echo $totalSittings;?></strong> this term.</p>
      <p class="item">That gives <?php echo getGenderForm($leaderrow->gender);?> <strong><?php echo getAttendanceAverage($leaderAPc, $generalAPc);?></strong> attendance rate of <strong><?php echo $leaderAPc;?>%</strong>. General parliament sitting average currently stands at <strong><?php echo $generalAPc;?>%</strong>.</p> 
      </div>      
    </div>

  </div>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
	$(".bodycontent").shorten();
	/* == Like Item == */
    $('body').on('click', '[data-content=Like]', function () {
        $(this).children(".icon").toggleClass('check heart');
		$el = $(this).children('small')
		var id = $(this).data("id");
        $.ajax({
            type: "post",
            url: SITEURL + "/ajax/rating.php",
            data: {
				like: 1,
				id: id
			},
            success: function (data) {
				$.cookie("LIKE_M_", id, {
					expires: 120,
					path: '/'
				});
				$($el).html(data);
            }
        });
    });
	
    $("body").on("click", "span.rating-vote b", function () {
        var rate = $(this).data("rate");
		var id = $(this).data("id");
        $.ajax({
            type: "post",
            url: SITEURL + "/ajax/rating.php",
            data: {
				rating: 1,
				id: id,
				stars :rate
			},
            success: function (msg) {
                $(".rating-vote i").html(msg);
				$.cookie("RATE_M_", id, {
					expires: 120,
					path: '/'
				});
            }
        });
        return false;
    });
});
// ]]>
</script>

<?php endif;?>

</div>
<?php include("footer.tpl.php");?>