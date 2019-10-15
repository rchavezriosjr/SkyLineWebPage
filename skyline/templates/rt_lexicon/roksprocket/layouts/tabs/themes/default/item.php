<?php
/**
 * @version   $Id: item.php 19816 2014-03-20 18:34:07Z arifin $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/**
 * @var $item RokSprocket_Item
 * @var $parameters RokCommon_Registry
 */
?>
<div class="sprocket-tabs-panel" data-tabs-panel>
	<div class="sprocket-tabs-content">
		<?php echo $item->getText(); ?>
		<?php if ($item->getPrimaryLink()) : ?>
		<a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>" class="readon"><span><?php rc_e('READ_MORE'); ?></span></a>
		<?php endif; ?>
	</div>
</div>
