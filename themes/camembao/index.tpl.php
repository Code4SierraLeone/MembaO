<?php
  /**
   * Index
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php include("header.tpl.php");?>

<div class="corporato-grid home">
    <div class="two columns horizontal-gutters">
        <div class="screen-50 tablet-50 phone-100">
        <?php if($home):?>
            <div class="corporato description padded-30t">                    
                <?php echo cleanOut($home->body);?>
            </div>    
        <?php endif;?>
        </div>
        
        <div class="screen-50 tablet-50 phone-100">
            <div class="columns">
                <div class="row padded20up">
                    <?php include(THEMEDIR . "/home_search.tpl.php");?>
                </div>
            </div>  
        </div>
    </div>  
</div>  


<div class="corporato-grid">
	<div class="columns horizontal-gutters padded-30t">
    	<div class="screen-33 tablet-33 phone-100">       	
            
            <h4>Featured leader</h4>

            <div id="item-content" class="relative">
            <?php if($latest):?>    
                <div id="gridview" class="featured-leader clearfix relative">
                <?php foreach($latest as $lrow):?>
                <?php $url = ($core->seo) ? SITEURL . '/leaders/' . $lrow->slug . '/' : SITEURL . '/leaders.php?itemname=' . $lrow->slug;?>
                <section class="gridmode" >        
                    <div class=""> 
                        <a href="<?php echo $url;?>"> <img src="thumbmaker.php?src=<?php echo UPLOADURL;?>leaders/<?php echo ($lrow->thumb) ? $lrow->thumb : "blank.jpg";?>&amp;w=<?php echo round($core->thumb_w);?>&amp;h=<?php echo round($core->thumb_h);?>&amp;s=1&amp;a=t1" alt=""/></a>  
                    </div>
                </section>
                <div>
                    <div><a href="<?php echo $url;?>"><strong><?php echo $lrow->name;?></strong></a></div>
                    <div class="small-details list"></div>
                    <div class="small-details list">Representing <?php echo $lrow->coname;?> on <?php echo $lrow->partyabbr;?> ticket</div>
                    <div class="small-details list"><?php echo getAge($lrow->dob);?></div>
                    <div class="small-button"><a href="<?php echo $url;?>" class="corporato membao button">Read profile</a></div>
                </div>
                <?php endforeach;?>
                </div>
            <?php endif;?>
            </div>
            
        </div> 
        <div class="screen-33 tablet-33 phone-100">        
			
	        <h4>Leaderboard</h4>        
            <ol class="ranking">
            <?php foreach ($mostattendance as $marow):?>
                <li>
                    <?php $url = ($core->seo) ? SITEURL . '/leaders/' . $marow->slug . '/' : SITEURL . '/leader.php?leadersname=' . $marow->slug;?>
                    <a href="<?php echo $url;?>"><strong><?php echo $marow->name;?></strong> <span class="small-details"> representing <?php echo $marow->coname;?></span></a>      <div class="small-details list">Marked <strong>present</strong> for <?php echo $marow->sittings ." ". pluralize($marow->sittings, "sitting");?></div>    
                </li>
                <?php endforeach;?>
            </ol>

        </div>
        
        <div class="screen-33 tablet-33 phone-100">
            <h4>Wall of shame</h4>            
            <ol class="ranking">
            <?php foreach ($leastattendance as $j => $larow):?>
                <li>
                    <?php $url = ($core->seo) ? SITEURL . '/leaders/' . $larow->slug . '/' : SITEURL . '/leader.php?leadersname=' . $larow->slug;?>
                    <a href="<?php echo $url;?>"><strong><?php echo $larow->name;?></strong> <span class="small-details"> representing <?php echo $larow->coname;?></span></a>      <div class="small-details list">Marked <strong>present</strong> for <?php echo $larow->sittings ." ". pluralize($larow->sittings, "sitting");?></div>    
                </li>
            <?php endforeach;?>
            </ol>            
            <div class="smallest">* All MPs not present are marked as absent, even if they had leave of absence.</div>
		</div>
	</div>        	
</div>

<script type="text/javascript">
// <![CDATA[
$(window).on("orientationchange", function(e) {
    $('#gridview').waitForImages(function() {
        $('#gridview').elasticColumns('refresh');
    });
});
$(document).ready(function() {   
    $('#gridview').waitForImages(function() {
        $('#gridview').Grid({
            inner: 28,
            outer: 0,
            cols: Math.round(1440 / <?php echo $core->homelist;?> )
        });
    });
});

$('.count').each(function () {
  var $this = $(this);
  jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
    duration: 1000,
    easing: 'swing',
    step: function () {
      $this.text(Math.ceil(this.Counter));
    }
  });
});
// ]]>
</script>
<?php include("footer.tpl.php");?>