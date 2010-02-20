<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* Question Details Partial View
*
* @since 1.0.0
* @package Qanda
* @subpackage View
*/
?>
        <div id="content">
            
            <div class="main-bar">

                <div class="subheader">
                    <h2><?php echo html::anchor('/questions/detail/'.$question->id.'/'.$question->slug, $question->title); ?></h2>
                </div>


                <div id="question-<?php echo $question->id; ?>" class="post-detail question clearfix">
                    <div class="panel">
                        <div class="up-vote">
                            <?php echo html::anchor('#', 'Up'); ?>
                        </div>
                        <div class="score">
                            <?php echo $question->up_vote_count - $question->down_vote_count; ?>
                        </div>
                        <div class="down-vote">
                            <?php echo html::anchor('#', 'Down'); ?>
                        </div>
                        <div class="favorite">
                            <?php echo html::anchor('#', 'Fav'); ?>
                            <br/>
                            <?php echo $question->favorite_count; ?>
                        </div>
                    </div><?php /* END .panel */ ?>

                    <div class="detail">
                        <div class="content">
                            <?php echo $question->content; ?>
                        </div>
                        
                        <ul class="tags clearfix">
                            <?php foreach($question->tags as $index => $tag): ?>
                                <li class="tag">
                                    <?php echo html::anchor('questions/tagged/'.$tag->slug, $tag->name, array('rel'=>'tag')); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="user-summary clearfix">
                            <div class="avatar">
                                <a href="<?php echo url::site('users/detail/'.$question->user->id); ?>">
                                    <img src="<?php echo html::specialchars('http://www.gravatar.com/avatar/123456?s=32&d=identicon&r=PG'); ?>" width="32" height="32" alt="" />
                                </a>
                            </div>
                            <div class="user-details">
                                <a href="<?php echo url::site('users/detail/'.$question->user->id); ?>">
                                    <?php echo $question->user->username; ?>
                                </a>
                                <br/>
                                R:<?php echo $question->user->reputation_score; ?> | B:<?php echo $question->user->badge_count; ?>
                            </div>
                        </div>

                        <div class="meta">
                            <span><?php echo html::anchor('#', 'mod'); ?></span>
                            | <span><?php echo html::anchor('#', 'edit'); ?></span>
                            | <span><?php echo html::anchor('#', 'close'); ?></span>
                            | <span><?php echo html::anchor('#', 'delete'); ?></span>
                            | <span><?php echo html::anchor('#', 'flag'); ?></span>
                        </div>

                    </div><?php /* END .detail */ ?>

                    <?php /* TODO: Question Comments */ ?>
                    
                </div><?php /* END .post-detail */ ?>


                <div id="answers-to-<?php echo $question->id; ?>" class="answers-list">

                    <div class="subheader">
                        <h2><?php echo count($answers).' '.inflector::plural('answer', count($answers)); ?></h2>
                    </div>

                    <?php foreach($answers as $index => $answer): ?>
                        <div id="answer-<?php echo $answer->id; ?>" class="post-detail answer clearfix">

                            <div class="panel">
                                <div class="up-vote">
                                    <?php echo html::anchor('#', 'Up'); ?>
                                </div>
                                <div class="score">
                                    <?php echo $answer->up_vote_count - $answer->down_vote_count; ?>
                                </div>
                                <div class="down-vote">
                                    <?php echo html::anchor('#', 'Down'); ?>
                                </div>
                                <div class="favorite">
                                    <?php echo html::anchor('#', 'Fav'); ?>
                                    <br/>
                                    <?php echo $answer->favorite_count; ?>
                                </div>
                            </div><?php /* END .panel */ ?>


                            <div class="detail">
                                <div class="content">
                                    <?php echo $answer->content; ?>
                                </div>

                                <ul class="tags clearfix">
                                    <?php foreach($answer->tags as $index => $tag): ?>
                                        <li class="tag">
                                            <?php echo html::anchor('questions/tagged/'.$tag->slug, $tag->name, array('rel'=>'tag')); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <div class="user-summary clearfix">
                                    <div class="avatar">
                                        <a href="<?php echo url::site('users/detail/'.$answer->user->id); ?>">
                                            <img src="<?php echo html::specialchars('http://www.gravatar.com/avatar/123456?s=32&d=identicon&r=PG'); ?>" width="32" height="32" alt="" />
                                        </a>
                                    </div>
                                    <div class="user-details">
                                        <a href="<?php echo url::site('users/detail/'.$answer->user->id); ?>">
                                            <?php echo $answer->user->username; ?>
                                        </a>
                                        <br/>
                                        R:<?php echo $answer->user->reputation_score; ?> | B:<?php echo $answer->user->badge_count; ?>
                                    </div>
                                </div>

                                <div class="meta">
                                    <span><?php echo html::anchor('#', 'mod'); ?></span>
                                    | <span><?php echo html::anchor('#', 'edit'); ?></span>
                                    | <span><?php echo html::anchor('#', 'close'); ?></span>
                                    | <span><?php echo html::anchor('#', 'delete'); ?></span>
                                    | <span><?php echo html::anchor('#', 'flag'); ?></span>
                                </div>

                            </div><?php /* END .detail */ ?>

                            <?php /* TODO: Question Comments */ ?>

                        </div><?php /* END .post-detail */ ?>

                    <?php endforeach; ?>
                </div><?php /* END .answers-list */ ?>

                
                <h2>Answer this Question</h2>
                <?php
                    $form                       = View::factory($theme_url.'partials/post_form');
                    $form->form_class           = 'answer-question';
                    $form->form_method          = 'post';
                    $form->enable_post_title    = FALSE;
                    $form->enable_post_tags     = FALSE;
                    $form->submit_label         = 'Post Answer';
                    $form->render(TRUE);
                ?>


            </div><?php /* END #main-bar */ ?>

            <?php View::factory($theme_url.'sidebar')->render(TRUE); ?>

            <div class="clearfix"></div>

        </div><?php /* END #content */ ?>