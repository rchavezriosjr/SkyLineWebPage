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
 defined( '_JEXEC' ) or die(); class AimySitemapViewHtml extends JViewLegacy { protected $items = null; protected $data = null; protected $params = null; protected $merge = false; protected $filterlang = false; protected $variant = 'list'; static private $variants_ok = array( 'list', 'index' ); public function __construct( $options = null ) { $jin = JFactory::getApplication()->input; $v = $jin->get( 'variant', 'list', 'word' ); if ( in_array( $v, self::$variants_ok ) ) { $this->variant = $v; } $this->merge = $jin->get( 'prevent_duplicate_titles', true, 'bool' ); parent::__construct( $options ); $this->params = JFactory::getApplication()->getParams(); } public function display( $tpl = null ) { $this->items = $this->get( 'Items' ); $errors = $this->get( 'Errors' ); if ( is_array( $errors ) && count( $errors ) ) { JError::raiseError( 500, implode( "\n", $errors ) ); return false; } if ( $this->merge ) { $this->_merge_urls_by_title(); } switch ( $this->variant ) { case 'index': $this->data = $this->_build_index(); break; default: $this->data = $this->_build_list(); break; } $this->_prepare_document(); parent::display( $tpl ); } private function _prepare_document() { $app = JFactory::getApplication(); $doc = JFactory::getDocument(); $menu = $app->getMenu()->getActive(); if ( $menu && $this->params ) { $this->params->def( 'page_heading', $this->params->get( 'page_heading', $menu->title ) ); } $title = ''; if ( $this->params ) { $title = $this->params->get( 'page_title', '' ); } if ( empty( $title ) && ! empty( $menu ) ) { $title = $menu->title; } $title_pos = $this->get_config( 'sitename_pagetitles', 0 ); switch ( $title_pos ) { case 1: $doc->setTitle( JText::sprintf( 'JPAGETITLE', $this->get_config( 'sitename' ), $title ) ); break; case 2: $doc->setTitle( JText::sprintf( 'JPAGETITLE', $title, $this->get_config( 'sitename' ) ) ); } if ( $menu && $desc = $menu->params->get( 'menu-meta_description', false ) ) { $doc->setDescription( $desc ); } else if ( $desc = $this->get_config( 'MetaDesc', false ) ) { $doc->setDescription( $desc ); } if ( $menu && $kw = $menu->params->get( 'menu-meta_keywords', false ) ) { $doc->setMetadata( 'keywords', $kw ); } else if ( $kw = $this->get_config( 'MetaKeys' ) ) { $doc->setMetadata( 'keywords', $kw ); } if ( $menu && $rob = $menu->params->get( 'robots', false ) ) { $doc->setMetadata( 'robots', $rob ); } else if ( $rob = $this->get_config( 'robots', false ) ) { $doc->setMetadata( 'robots', $rob ); } else { $doc->setMetadata( 'robots', 'index, follow' ); } } private function _build_list() { usort( $this->items, 'self::sort_by_title' ); return $this->items; } private function _build_index() { $idx = array(); foreach ( $this->items as $item ) { $fc = strtoupper( mb_substr( $item->title, 0, 1 ) ); $idx[ $fc ][] = $item; } ksort( $idx ); foreach ( array_keys( $idx ) as $key ) { uasort( $idx[ $key ], 'self::sort_by_title' ); } return $idx; } private function _merge_urls_by_title() { $map = array(); foreach ( $this->items as $item ) { $t = $item->title; if ( ! isset( $map[ $item->title ] ) ) { $map[ $t ] = $item; } else { if ( strlen( $item->url ) < strlen( $map[ $t ]->url ) ) { $map[ $t ] = $item; } } } $this->items = array_values( $map ); } static private function sort_by_title( $a, $b ) { if ( ! is_object( $a ) or ! is_object( $b ) ) { return ( is_object( $a ) ? -255 : 255 ); } return strcasecmp( $a->title, $b->title ); } private function get_config( $key, $dflt = null ) { $app = JFactory::getApplication(); if ( version_compare( JVERSION, '3.3.0', '<' ) ) { return $app->getCfg( $key, $dflt ); } else { return $app->get( $key, $dflt ); } } } 