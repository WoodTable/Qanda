<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* Generic Header Partial View
*
* @since 1.0.0
* @package Qanda
* @subpackage View
*/
?>
        <div id="header">
        <div id="header-inner" class="clearfix">
                
            <div class="logo">
                <h1>
                    <?php echo html::anchor('/', html::specialchars('Qanda Q&A Platform')); ?>
                </h1>
            </div>

        </div>
        </div><?php /* END #header */ ?>


        <div id="navigation">
        <div id="navigation-inner" class="clearfix">
            <ul class="clearfix">
                <li><?php echo html::anchor('/', 'Questions'); ?></li>
                <li><?php echo html::anchor('/tags', 'Tags'); ?></li>
                <li><?php echo html::anchor('/users', 'Users'); ?></li>
                <li><?php echo html::anchor('/badges', 'Badges'); ?></li>
                <li><?php echo html::anchor('/questions/unanswered', 'Unanswered'); ?></li>
                <li class="last"><?php echo html::anchor('/questions/ask', 'Ask Question'); ?></li>
            </ul>

            <div class="search-engine">
                <?php echo form::open('questions/search', array('class'=>'search_form', 'method'=>'get')); ?>
                    <?php echo form::label('search', 'Search:'); ?>
                    <?php echo form::input('search', ''); ?>
                    <?php echo form::submit('submit-search', 'Search'); ?>
                <?php echo form::close(); ?>
            </div>

        </div>
        </div><?php /* END #navigation */ ?>