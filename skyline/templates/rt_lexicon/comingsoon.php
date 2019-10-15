<?php
/**
* @version   $Id: comingsoon.php 19980 2014-03-27 17:50:43Z arifin $
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

JHTML::_('behavior.framework', true);

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
$gantry->addLess('comingsoon.less', 'comingsoon.css', 4, $lessVariables);

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

// Simple Counter
$gantry->addScript('simplecounter.js');
$gantry->addInlineScript("
	window.addEvent('load', function(){
		var counter = new SimpleCounter(
			'rt-comingsoon-counter',
			/* Year (Full Year), Month (0 to 11), Day (1 to 31) */
			/* For example: Date(2016,10,1) means 1 November 2020 */
			new Date('".$gantry->get('comingsoon-year')."','".$gantry->get('comingsoon-month')."','".$gantry->get('comingsoon-date')."'),
			{lang : {
				d:{single:'".JText::_("DAY")."',plural:'".JText::_("DAYS")."'}, 		//days
				h:{single:'".JText::_("HOUR")."',plural:'".JText::_("HOURS")."'},     	//hours
				m:{single:'".JText::_("MINUTE")."',plural:'".JText::_("MINUTES")."'}, 	//minutes
				s:{single:'".JText::_("SECOND")."',plural:'".JText::_("SECONDS")."'} 	//seconds
			}
		});
	});
");

ob_start();
?>
<body id="rt-comingsoon" <?php echo $gantry->displayBodyTag(); ?>>
	<div id="rt-page-surround">
		<header id="rt-header-surround">
			<div class="rt-overlay">
				<div class="rt-comingsoon-body">
					<div class="rt-logo-block rt-comingsoon-logo">
					    <a id="rt-logo" href="<?php echo $gantry->baseUrl; ?>"></a>
					</div>

					<?php
						$msgs = $app->getMessageQueue();
					?>
					<?php if (sizeof($msgs) > 0) : ?>
						<div class="rt-container">
							<jdoc:include type="message" />
							<div class="clear"></div>
						</div>
					<?php endif; ?>

					<div class="rt-comingsoon-title rt-big-title rt-center">
						<div class="module-title">
							<h2 class="title"><?php echo JText::_("RT_COMINGSOON_TITLE"); ?></h2>
						</div>
					</div>

					<p class="rt-comingsoon-message">
						<?php echo JText::_("RT_COMINGSOON_MESSAGE"); ?>
					</p>

					<div class="rt-counter-block">
						<div id="rt-comingsoon-counter"></div>
					</div>
				</div>
			</div>
		</header>
		<section id="rt-subscription-form">
			<div class="rt-container">
				<?php if ($gantry->get('email-subscription-enabled')) : ?>
					<p class="rt-subscription-title">
						<?php echo JText::_("RT_COMINGSOON_SUBSCRIPTION_TITLE"); ?>
					</p>
					<form class="rt-comingsoon-form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $gantry->get('feedburner-uri'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						<input type="text" placeholder="<?php echo JText::_('RT_EMAIL') ?>" class="inputbox" name="email">
						<input type="hidden" value="<?php echo $gantry->get('feedburner-uri'); ?>" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						<input type="submit" name="Submit" class="button" value="<?php echo JText::_('RT_SUBSCRIBE') ?>" />
					</form>
					<div class="clear"></div>
				<?php endif; ?>
			</div>
		</section>
		<section id="rt-authorized-form">
			<h2 class="rt-authorized-form-title"><?php echo JText::_("AUTHORIZED_LOGIN"); ?></h2>

			<p class="rt-authorized-login-message">
				<?php echo JText::_("RT_AUTHORIZED_LOGIN_MESSAGE"); ?>
			</p>

			<?php
		        $user    = JFactory::getUser();
		        $isAdmin = $user->get('isRoot');
			?>
			<?php if (!$isAdmin): ?>
				<form class="rt-authorized-login-form" action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="rt-form-login">
					<input name="username" id="username" class="inputbox" type="text" placeholder="<?php echo JText::_('JGLOBAL_USERNAME') ?>" />
					<input type="password" name="password" class="inputbox" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />

					<?php
				        $version = new JVersion;
				        $joomla  = $version->getShortVersion();

				        $joomla3 = substr($joomla,0,1) == '3';

				        if($joomla3) {
							function getTwoFactorMethods()
							{
								require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';
								return UsersHelper::getTwoFactorMethods();
							}
							$twofactormethods = getTwoFactorMethods();
						}
					?>

					<?php if ( $joomla3 and (count($twofactormethods) > 1)): ?>
						<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="inputbox rt-secretkey-input" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
						<span class="rt-secretkey-help" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
							<span class="icon-help"></span>
						</span>
					<?php endif; ?>

					<input type="hidden" name="remember" class="inputbox" value="yes" id="remember" />
					<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="user.login" />
					<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
					<?php echo JHtml::_('form.token'); ?>
				</form>
			<?php endif; ?>
			<?php if ($isAdmin): ?>
				<form class="rt-authorized-login-form" action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="rt-form-login">
					<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGOUT'); ?>" />
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="user.logout" />
					<input type="hidden" name="return" value="<?php echo $return; ?>" />
					<?php echo JHtml::_('form.token'); ?>
				</form>
			<?php endif; ?>
		</section>
		<footer id="rt-footer-surround">
			<div class="rt-footer-surround-pattern">
				<div id="rt-copyright">
					<div class="rt-container">
						<?php echo $gantry->displayModules('copyright','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</footer>
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