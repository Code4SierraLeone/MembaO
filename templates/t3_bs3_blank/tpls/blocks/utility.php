<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="utility">

	
	<?php if ($this->checkSpotlight('utility', 'utility1, utility2, utility3, utility4')) : ?>
	<!-- SPOTLIGHT 1 -->
	<div class="container t3-sl t3-sl-1">
		<?php $this->spotlight('utility', 'utility1, utility2, utility3, utility4') ?>
	</div>
	<!-- //SPOTLIGHT 1 -->
<?php endif ?>
	
