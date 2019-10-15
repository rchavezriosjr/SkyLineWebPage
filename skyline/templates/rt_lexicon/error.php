<?php
/**
* @version   $Id: error.php 19979 2014-03-27 17:40:54Z arifin $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

// Load and Inititialize Gantry Class
require_once(dirname(__FILE__) . '/lib/gantry/gantry.php');
$gantry->init();

$doc = JFactory::getDocument();
$app = JFactory::getApplication();

// Less Variables
$lessVariables = array(
    'logo-type'                 => $gantry->get('logo-type',                'preset1'),
    'logo-background'           => $gantry->get('logo-background',          '#1A1C1E'),

    'pagesurround-type'         => $gantry->get('pagesurround-type',        'preset1'),
    'pagesurround-background'   => $gantry->get('pagesurround-background',  '#CBD2D7'),

    'accent-color1'             => $gantry->get('accent-color1',            '#FDDD5A'),
    'accent-color2'             => $gantry->get('accent-color2',            '#262A2F'),

    'header-textcolor'          => $gantry->get('header-textcolor',         '#808080'),
    'header-background'         => $gantry->get('header-background',        '#FFFFFF'),

    'showcase-textcolor'        => $gantry->get('showcase-textcolor',       '#7D6A1E'),
    'showcase-background'       => $gantry->get('showcase-background',      '#FDDD5A'),

    'mainbody-overlay'          => $gantry->get('mainbody-overlay',         'light'),
    'mainbody-textcolor'        => $gantry->get('mainbody-textcolor',       '#282828'),
    'mainbody-background'       => $gantry->get('mainbody-background',      '#FFFFFF'),

    'bottom-textcolor'          => $gantry->get('bottom-textcolor',         '#808080'),
    'bottom-background'         => $gantry->get('bottom-background',        'transparent'),

    'footer-textcolor'          => $gantry->get('footer-textcolor',         '#808080'),
    'footer-background'         => $gantry->get('footer-background',        'transparent'),

    'copyright-textcolor'       => $gantry->get('copyright-textcolor',      '#808080'),
    'copyright-background'      => $gantry->get('copyright-background',     'transparent')
);

$gantry->addStyle('grid-responsive.css', 5);
$gantry->addLess('bootstrap.less', 'bootstrap.css', 6);
$gantry->addLess('error.less', 'error.css', 4, $lessVariables);

// Scripts
if ($gantry->browser->name == 'ie'){
	if ($gantry->browser->shortversion == 8){
		$gantry->addScript('html5shim.js');
		$gantry->addScript('placeholder-ie.js');
	}
	if ($gantry->browser->shortversion == 9){
		$gantry->addInlineScript("if (typeof RokMediaQueries !== 'undefined') window.addEvent('domready', function(){ RokMediaQueries._fireEvent(RokMediaQueries.getQuery()); });");
		$gantry->addScript('placeholder-ie.js');
	}
}
if ($gantry->get('layout-mode', 'responsive') == 'responsive') $gantry->addScript('rokmediaqueries.js');

ob_start();
?>
<body <?php echo $gantry->displayBodyTag(); ?>>
	<div id="rt-page-surround">
		<?php /** Begin Header Surround **/ ?>
		<header id="rt-header-surround">
			<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
			<div id="rt-header" class="<?php if ($gantry->get('header-overlay')!='') : ?><?php echo 'rt-overlay-'.$gantry->get('header-overlay'); ?><?php endif; ?>">
				<div class="rt-container">
					<?php echo $gantry->displayModules('header','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Header **/ endif; ?>
		</header>
		<?php /** End Header Surround **/ ?>

		<?php /** Begin Showcase Section **/ ?>
		<section id="rt-showcase-surround">
			<?php /** Begin Showcase **/ ?>
			<div id="rt-showcase" class="<?php if ($gantry->get('showcase-overlay')!='') : ?><?php echo 'rt-overlay-'.$gantry->get('showcase-overlay'); ?><?php endif; ?>">
				<div class="rt-container">
					<div class="rt-error-header">
						<div class="rt-error-code"><?php echo $this->error->getCode(); ?></div>
						<div class="rt-error-code-desc"><?php echo $this->error->getMessage(); ?></div>
					</div>
					<div class="rt-error-content">
						<div class="rt-error-title"><?php echo JText::_("RT_ERROR_TITLE"); ?></div>
						<div class="rt-error-message"><?php echo JText::_("RT_ERROR_MESSAGE"); ?></div>
						<div class="rt-error-button"><a href="<?php echo $gantry->baseUrl; ?>" class="readon"><span><?php echo JText::_("RT_ERROR_HOME"); ?></span></a></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Showcase **/ ?>
		</section>
		<?php /** End Showcase Section **/ ?>

		<?php /** Begin Footer Section **/ ?>
		<footer id="rt-footer-surround">
			<div class="rt-footer-surround-pattern">
				<?php /** Begin Copyright **/ ?>
				<div id="rt-copyright">
					<div class="rt-container">
						<?php echo $gantry->displayModules('copyright','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Copyright **/ ?>
			</div>
		</footer>
		<?php /** End Footer Surround **/ ?>
	</div>
</body>
</html>
<?php

$body = ob_get_clean();
$gantry->finalize();

require_once(JPATH_LIBRARIES.'/joomla/document/html/renderer/head.php');
$header_renderer = new JDocumentRendererHead($doc);
$header_contents = $header_renderer->render(null);
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<?php echo $header_contents; ?>
	<?php if ($gantry->get('layout-mode') == '960fixed') : ?>
	<meta name="viewport" content="width=960px">
	<?php elseif ($gantry->get('layout-mode') == '1200fixed') : ?>
	<meta name="viewport" content="width=1200px">
	<?php else : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php endif; ?>
</head>
<?php
$header = ob_get_clean();
echo $header.$body;