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
                <div class="corporato description">                    
                    <?php echo cleanOut($home->body);?></div>
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
    </div>


<div class="corporato-grid">
	<div class="columns horizontal-gutters">
    	<div class="screen-30 tablet-30 phone-100">
          	
            
            <div class="clearfix"><h1 class="corporato header fitted push-left">Featured leader</h1></div>
            <div id="item-content" class="relative">
            <?php if($latest):?>    
                <div id="gridview" class="clearfix relative">
                <?php foreach($latest as $lrow):?>
                <?php $url = ($core->seo) ? SITEURL . '/leaders/' . $lrow->slug . '/' : SITEURL . '/leaders.php?itemname=' . $lrow->slug;?>
                <section class="gridmode">        
                    <div> <a href="<?php echo $url;?>"> <img src="thumbmaker.php?src=<?php echo UPLOADURL;?>leaders/<?php echo ($lrow->thumb) ? $lrow->thumb : "blank.jpg";?>&amp;w=<?php echo round($core->thumb_w);?>&amp;h=<?php echo round($core->thumb_h);?>&amp;s=1&amp;a=t1" alt=""/></a>                        
                    </div>
                </section>
                <div>
                    <div class="small-title list"><?php echo $lrow->fullname;?></div>
                    <div class="small-details list"><?php echo $lrow->coname;?></div>
                    <div class="small-details list"><?php echo getAge($lrow->dob);?> years old</div>
                    <div class="small-button"><a href="<?php echo $url;?>" class="corporato info button">Read profile</a></div>
                </div>
                <?php endforeach;?>
                </div>
            <?php endif;?>
            </div>
            
        </div> 
        <div class="screen-40 tablet-40 phone-100">        
			<div class="columns horizontal-gutters">
  				<div class="screen-50 tablet-50 phone-100">
	                <h2>Leaderboard</h2>
                    <div class="corporato list">
					<?php $i = 0;?>
                    <?php foreach ($mostattendance as $i => $marow):?>
                    <?php $i++;?>
                    <?php $url = ($core->seo) ? SITEURL . '/leader/' . $marow->slug . '/' : SITEURL . '/leader.php?itemname=' . $marow->slug;?>
                        <div class="item"><span class="corporato circular label">
                            <?php echo $i;?></span> <a href="<?php echo $url;?>"><?php echo $marow->fullname;?></a> <?php echo $marow->sittings ." ". pluralize($marow->sittings, "sitting");?>
                        </div>
                    <?php endforeach;?>
                  	</div>
                </div>
                <div class="screen-50 tablet-50 phone-100">
	                <h2>Wall of shame</h2>
                    <div class="corporato list">
					<?php $i = 0;?>
                    <?php foreach ($leastattendance as $j => $larow):?>
                    <?php $j++;?>
                    <?php $url = ($core->seo) ? SITEURL . '/leader/' . $larow->slug . '/' : SITEURL . '/leader.php?itemname=' . $larow->slug;?>
                        <div class="item"><span class="corporato circular label">
                            <?php echo $j;?></span> <a href="<?php echo $url;?>"><?php echo $larow->fullname;?></a> <?php echo $larow->sittings ." ". pluralize($larow->sittings, "sitting");?>
                        </div>
                    <?php endforeach;?>
                  	</div>
                </div>
            </div>    
        </div>
        
        <div class="screen-30 tablet-30 phone-100">
			
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
// ]]>
</script>
<?php include("footer.tpl.php");?>