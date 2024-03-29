<?php
/**
 * RokAjaxSearch Module
 *
 * @package RocketTheme
 * @subpackage rokajaxsearch
 * @version   2.0.6 August 10, 2018
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 *
 * Inspired on PixSearch Joomla! module by Henrik Hussfelt <henrik@pixpro.net>
 */

defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__) . '/helper.php');
$helper = new modRokajaxsearchHelper();
$helper->inizialize($params->get('include_css'), $params->get('offset_search_result'), $params);

require(JModuleHelper::getLayoutPath('mod_rokajaxsearch'));