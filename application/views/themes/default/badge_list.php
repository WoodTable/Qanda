<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* Badge List Partial View
*
* @since 1.0.0
* @package Qanda
* @subpackage View
*/
?>
        <div id="content">
            
            <div class="main-bar">

                <div class="subheader">
                    <h2>Badges</h2>
                </div>

                <div class="page-description">
                    <p>
                        Ask questions, provide answers, vote for the things you find helpful — and Stack Overflow will bestow badges upon you. Here's a list of all the badges, along with a count of how many users have earned each one so far:
                    </p>
                </div>

                <div class="badges-list">
                    <?php foreach($badges as $index => $badge): ?>
                        <div class="badge-summary clearfix">
                            <div class="item">
                                <?php echo html::anchor('users/badged/'.$badge->id.'/'.$badge->slug, $badge->name, array('class'=>'badge')); ?>
                                x <?php echo $badge->user_count; ?>
                            </div>
                            <div class="description">
                            <p>
                                <?php echo $badge->description; ?>
                            </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div><?php /* END .main-bar */ ?>

            
            <?php View::factory($theme_url.'sidebar')->render(TRUE); ?>

            <div class="clearfix"></div>

        </div><?php /* END #content */ ?>