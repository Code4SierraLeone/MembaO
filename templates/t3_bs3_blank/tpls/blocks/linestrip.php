<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if ($this->countModules('linestrip')) : ?>
	<!-- linestrip HELPER -->
	<nav class="wrap t3-linestrip <?php $this->_c('linestrip') ?>">
		<div class="container">
			<jdoc:include type="modules" name="<?php $this->_p('linestrip') ?>" />
		</div>
	</nav>
	<!-- //linestrip HELPER -->
<?php endif ?>
