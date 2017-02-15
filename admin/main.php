<?php
  /**
   * Main
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  $prodrow = $leader->getLeaderList(); 

  $color = array("5AB1EF","B6A2DE","2EC7C9","D87A80","F5994E");
  $number = array(90,80,70,60,50);
?>
<div class="corporato basic segment">
  <div class="header"><span>Welcome to the admin section</span> </div>
  <div class="corporato segment">
    <div class="four columns small-gutters">
      <div class="row">
        <div class="corporato info message content-center"><?php echo Lang::$word->REGD . ' ' . Lang::$word->USERS;?>
          <p class="corporato big font"> <?php echo countEntries(Users::uTable);?></p>
        </div>
      </div>
      <div class="row">
        <div class="corporato warning message content-center"><?php echo Lang::$word->ACTIVE . ' ' . Lang::$word->USERS;?>
          <p class="corporato big font"> <?php echo countEntries(Users::uTable, "active", "y");?></p>
        </div>
      </div>
      <div class="row">
        <div class="corporato success message content-center"><?php echo Lang::$word->PENDING . ' ' . Lang::$word->USERS;?>
          <p class="corporato big font"> <?php echo countEntries(Users::uTable, "active", "t");?></p>
        </div>
      </div>
      <div class="row">
        <div class="corporato negative message content-center"><?php echo Lang::$word->BANNED . ' ' . Lang::$word->USERS;?>
          <p class="corporato big font"> <?php echo countEntries(Users::uTable, "active", "b");?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="corporato segment">
    <div class="two columns small-gutters">
      <div class="row">
        <div class="corporato huge pointing below label"><?php echo Lang::$word->ADM_SUB2;?> / <?php echo $core->year;?></div>
      </div>
      <div class="row">
        <select name="pid" onchange="getHitsChart(this.value)"  id="pfilter">
          <option value="0">--- Reset Leader  ---</option>
          <?php if($prodrow):?>
          <?php foreach($prodrow as $prow):?>
          <option value="<?php echo $prow->id;?>"><?php echo $prow->fullname;?></option>
          <?php endforeach;?>
          <?php unset($prow);?>
          <?php endif;?>
        </select>
      </div>
    </div>
  </div>
  <div id="chart" style="height:300px"></div>
</div>

<script type="text/javascript" src="../assets/jquery.flot.js"></script> 
<script type="text/javascript" src="../assets/flot.resize.js"></script> 
<script type="text/javascript" src="../assets/excanvas.min.js"></script> 
<script type="text/javascript">
// <![CDATA[
function getHitsChart(product_id) {
    var pid = (product_id > 0) ? 'id=' + product_id : null;
    $.ajax({
        type: 'GET',
        url: 'controller.php?getProductStats=1',
        dataType: 'json',
        data: pid,
        async: false,
        success: function (json) {
            var option = {
                lines: {
                    show: true,
					fill: true
                },
                points: {
                    show: true
                },
                xaxis: {
                    ticks: json.xaxis
                },
				grid: {
					hoverable: true,
					clickable: true,
					borderColor: {
						top: "rgba(0,0,0,0.1)",
						left: "rgba(0,0,0,0.1)"
					}
				},
            }
            $.plot($('#chart'), [json.hits, json.uhits], option);
        }
    });
}
getHitsChart($('#pfilter').val());
function showTooltip(x, y, contents) {
    $('<div id="tooltip" class="popover">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y + -50,
        left: x + -50,
        padding: '5px',
        opacity: 0.90
    }).appendTo("body").fadeIn(200);
}
var previousPoint = null;
$("#chart").on("plothover", function (event, pos, item) {
    if (item) {
        if (previousPoint != item.dataIndex) {
            previousPoint = item.dataIndex;
            $("#tooltip").remove();
            var x = item.datapoint[0],
                y = item.datapoint[1].toFixed(0);
            showTooltip(item.pageX, item.pageY,
            item.series.label + ":" + y);
        }
    } else {
        $("#tooltip").remove();
        previousPoint = null;
    }
});
$(document).ready(function () {
    $("[data-select-range]").on('click', '.item', function () {
        v = $("input[name=range]").val();
        getVisitsChart(v)
    });
	$('.roundchart').easyPieChart({easing: 'easeOutQuad'});
});
// ]]>
</script>