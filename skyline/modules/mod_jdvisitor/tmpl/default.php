<?php

/*------------------------------------------------------------------------
# JD Visitor
# ------------------------------------------------------------------------
# author                Md. Shaon Bahadur
# copyright             Copyright (C) 2014 j-download.com. All Rights Reserved.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

    defined('_JEXEC') or die('Restricted access');
    $themeselect              	=       $params->get( 'themeselect', 0 );
    $customcss              	=       $params->get( 'customcss', 0 );
?>
    <link rel="stylesheet" type="text/css" href="modules/mod_jdvisitor/tmpl/css/jdvisitor_style.css" />
    <style>
        #jdvisitor .jdvisitor-theme-0{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_default.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-1{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_white.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-2{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_black-skyblue.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-3{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_gold-black.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-4{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_gray.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-5{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_black.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-6{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_pink.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-7{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_pink-light.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-8{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_digital.png") no-repeat;
        }
        #jdvisitor .jdvisitor-theme-9{
            background: url("<?php echo JURI::root(); ?>modules/mod_jdvisitor/tmpl/images/jdvisitor_red.png") no-repeat;
        }
        <?php echo $customcss; ?>
    </style>

    <div id="jdvisitor">
        <div class="jdvisitor">
		<?php
            $cntvalue=str_split($options[0]->TotalVisitor);
            for($i=0;$i<sizeof($cntvalue);$i++){
                echo '<span title="JD visitor" class="jdvisitor-'.$cntvalue[$i].' jdvisitor-theme-'.$themeselect.'">'.$cntvalue[$i].'</span>';
            }
        ?>
        </div>
    </div>