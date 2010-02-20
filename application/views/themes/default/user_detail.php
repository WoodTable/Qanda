<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* User Detail Partial View
*
* @since 1.0.0
* @package Qanda
* @subpackage View
*/
?>
        <div id="content">

            <div class="main-bar no-sidebar">

                <div class="subheader">
                    <h2><?php echo $user->display_name; ?></h2>
                </div>

                <div class="vcard clearfix">
                    <div class="meta">
                        <div class="avatar">
                            <img src="<?php echo html::specialchars('http://www.gravatar.com/avatar/123456?s=128&d=identicon&r=PG'); ?>" width="128" height="128" alt="" />
                        </div>
                        <div class="reputation">
                            <span class="value"><?php echo $user->reputation_score; ?></span>
                            <br/><span class="label">reputation</span>
                        </div>
                        <div class="view-count">
                            <?php echo count($user->profile_view_count).' '.inflector::plural('view', count($user->profile_view_count)); ?>
                        </div>
                    </div>

                    <div class="summary">
                        <h3>Registered User</h3>
                        <div class="name clearfix">
                            <div class="label">Display Name:</div>
                            <div class="value"><?php echo $user->display_name; ?></div>
                        </div>
                        <div class="email clearfix">
                            <div class="label">Email:</div>
                            <div class="value"><?php echo $user->email; ?></div>
                        </div>
                        <div class="birthday clearfix">
                            <div class="label">Birthday:</div>
                            <div class="value"><?php echo $user->birthday; ?></div>
                        </div>
                        <div class="location clearfix">
                            <div class="label">Location:</div>
                            <div class="value"><?php echo $user->location; ?></div>
                        </div>
                        <div class="website clearfix">
                            <div class="label">Website:</div>
                            <div class="value"><?php echo $user->website; ?></div>
                        </div>
                    </div>
                    
                    <div class="description">
                        <?php echo $user->description; ?>
                    </div>

                </div><?php /* END .vcard */ ?>



            </div><?php /* END .main-bar */ ?>



        </div><?php /* END #content */ ?>