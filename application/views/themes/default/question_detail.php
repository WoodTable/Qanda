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
                            <?php echo html::anchor('questions/vote_up/'.$question->id, 'Up'); ?>
                        </div>
                        <div class="score">
                            <?php echo $question->up_vote_count - $question->down_vote_count; ?>
                        </div>
                        <div class="down-vote">
                            <?php echo html::anchor('questions/vote_down/'.$question->id, 'Down'); ?>
                        </div>
                        <div class="favorite">
                            <?php echo html::anchor('questions/bookmark/'.$question->id, 'Bookmark'); ?>
                            <br/>
                            <?php echo $question->favorite_count; ?>
                        </div>
                        <div class="view">
                            <span>View</span>
                            <br/>
                            <?php echo $question->view_count; ?>
                        </div>
                    </div><?php /* END .panel */ ?>

                    <div class="detail">
                        <div class="content">
                            <?php
                                echo nl2br($question->content);
                            ?>
                        </div>
                        
                        <ul class="tags clearfix">
                            <?php foreach($question->tags as $index => $tag): ?>
                                <li class="tag">
                                    <?php echo html::anchor('questions/tagged/'.$tag->slug, $tag->name, array('rel'=>'tag')); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <?php
                            $form       = View::factory($theme_url.'partials/user_flair');
                            $form->user = $question->user;
                            $form->render(TRUE);
                        ?>

                        <?php /***travo20100227: Not Implemented
                        <div class="meta">
                            <span><?php echo html::anchor('#', 'mod'); ?></span>
                            | <span><?php echo html::anchor('#', 'edit'); ?></span>
                            | <span><?php echo html::anchor('#', 'close'); ?></span>
                            | <span><?php echo html::anchor('#', 'delete'); ?></span>
                            | <span><?php echo html::anchor('#', 'flag'); ?></span>
                        </div>
                        */ ?>

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
                                    <?php echo html::anchor('answers/vote_up/'.$answer->id, 'Up'); ?>
                                </div>
                                <div class="score">
                                    <?php echo $answer->up_vote_count - $answer->down_vote_count; ?>
                                </div>
                                <div class="down-vote">
                                    <?php echo html::anchor('answers/vote_down/'.$answer->id, 'Down'); ?>
                                </div>
                                <?php if($show_accept_button == true): ?>
                                    <div class="accept-answer">
                                        <?php echo html::anchor('answers/accept/'.$answer->id, 'Accept Answer'); ?>
                                    </div>
                                <?php endif; ?>
                            </div><?php /* END .panel */ ?>


                            <div class="detail">
                                <div class="content">
                                    <?php
                                        //echo text::auto_p($answer->content);
                                        echo nl2br($answer->content);
                                    ?>
                                </div>

                                <?php
                                    $form       = View::factory($theme_url.'partials/user_flair');
                                    $form->user = $answer->user;
                                    $form->render(TRUE);
                                ?>

                                <?php /***travo20100227: Not Implemented
                                <div class="meta">
                                    <span><?php echo html::anchor('#', 'mod'); ?></span>
                                    | <span><?php echo html::anchor('#', 'edit'); ?></span>
                                    | <span><?php echo html::anchor('#', 'close'); ?></span>
                                    | <span><?php echo html::anchor('#', 'delete'); ?></span>
                                    | <span><?php echo html::anchor('#', 'flag'); ?></span>
                                </div>
                                */ ?>
                                
                            </div><?php /* END .detail */ ?>

                            <?php /* TODO: Question Comments */ ?>

                        </div><?php /* END .post-detail */ ?>

                    <?php endforeach; ?>


                    <?php
                        if($this->pagination->total_pages > 1)
                            echo $this->pagination->render('qanda');
                    ?>

                    <?php if(count($answers) == 0): ?>
                        <div class="no-answers">
                            <p>
                                There's no answer to this question. Provide us your answer.
                            </p>
                        </div>
                    <?php endif; ?>


                </div><?php /* END .answers-list */ ?>


                
                <?php /* TODO: Display a message when there's no answers to this question */ ?>


                
                <h2>Answer this Question</h2>
                <?php
                    $form                       = View::factory($theme_url.'partials/post_form');
                    $form->submit_uri           = 'answers/create';
                    $form->form_class           = 'answer-question';
                    $form->form_method          = 'post';
                    $form->question_id          = $question->id;
                    $form->enable_post_title    = FALSE;
                    $form->enable_post_tags     = FALSE;
                    $form->submit_label         = 'Post Answer';
                    $form->render(TRUE);
                ?>


            </div><?php /* END #main-bar */ ?>

            <?php View::factory($theme_url.'sidebar')->render(TRUE); ?>

            <div class="clearfix"></div>

        </div><?php /* END #content */ ?>