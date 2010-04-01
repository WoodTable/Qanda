<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* Generic Master Page
*
* @since 1.0.0
* @package Qanda
* @subpackage View
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php echo $head; ?>
</head>

<body>
    <div id="wrapper">

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
                <li><?php echo html::anchor('/tags/browse', 'Tags'); ?></li>
                <li><?php echo html::anchor('/users/browse', 'Users'); ?></li>
                <li><?php echo html::anchor('/questions/unanswered', 'Unanswered'); ?></li>
                <li class="last"><?php echo html::anchor('/questions/ask', 'Ask Question'); ?></li>
            </ul>

            <div class="search-engine">
                <?php echo form::open('questions/search', array('class'=>'search_form', 'method'=>'post')); ?>
                    <?php echo form::label('query', 'Search:'); ?>
                    <?php echo form::input('query', ''); ?>
                    <?php echo form::submit('submit-search', 'Search'); ?>
                <?php echo form::close(); ?>
            </div>
        </div>
        </div><?php /* END #navigation */ ?>

        <?php echo $content; ?>
        
        <div id="footer">
        <div id="footer-inner">
            <p>
                Power by Qanda Q&amp;A.
                User contributed content licensed under <a href="#">cc-wiki</a> with <a href="#">attribution required</a>.
            </p>
            <p>
                Execution time: {execution_time} seconds and Memory usage: {memory_usage}
            </p>
        </div>
        </div><?php /* END #footer */ ?>

    </div><?php /* END #wrapper */ ?>
</body>
</html>