<?php
  /**
   * Footer
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<footer>
<div class="wojo-grid">
   Copyright &copy;<?php echo date('Y').' '.$core->site_name;?></div>
</footer>
<?php if($core->analytics):?>
<!-- Google Analytics --> 
<?php echo cleanOut($core->analytics);?> 
<!-- Google Analytics /-->
<?php endif;?>
<?php if(isset($_GET['msg'])):?>
<?php Core::downloadErrors();?>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
	var text = $("#showerror").html();
	new Messi(text, {
		title: "Error",
		modal: true
	});
});
// ]]>
</script>
<?php endif;?>
	</body>
</html>