<?php
/**
* @package Membao
* @author Alan Kawamara
* @copyright 2017
*/

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<div class="corporato secondary segment">
  <h4 class="corporato shadow header">Find Parliamentary Data</h4>
  <div class="corporato form">
     <form id="corporato_form_s" name="corporato_form_s" action="<?php echo SITEURL;?>/search/" method="get">                        

      <div class="field">
        <div class="corporato action input"> 
          <input name="search-home" type="text" placeholder="Search the Memba O database" id="seach-home" />
          <a type="submitsearch" class="corporato membao button">Find</a> </div>
      </div>
      
    </form>

    <div class="home-lower">
      <div class="four columns horizontal-gutters">
        <div class="screen-25 tablet-25 phone-100 padded10">
          <div class="stat-title"><span class="count"><?php echo $attendanceperc;?></span><span class="smallest pc">%</span></div>
          <div class="stat-desc">The average attendance for Parliamentary sittings</div>
        </div>
    
        <div class="screen-25 tablet-25 phone-100 padded10">
          <div class="stat-title"><span class="count"><?php echo $totalbills;?></span><span class="smallest"></span></div>
          <div class="stat-desc">Number of bills introduced during this parliament</div>
        </div>
    
        <div class="screen-25 tablet-25 phone-100 padded10">
          <div class="stat-title"><span class="count"><?php echo $totalbillspassed;?></span><span class="smallest"></span></div>
          <div class="stat-desc">Number of bills passed into law by this parliament</div>
        </div>
      
        <div class="screen-25 tablet-25 phone-100 padded10">
          <div class="stat-title"><span class="count"><?php echo $totalcommitteemeetings;?></span><span class="smallest"></span></div>
          <div class="stat-desc">Number of Committee hearings have been scheduled</div>
        </div>

      </div>
    </div>

  </div>
</div>

