<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if ($this->checkSpotlight('abovefooter', 'abovefooter1, abovefooter2, abovefooter3, abovefooter4')) : ?>
	<!-- SPOTLIGHT 2 -->
	<div class="container t3-sl t3-sl-2">
		<?php $this->spotlight('abovefooter', 'abovefooter1, abovefooter2, abovefooter3, abovefooter4') ?>
	</div>
	<!-- //SPOTLIGHT 2 -->
<?php endif ?>