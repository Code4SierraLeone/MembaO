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
  <div class="corporato divider"></div>
  <div class="corporato small form">
     <form id="corporato_form_s" name="corporato_form_s" action="<?php echo SITEURL;?>/search/" method="get">
                   
      <div class="field">          
        <button type="submitsearch" class="corporato large black button">Find political candidates</button>
      </div>
      
    </form>

    <div class="corporato-content home-lower">
      <div class="four columns horizontal-gutters">
        <div class="screen-25 tablet-25 phone-100 padded10">
          <div class="stat-title"><?php echo $attendanceperc;?><span class="smallest">%</span></div>
          <div class="stat-desc">Attendance of MPs in this parliament</div>
        </div>
    
        <div class="screen-25 tablet-25 phone-100 padded10">
          <div class="stat-title"><?php echo $attendanceperc;?><span class="smallest">%</span></div>
          <div class="stat-desc">Number of bills tabled by this parliament</div>
        </div>
    
        <div class="screen-25 tablet-25 phone-100 padded10">
          <div class="stat-title"><?php echo $attendanceperc;?><span class="smallest">%</span></div>
          <div class="stat-desc">Percentage of bills passed by this parliament</div>
        </div>
      
        <div class="screen-25 tablet-25 phone-100 padded10">
          <div class="stat-title"><?php echo $attendanceperc;?><span class="smallest">%</span></div>
          <div class="stat-desc">Percentage of independents <span class="small">/ presidential & parliamentary</span></div>
        </div>

      </div>
    </div>

  </div>
</div>