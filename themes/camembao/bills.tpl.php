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

<?php if (isset($allbills)):?>

<div class="corporato-grid grey">
  <div class="columns horizontal-gutters">
    <div class="screen-50 tablet-50 phone-100 white">
      <div class="clearfix">
        <h2>All bills</h2>      
      </div>
    
      <div class="corporato divider"></div>
      
      <div id="item-content" class="relative">
      <?php if($allbills):?>

        <div id="listview" class="clearfix relative">
        <?php foreach($allbills as $lrow):?>
          <?php $url = ($core->seo) ? SITEURL . '/bills/' . $lrow->slug . '/' : SITEURL . '/item.php?itemname=' . $lrow->slug;?>
          <section>                     
            <div class="inner"> 
              <a href="<?php echo $url;?>"><div class="title"><?php echo $lrow->title;?></div></a>
              <span class="date-label"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo Filter::dodate("short_date", $lrow->date_introduced);?></span> 
              <span class="committee-label"><i class="fa fa-user" aria-hidden="true"></i> <?php echo getBillType($lrow->bill_type);?></span>
            </div>
          </section>
        <?php endforeach;?>
        </div>
      <?php endif;?>
      </div>
      
      <div class="corporato divider"></div>
      <div class="corporato tabular segment pagi">
        <aside> <span class="corporato label"><?php echo 'Total number of bills: ' . $pager->items_total;?> / <?php echo 'Page ' . $pager->current_page . ' of ' . $pager->num_pages;?></span> </aside>
        <aside class="right"> <?php echo $pager->display_pages();?> </aside>
      </div>

    </div>

    <div class="screen-50 tablet-50 phone-100">
      <div class="padded-30">
        <h4>What is a Parliamentary Bill?</h4>
        <p><?php echo cleanOut($core->bills_description);?></p>
      </div>
    </div>

  </div> 
    
</div>

<?php else:?>
<div class="corporato-grid grey">  
  <div class="columns horizontal-gutters">
    <div class="screen-60 tablet-60 phone-100 white">
      <h2><?php echo $billrow->title;?></h2>
      <div>This is a <strong><?php echo getBillType($billrow->bill_type);?></strong> introduced on <strong><?php echo Filter::dodate("short_date", $billrow->date_introduced);?></strong></div>
      <div class="corporato divider"></div>
      <div><?php echo cleanOut($billrow->description);?></div>
    </div>
      
    <div class="screen-40 tablet-40 phone-100">
      <div class="padded-30">
        <h4>Bill particulars</h4>
        <ul class="bill-particulars">
          <li>Type of bill: <strong><?php echo getBillType($billrow->bill_type);?></strong></li>
          <li>Date introduced: <strong><?php echo Filter::dodate("short_date", $billrow->date_introduced);?></strong></li>
          <li>Mover: <strong>
            <?php if ($billrow->mover == 0):
                    echo "N/A"; 
                  else: 
                    $murl = ($core->seo) ? SITEURL . '/leaders/' . $billrow->mslug . '/' : SITEURL . '/leaders.php?leadername=' . $billrow->mslug;
                    echo "<a href='".$murl."'>".$billrow->movername."</a>";
                  endif;
            ?>              
            </strong></li>
          <li>Assigned to: <strong><?php 
            $curl = ($core->seo) ? SITEURL . '/committees/' . $billrow->cslug . '/' : SITEURL . '/committees.php?committeename=' . $billrow->cslug;
            echo "<a href='".$curl."'>".$billrow->committeename."</a>";
            ?>

            </strong></li>
        </ul>
      </div>

      <div>
        <h4>Bill history</h4>
        <?php if(!$billhistory):?>
        <div><?php echo Filter::msgSingleAlert("No bill history.");?></div>
        <?php else:?>
        <ul class="bill-particulars">
        <?php foreach ($billhistory as $bhrow):?>        
        <li><?php echo Filter::dodate("short_date", $bhrow->status_date);?>: <?php echo getBillStatus($bhrow->status);?> </li>
        <?php endforeach;?>
        <?php unset($bhrow);?>
        </ul>
        <?php endif;?>
      </div>

    </div>
  </div>
</div>  

<?php endif;?>

</div>

<?php include("footer.tpl.php");?>