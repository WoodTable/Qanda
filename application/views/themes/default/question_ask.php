<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/**
* Ask Question Partial View
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

                <?php 
                    $form                       = View::factory($theme_url.'partials/post_form');
                    $form->form_class           = 'ask-question';
                    $form->form_method          = 'post';
                    $form->enable_post_title    = TRUE;
                    $form->enable_post_tags     = TRUE;
                    $form->submit_label         = 'Post Question';
                    $form->render(TRUE);
                ?>

            </div>

            <?php View::factory($theme_url.'sidebar')->render(TRUE); ?>

            <div class="clearfix"></div>

        </div><?php /* END #content */ ?>