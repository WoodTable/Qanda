<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* Generic Footer Partial View
*
* @since 1.0.0
* @package Qanda
* @subpackage View
*/
?>
        <div id="footer">
        <div id="footer-inner">
            
            <p>
                Power by Qanda Q&amp;A.
                User contributed content licensed under <a href="#">cc-wiki</a> with <a href="#">attribution required</a>.
            </p>
            <p>
                Execution time: {execution_time} and Memory usage: {memory_usage}
                (Kohana Usage: <?php echo number_format((memory_get_peak_usage() - BASE_MEMORY_USAGE) / (1024*1024), 2).'MB'; ?>)
            </p>

        </div>
        </div><?php /* END #footer */ ?>