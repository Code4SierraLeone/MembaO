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
<div class="corporato-grid">
  <div class="columns horizontal-gutters">
    <div class="screen-70 tablet-60 phone-100">
      <div class="corporato basic message">
        <h2><?php echo $row->fullname;?><small class="push-right">representing <?php echo $row->coname;?></small></h2>
      </div>
      <div id="listview">
        <section class="listmode" data-id="<?php echo $row->pid;?>">
          <div>
            <div class="corporato tabular segment">
              <aside class="top center"><a href="<?php echo UPLOADURL;?>leaders/<?php echo $row->thumb;?>" class="lightbox" title="<?php echo $row->fullname;?>"><img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL;?>leaders/<?php echo ($row->thumb) ? $row->thumb : "blank.png";?>&amp;w=<?php echo round($core->thumb_w);?>&amp;h=<?php echo round($core->thumb_h);?>&amp;s=1&amp;a=t1" alt=""/></a>                
              </aside>
              <aside>
                <div class="description">
                  <div class="bodycontent"><?php echo $body = cleanOut($row->bio);?> </div>
                  <div class="corporato divider"></div>
                  <div class="corporato divided horizontal list">                   
                    <div class="item"><?php echo $row->attendance;?> sittings</div>
                    <div class="item"><i class="icon bullseye"></i> <?php echo $row->hits;?></div>
                    <div class="item">
                      <?php Leaders::getLeaderRating($row->lid, $row->rating, $row->ratingc);?>
                    </div>
                    <div class="item"> <a class="like toggle" data-content="<?php echo Lang::$word->LIKE;?>" data-total="<?php echo $row->vote_up;?>" data-id="<?php echo $row->lid;?>"><i class="icon danger heart"></i> <small><?php echo $row->vote_up;?></small></a></div>
                  </div>
                  <div class="corporato divider"></div>                                    
                </div>
              </aside>
            </div>
          </div>
        </section>
      </div>
    </div>
    <div class="screen-30 tablet-40 phone-100">
      <div class="corporato small space divider"></div>
      
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
				$.cookie("LIKE_DDP_", id, {
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
				$.cookie("RATE_DDP_", id, {
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
<?php include("footer.tpl.php");?>