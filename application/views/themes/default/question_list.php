<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* Question List Partial View
*
* @since 1.0.0
* @package Qanda
* @subpackage View
*/
?>
        <div id="content">
            
            <div class="main-bar">

                <div class="subheader">
                    <h2>Questions</h2>
                </div>

                <?php foreach($questions as $index => $question): ?>
                <div id="question-summary-<?php echo $question->id; ?>" class="question-summary clearfix">

                    <div class="votes">
                        <span class="count"><?php echo ($question->up_vote_count-$question->down_vote_count); ?></span>
                        <span class="label">votes</span>
                    </div>

                    <div class="answers">
                        <span class="count"><?php echo $question->answer_count; ?></span>
                        <span class="label">answers</span>
                    </div>

                    <div class="views">
                        <span class="count"><?php echo $question->view_count; ?></span>
                        <span class="label">views</span>
                    </div>
                    
                    <div class="summary clearfix">
                        <h3>
                            <?php echo html::anchor('questions/detail/'.$question->id.'/'.$question->slug, $question->title, array('class'=>'cls1 cls2')); ?>
                        </h3>
                        <ul class="tags clearfix">
                            <?php foreach($question->tags as $index => $tag): ?>
                                <li class="tag">
                                    <?php echo html::anchor('questions/tagged/'.$tag->slug, $tag->name, array('rel'=>'tag')); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="meta">
                            By:
                            <?php echo html::anchor('users/detail/'.$question->user->username, $question->user->username); ?>
                            (<?php echo $question->user->reputation_score; ?>)
                        </div>
                    </div>

                </div>             
                <?php endforeach; ?>

                <?php 
                    if($this->pagination->total_pages > 1)
                        echo $this->pagination->render('qanda');
                ?>

            </div>

            <?php View::factory($theme_url.'sidebar')->render(TRUE); ?>

            <div class="clearfix"></div>

        </div><?php /* END #content */ ?>