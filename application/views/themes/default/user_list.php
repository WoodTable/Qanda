<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* User List Partial View
*
* @since 1.0.0
* @package Qanda
* @subpackage View
*/
?>
        <div id="content">
            
            <div class="main-bar">

                <div class="subheader">
                    <h2>Users</h2>
                </div>

                <div class="users-list clearfix">
                    <?php foreach($users as $index => $user): ?>
                        <div class="user-summary clearfix">
                            <div class="avatar">
                                <a href="<?php echo url::site('users/detail/'.$user->username); ?>">
                                    <img src="<?php echo html::specialchars('http://www.gravatar.com/avatar/123456?s=32&d=identicon&r=PG'); ?>" width="32" height="32" alt="" />
                                </a>
                            </div>
                            <div class="user-details">
                                <a href="<?php echo url::site('users/detail/'.$user->username); ?>">
                                    <?php echo $user->username; ?>
                                </a>
                                <br/>
                                R:<?php echo $user->reputation_score; ?> | B:<?php echo $user->badge_count; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div><?php /* END .main-bar */ ?>

            
            <?php View::factory($theme_url.'sidebar')->render(TRUE); ?>

            <div class="clearfix"></div>

        </div><?php /* END #content */ ?>