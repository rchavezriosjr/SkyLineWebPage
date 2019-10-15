<?php

/*------------------------------------------------------------------------
# JD Visitor
# ------------------------------------------------------------------------
# author                Md. Shaon Bahadur
# copyright             Copyright (C) 2014 j-download.com. All Rights Reserved.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;
require_once dirname(__FILE__).'/helper.php';

    $layout = JModuleHelper::getLayoutPath('mod_jdvisitor');
    $options = modJdvisitorHelper::getJdvisitorOptions();

	require($layout);

?>