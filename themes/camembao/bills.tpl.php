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
  <div class="columns horizontal-gutters">
    <div class="screen-70 tablet-60 phone-100">
      <div class="clearfix">
        <h2>All bills</h2>      
      </div>
    
      <div class="corporato divider"></div>
      
      <div id="item-content" class="relative">
      <?php if($allbills):?>

        <div id="listview" class="clearfix relative">
        <?php foreach($allbills as $lrow):?>
          <?php $url = ($core->seo) ? SITEURL . '/bills/' . $lrow->slug . '/' : SITEURL . '/item.php?itemname=' . $lrow->slug;?>
          <section data-id="<?php echo $lrow->bid;?>">                     
            <div class="inner"> 
              <a href="<?php echo $url;?>"><div class="title"><?php echo $lrow->title;?></div></a>
            </div>
          </section>
        <?php endforeach;?>
        </div>
      <?php endif;?>
      </div>
    </div>

    <div class="screen-30 tablet-40 phone-100">
      <div class="padded-30">
        <h4>What is a bill</h4>
        <p>A Bill is a proposal for a new law, or a proposal to change an existing law that is presented for debate before Parliament.</p>
        <p>Bills are introduced in Parliament as Public Bills by either sitting MPs (Private Member's Bill) or representatives of Government (Government Bill) for examination, discussion and amendment.</p>
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
      <h2><?php echo $billrow->title;?></h2>
      <div>This is a <strong><?php echo getBillType($billrow->bill_type);?></strong> introduced on <strong><?php echo Filter::dodate("short_date", $billrow->date_introduced);?></strong></div>
      <div class="corporato divider"></div>
      <div><?php echo cleanOut($billrow->description);?></div>
    </div>
      
    <div class="screen-30 tablet-40 phone-100">
      <div class="padded-30 pull-right">
        <button type="submitfollow" class="corporato large black button">Follow this bill for updates</button>
      </div>
    </div>
  </div>
</div>  

<?php endif;?>

</div>

<?php include("footer.tpl.php");?>