<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="top">

	
	<?php if ($this->checkSpotlight('top', 'top1, top2, top3, top4')) : ?>
	<!-- SPOTLIGHT 1 -->
	<div class="container t3-sl t3-sl-1">
		<?php $this->spotlight('top', 'top1, top2, top3, top4') ?>
	</div>
	<!-- //SPOTLIGHT 1 -->
<?php endif ?>
	
