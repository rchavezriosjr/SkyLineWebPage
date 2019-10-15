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
 defined( '_JEXEC' ) or die(); $i = 0; ?>

<div itemscope="itemscope" itemtype="http://schema.org/Article">



<?php if ( $this->params->get( 'show_page_heading', false ) && $this->params->get( 'page_heading', false ) ) : ?>

<h1 itemprop="name"><?php
 echo htmlspecialchars( $this->params->get( 'page_heading', '' ) ); ?></h1>

<?php endif; ?>


<div class="aimysitemap<?php
 echo htmlspecialchars( $this->params->get( 'pageclass_sfx', '' ) ); ?>" itemprop="articleBody">

<?php if ( $this->variant == 'index' ) : ?>

<div id="aimysitemap-index">

    <?php foreach ( array_keys( $this->data ) as $i => $key ) : ?>

    <?php if ( $i % 3 == 0 ) echo '<div class="row-fluid">'; ?>

    <div class="span4">

    <h2><?php echo $key; ?></h2>

    <ul>
        <?php foreach ( $this->data[ $key ] as $item ) : ?>
        <li><a href="<?php
 echo $item->href; ?>" title="<?php
 echo $item->href; ?>"><?php
 echo $item->title; ?></a></li>
        <?php endforeach; ?>
    </ul>

    </div><!-- /.span4 -->

    <?php if ( $i % 3 == 2 ) echo '</div><!-- /.row-fluid -->'; ?>

    <?php endforeach; ?>

    <?php if ( $i == 0 or $i % 3 != 2 ) echo '</div><!-- /.row-fluid -->'; ?>

</div><!-- /#aimysitemap-index -->

<?php elseif ( $this->variant == 'hierarchy' ) : ?>

<div id="aimysitemap-hierarchy">

    <?php
 $this->data->render( function ( $ctx, $lvl ) { echo ( $ctx == 'open' ? '<ul class="aimysitemap-lvl-' . $lvl . '">' : '</ul>' ); }, function ( $ctx, $lvl, &$item ) { if ( $ctx == 'close' ) { echo '</li>'; return; } echo '<li>', '<a href="', $item->href, '" ', 'title="', $item->href, '"', ( $item->lang !== '*' ? ' class="aimysitemap-lang-' . strtolower($item->lang) . '"' : '' ), '>', $item->title, '</a>'; } ); ?>


</div><!-- /#aimysitemap-hierarchy -->

<?php elseif ( $this->variant == 'priority' ) : ?>

<div id="aimysitemap-priority">

    <ul>
    <?php foreach ( array_values( $this->data ) as $item ) : ?>
        <li><a href="<?php
 echo $item->href; ?>" title="<?php
 echo $item->href; ?>"><?php
 echo $item->title; ?></a></li>
    <?php endforeach; ?>
    </ul>

</div><!-- /#aimysitemap-priority -->

<?php else : ?>

<div id="aimysitemap-list">

    <ul>
    <?php foreach ( array_values( $this->data ) as $item ) : ?>
        <li><a href="<?php
 echo $item->href; ?>" title="<?php
 echo $item->href; ?>"><?php
 echo $item->title; ?></a></li>
    <?php endforeach; ?>
    </ul>

</div><!-- /#aimysitemap-list -->

<?php endif; ?>

</div>
</div>

<?php
 
