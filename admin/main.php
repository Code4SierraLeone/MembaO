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
	  
  $leaderrow = $leader->getLeaderList(); 

  $color = array("5AB1EF","B6A2DE","2EC7C9","D87A80","F5994E");
  $number = array(90,80,70,60,50);
?>
<div class="corporato basic segment">
  <div class="header"><span>Dashboard</span> </div>
  <div class="corporato segment">
    <div class="four columns small-gutters">
      <div class="row">
        <div class="corporato info message content-center">MPs on platform
          <p class="corporato big font"> <?php echo countEntries(Leaders::lTable);?></p>
        </div>
      </div>
      <div class="row">
        <div class="corporato warning message content-center">Number of committees
          <p class="corporato big font"> <?php echo countEntries(Committees::cTable);?></p>
        </div>
      </div>
      <div class="row">
        <div class="corporato success message content-center">Number of bills registered
          <p class="corporato big font"> <?php echo countEntries(Bills::bTable);?></p>
        </div>
      </div>
      <div class="row">
        <div class="corporato negative message content-center">Number of sittings
          <p class="corporato big font"> <?php echo countEntries(Leaders::scTable);?></p>
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
          <?php if($leaderrow):?>
          <?php foreach($leaderrow as $lrow):?>
          <option value="<?php echo $lrow->id;?>"><?php echo $lrow->name;?></option>
          <?php endforeach;?>
          <?php unset($lrow);?>
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
function getHitsChart(leader_id) {
    var pid = (leader_id > 0) ? 'id=' + leader_id : null;
    $.ajax({
        type: 'GET',
        url: 'controller.php?getLeaderStats=1',
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