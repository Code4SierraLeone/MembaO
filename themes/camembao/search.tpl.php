<?php
  /**
   * Search
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

  <div class="corporato-grid">
    <div class="columns horizontal-gutters">
      <div class="screen-100 tablet-100 phone-100">
        
        <div class="corporato basic message itemheader">
          <h2>Search results</h2>
          <div class="corporato divider"></div>
          <p>These are results for <strong><?php echo $keyword;?></strong></p>
        </div>
        
        <?php if (!$keyword || strlen($row = trim($keyword)) == 0):?>
        <?php echo Filter::msgSingleAlert(Lang::$word->FSRC_ERR1);?>
        <?php elseif(!$searchrow):?>
        <?php Filter::msgSingleAlert(str_replace("WORD", $keyword, Lang::$word->FSRC_ERR2));?>
        <?php else:?>
          <?php if($searchrow): $html = '';?>
          <div id="listview">
            <?php foreach($searchrow as $row):
              if($row->type == 'leader'):         
                $link = ($core->seo == 1) ? SITEURL . '/leaders/' . $row->slug . '/' : SITEURL . '/item.php?leadername=' . $row->slug;
                $html .= '<a href="' . $link . '">' . $row->name . '</a>';
              elseif ($row->type == 'bill'):
                $link = ($core->seo == 1) ? SITEURL . '/bills/' . $row->slug . '/' : SITEURL . '/item.php?billname=' . $row->slug;
                $html .= '<a href="' . $link . '">' . $row->name . '</a>';
              elseif ($row->type == 'committee'):
                $link = ($core->seo == 1) ? SITEURL . '/committees/' . $row->slug . '/' : SITEURL . '/item.php?committeename=' . $row->slug;
                $html .= '<a href="' . $link . '">' . $row->name . '</a>';
              elseif ($row->type == 'meeting'):
                $link = ($core->seo == 1) ? SITEURL . '/meetings/' . $row->slug . '/' : SITEURL . '/item.php?meetingname=' . $row->slug;
                $html .= '<a href="' . $link . '">' . $row->name . '</a>';  
              endif;
            ?>

            <?php ?>
            <section class="listmode">
              
              <div class="inner">
                <div class="corporato tabular segment">              
                    <div class="description">
                      <a href="<?php echo $link;?>"><div class="title"><?php echo $row->name;?><span class="smallest-box"><?php echo $row->type;?></span></div></a>
                    </div>
                </div>
              </div>

            </section>
          <?php endforeach;?>
          </div> 
          <?php endif;?>
        <?php endif;?>
        <!-- End search trix/--> 
      </div>
    </div>
  </div>
</div>  
<?php include("footer.tpl.php");?>