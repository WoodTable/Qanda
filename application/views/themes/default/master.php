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

        <?php View::factory($theme_url.'header')->render(TRUE); ?>

        <?php echo $content; ?>
        
        <?php View::factory($theme_url.'footer')->render(TRUE); ?>

    </div><?php /* END #wrapper */ ?>
</body>
</html>