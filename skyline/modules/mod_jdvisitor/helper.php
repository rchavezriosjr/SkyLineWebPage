<?php
/*------------------------------------------------------------------------
# JD Visitor
# ------------------------------------------------------------------------
# author                Md. Shaon Bahadur
# copyright             Copyright (C) 2014 j-download.com. All Rights Reserved.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

class modJdvisitorHelper
{
	static function getJdvisitorOptions()
	{
		$db	    =   & JFactory::getDBO();

		$query = 'SELECT COUNT(DISTINCT ip) AS TotalVisitor FROM #__jdvisitor';
		$db->setQuery($query);

		if (!($options = $db->loadObjectList())) {
			echo "MD ".$db->stderr();
			return;
		}

		return $options;
	}
}
?>