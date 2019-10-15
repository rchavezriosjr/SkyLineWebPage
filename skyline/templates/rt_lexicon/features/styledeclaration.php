<?php
/**
 * @version   $Id: styledeclaration.php 20006 2014-03-28 15:54:31Z arifin $
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright 	Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureStyleDeclaration extends GantryFeature {
    var $_feature_name = 'styledeclaration';

    function isEnabled() {
		global $gantry;
        $menu_enabled = $this->get('enabled');

        if (1 == (int)$menu_enabled) return true;
        return false;
    }

	function init() {
		global $gantry;
		$browser = $gantry->browser;

        // Logo
    	$css = $this->buildLogo();

        // Less Variables
    	$lessVariables = array(
            'logo-type'                 => $gantry->get('logo-type',                'preset1'),
            'logo-background'           => $gantry->get('logo-background',          '#1A1C1E'),

            'pagesurround-type'         => $gantry->get('pagesurround-type',        'preset1'),
            'pagesurround-background'   => $gantry->get('pagesurround-background',  '#CBD2D7'),

            'accent-color1'             => $gantry->get('accent-color1',            '#FDDD5A'),
            'accent-color2'             => $gantry->get('accent-color2',            '#262A2F'),

            'demostyle-type'            => $gantry->get('demostyle-type',           'preset1'),

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

        // Section Background Images
        $positions  = array('pagesurround-custompagesurround-image');
        $source     = "";

        foreach ($positions as $position) {
            $data = $gantry->get($position, false) ? json_decode(str_replace("'", '"', $gantry->get($position))) : false;
            if ($data) $source = $data->path;
            if (!preg_match('/^\//', $source)) $source = JURI::root(true).'/'.$source;
            $lessVariables[$position] = $data ? 'url(' . $source . ')' : 'none';
        }

        $gantry->addInlineStyle($css);

       	$gantry->addLess('global.less', 'master.css', 7, $lessVariables);

	    $this->_disableRokBoxForiPhone();

        if ($gantry->get('layout-mode')=="responsive") $gantry->addLess('mediaqueries.less', 'mediaqueries.css', 8, $lessVariables);
        if ($gantry->get('layout-mode')=="960fixed")   $gantry->addLess('960fixed.less');
        if ($gantry->get('layout-mode')=="1200fixed")  $gantry->addLess('1200fixed.less');

        // RTL
        if ($gantry->get('rtl-enabled')) $gantry->addLess('rtl.less', 'rtl.css', 8, $lessVariables);

        // Demo Styling
        if ($gantry->get('demo')) $gantry->addLess('demo.less', 'demo.css', 9, $lessVariables);

        // Third Party (k2)
        if ($gantry->get('k2')) $gantry->addLess('thirdparty-k2.less', 'thirdparty-k2.css', 10, $lessVariables);

        // Chart Script
        if ($gantry->get('chart-enabled')) $gantry->addScript('chart.js');
	}

    function buildLogo(){
		global $gantry;

        if ($gantry->get('logo-type')!="custom") return "";

        $source = $width = $height = "";

        $logo = str_replace("&quot;", '"', str_replace("'", '"', $gantry->get('logo-custom-image')));
        $data = json_decode($logo);

        if (!$data){
            if (strlen($logo)) $source = $logo;
            else return "";
        } else {
            $source = $data->path;
        }

        if (substr($gantry->baseUrl, 0, strlen($gantry->baseUrl)) == substr($source, 0, strlen($gantry->baseUrl))){
            $file = JPATH_ROOT . '/' . substr($source, strlen($gantry->baseUrl));
        } else {
            $file = JPATH_ROOT . '/' . $source;
        }

        if (isset($data->width) && isset($data->height)){
            $width = $data->width;
            $height = $data->height;
        } else {
            $size = @getimagesize($file);
            $width = $size[0];
            $height = $size[1];
        }

        if (!preg_match('/^\//', $source))
        {
            $source = JURI::root(true).'/'.$source;
        }

        $source = str_replace(' ', '%20', $source);

        $output = "";
        $output .= "#rt-logo {background: url(".$source.") 50% 0 no-repeat !important;}"."\n";
        $output .= "#rt-logo {width: ".$width."px;height: ".$height."px;}"."\n";

        $file = preg_replace('/\//i', DIRECTORY_SEPARATOR, $file);

        return (file_exists($file)) ?$output : '';
    }

	function _disableRokBoxForiPhone() {
		global $gantry;

		if ($gantry->browser->platform == 'iphone' || $gantry->browser->platform == 'android') {
			$gantry->addInlineScript("window.addEvent('domready', function() {\$\$('a[rel^=rokbox]').removeEvents('click');});");
		}
	}
}