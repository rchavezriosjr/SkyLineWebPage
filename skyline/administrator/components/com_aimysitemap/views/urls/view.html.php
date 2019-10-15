<?php
/*
 * Copyright (c) 2017-2019 Aimy Extensions, Netzum Sorglos Software GmbH
 * Copyright (c) 2014-2017 Aimy Extensions, Lingua-Systems Software GmbH
 *
 * https://www.aimy-extensions.com/
 *
 * License: GNU GPLv2, see LICENSE.txt within distribution and/or
 *          https://www.aimy-extensions.com/software-license.html
 */
 defined( '_JEXEC' ) or die(); require_once( JPATH_COMPONENT . '/helpers/rights.php' ); require_once( JPATH_COMPONENT . '/helpers/compat.php' ); class AimySitemapViewUrls extends JViewLegacy { protected $items = null; protected $state = null; protected $pagination = null; protected $allow_config = false; protected $allow_edit = false; protected $allow_write = false; public function display( $tpl = null ) { $this->items = $this->get( 'Items' ); $this->state = $this->get( 'State' ); $this->pagination = $this->get( 'Pagination' ); $errors = $this->get( 'Errors' ); if ( is_array( $errors ) && count( $errors ) ) { JError::raiseError( 500, implode( "\n", $errors ) ); return false; } $rights = AimySitemapRightsHelper::getRights(); $this->allow_config = $rights->get( 'core.admin' ); $this->allow_edit = $rights->get( 'core.edit' ); $this->allow_write = $rights->get( 'aimysitemap.write' ); JFactory::getDocument()->addScript( JURI::root( true ) . '/media/com_aimysitemap/' . 'urls-ajax-edit.js?r=25.0' ); $this->add_toolbar(); parent::display( $tpl ); } protected function add_toolbar() { $bar = JToolBar::getInstance( 'toolbar' ); JToolBarHelper::title( JText::_( 'AIMY_SM_MANAGE_URLS' ), '' ); if ( $this->allow_edit ) { JToolBarHelper::editList( 'url.edit' ); JToolBarHelper::custom( 'urls.activate', 'publish', JText::_( 'AIMY_SM_ACTIVATE_DSC' ), JText::_( 'AIMY_SM_ACTIVATE_LBL' ), true ); JToolBarHelper::custom( 'urls.deactivate', 'unpublish', JText::_( 'AIMY_SM_DEACTIVATE_DSC' ), JText::_( 'AIMY_SM_DEACTIVATE_LBL' ), true ); } if ( $this->allow_write ) { JToolBarHelper::custom( 'urls.write', 'file', JText::_( 'AIMY_SM_WRITE_DSC' ), JText::_( 'AIMY_SM_WRITE_LBL' ), false ); } if ( $this->allow_edit ) { JToolBarHelper::trash( 'urls.reset_index', JText::_( 'AIMY_SM_RESET_INDEX_LBL' ), false ); } if ( $this->allow_config ) { JToolBarHelper::preferences( 'com_aimysitemap' ); } } public function get_state_options( $add_select = false ) { $r = array(); if ( $add_select ) { $r[] = JHtml::_( 'select.option', '', '- ' . JText::_( 'AIMY_SM_FILTER_SELECT_STATE' ) . ' -' ); } $r[] = JHtml::_( 'select.option', 1, JText::_( 'AIMY_SM_FILTER_ACTIVATED' ) ); $r[] = JHtml::_( 'select.option', 0, JText::_( 'AIMY_SM_FILTER_DEACTIVATED' ) ); $r[] = JHtml::_( 'select.option', '*', JText::_( 'JALL' ) ); return $r; } public function get_changefreq_options() { return array( JHtml::_( 'select.option', 'always', JText::_( 'AIMY_SM_CF_ALWAYS' ) ), JHtml::_( 'select.option', 'hourly', JText::_( 'AIMY_SM_CF_HOURLY' ) ), JHtml::_( 'select.option', 'daily', JText::_( 'AIMY_SM_CF_DAILY' ) ), JHtml::_( 'select.option', 'weekly', JText::_( 'AIMY_SM_CF_WEEKLY' ) ), JHtml::_( 'select.option', 'monthly', JText::_( 'AIMY_SM_CF_MONTHLY' ) ), JHtml::_( 'select.option', 'yearly', JText::_( 'AIMY_SM_CF_YEARLY' ) ), JHtml::_( 'select.option', 'never', JText::_( 'AIMY_SM_CF_NEVER' ) ) ); } public function get_priority_options() { return array( JHtml::_( 'select.option', '0.1', '0.1' ), JHtml::_( 'select.option', '0.2', '0.2' ), JHtml::_( 'select.option', '0.3', '0.3' ), JHtml::_( 'select.option', '0.4', '0.4' ), JHtml::_( 'select.option', '0.5', '0.5' ), JHtml::_( 'select.option', '0.6', '0.6' ), JHtml::_( 'select.option', '0.7', '0.7' ), JHtml::_( 'select.option', '0.8', '0.8' ), JHtml::_( 'select.option', '0.9', '0.9' ), JHtml::_( 'select.option', '1.0', '1.0' ) ); } } 