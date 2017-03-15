<?php
  /**
  * Bills
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

<?php if (isset($allbills)):?>

<div class="corporato-grid">

    <div class="clearfix">
      <h2 class="corporato header fitted push-left">All bills</h2>      
    </div>
    
    <div class="corporato divider"></div>
    <div id="item-content" class="relative">
    <?php if($allbills):?>

    <div id="listview" class="clearfix relative">
      <?php foreach($allbills as $lrow):?>
      <?php $url = ($core->seo) ? SITEURL . '/bills/' . $lrow->slug . '/' : SITEURL . '/item.php?itemname=' . $lrow->slug;?>
    <section data-id="<?php echo $lrow->bid;?>">                     
      <div class="inner"> 
              <a href="<?php echo $url;?>">
              <h4 class="title"><?php echo $lrow->title;?></h4></a>
          </div>
        </section>
      <?php endforeach;?>
    </div>
    <?php endif;?>
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
      <div class="corporato basic message">
        <h2><?php echo $billrow->title;?></h2>
        <div><?php echo cleanOut($billrow->description);?></div>
      </div>
    </div>
      
    <div class="screen-30 tablet-40 phone-100">
      <div class="corporato small space divider"></div>
    </div>
  </div>
</div>  

<?php endif;?>

</div>
<?php include("footer.tpl.php");?>