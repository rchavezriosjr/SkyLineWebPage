<?php

/*------------------------------------------------------------------------
# JD visitor
# ------------------------------------------------------------------------
# author                Md. Shaon Bahadur
# copyright             Copyright (C) 2014 j-download.com. All Rights Reserved.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');


class PlgSystemJdvisitor extends JPlugin
{
	public function PlgSystemJdvisitor(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}

	public function onAfterRender()
	{
		$app = JFactory::getApplication();

		if ($app->isSite())
		{
    		$dbo        =   JFactory::getDBO();
    		$query      =   'SELECT ip FROM #__jdvisitor WHERE ip="'.$this->get_client_ip().'"';
    		$dbo->setQuery($query);
    		$ipexist    =   $dbo->loadObject();

            if(!$ipexist->ip){
        		$queryinsert      =   'INSERT INTO #__jdvisitor(id,ip) VALUES("","'.$this->get_client_ip().'")';
        		$dbo->setQuery($queryinsert);
        		$dbo->loadObject();
            }
		}
	}

    function get_client_ip()
     {
          $ipaddress = '';
          if (getenv('HTTP_CLIENT_IP'))
              $ipaddress = getenv('HTTP_CLIENT_IP');
          else if(getenv('HTTP_X_FORWARDED_FOR'))
              $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
          else if(getenv('HTTP_X_FORWARDED'))
              $ipaddress = getenv('HTTP_X_FORWARDED');
          else if(getenv('HTTP_FORWARDED_FOR'))
              $ipaddress = getenv('HTTP_FORWARDED_FOR');
          else if(getenv('HTTP_FORWARDED'))
              $ipaddress = getenv('HTTP_FORWARDED');
          else if(getenv('REMOTE_ADDR'))
              $ipaddress = getenv('REMOTE_ADDR');
          else
              $ipaddress = 'UNKNOWN';

          return $ipaddress;
     }
}

?>