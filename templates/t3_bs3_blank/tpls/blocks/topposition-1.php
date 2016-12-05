<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if ($this->checkSpotlight('topposition-1', 'top-position-1, top-position-2, top-position-3, top-position-4')) : ?>
	<!-- topposition 1 -->
	<div class="container t3-sl t3-sl-1">
		<?php $this->spotlight('topposition-1', 'top-position-1, top-position-2, top-position-3, top-position-4') ?>
	</div>
	<!-- //topposition 1 -->
<?php endif ?>