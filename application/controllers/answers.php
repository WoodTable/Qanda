<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Answers Controller.
 *
 * @package Qanda
 * @subpackage Answer
 */

/**
 * Qanda Answers Controller for all Answer Related Tasks.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Answer
 * @uses Website_Controller Extends class
 */
class Answers_Controller extends Website_Controller
{
    
    /**
     * Answers Controller Constructor
     */
    public function __construct()
    {
        parent::__construct(); //-- This must be included
    }

    /**
     * Create a New Answer
     *
     * @uses Post_Model::create_answer()
     */
    public function create()
    {
        //-- Detect a Post Back (ie/ Submitting an Answer)
        if($_POST)
        {
            $post = Validation::factory($_POST);

            try
            {//-- Instantiate New Question Model
                $answer_id  = ORM::factory('post')->create_answer($post);

                //TODO: This should be in a different try-catch block
                $question   = ORM::factory('post', $post->question_id);
                
                //-- Redirect
                //-- NOTE: You will require to redirect, otherwise submission will be trigger again upon page refresh
                url::redirect('/questions/detail/'.$question->id.'/'.$question->slug);
            }
            catch(Exception $ex)
            {//-- Throw an Error Message
                //TODO: Instead of throw Kohana Error page, redirect back to this method with error message displayed.
                $message = 'Cannot create answer. Caught exception: '.$ex->getMessage();
                throw new Kohana_User_Exception('Fail to Create Answer.', $message);
            }

            return;
        }
        else
        {
            throw new Kohana_User_Exception('Bad Landing.', 'You have been direct to this location incorrectly.');
        }
    }


    /**
     * Up Vote an Answer
     *
     * @param int $answer_id
     * @uses Post_Model::vote()
     */
    public function vote_up($answer_id)
    {
        //-- Local Variables
        $post_model = ORM::factory('post');
        $score = 1;

        try
        {
            //-- Initialise Model
            $post_model->vote($answer_id, $score);

            //-- Redirect
            $answer     = ORM::factory('post', $answer_id);
            $question   = ORM::factory('post', $answer->post_parent_id);
            url::redirect('/questions/detail/'.$question->id.'/'.$question->slug.'#'.$answer_id);
        }
        catch(Exception $ex)
        {
            $message = 'Cannot vote up answer '.$answer_id.'. Caught exception: '.$ex->getMessage();
            throw new Kohana_User_Exception('Fail to Vote Up', $message);
        }
    }


    /**
     * Down Vote an Answer
     *
     * @param int $answer_id
     * @uses Post_Model::vote()
     */
    public function vote_down($answer_id)
    {
        //-- Local Variables
        $post_model = ORM::factory('post');
        $score = -1;

        try
        {
            //-- Initialise Model
            $post_model->vote($answer_id, $score);

            //-- Redirect
            $answer     = ORM::factory('post', $answer_id);
            $question   = ORM::factory('post', $answer->post_parent_id);
            url::redirect('/questions/detail/'.$question->id.'/'.$question->slug.'#'.$answer_id);
        }
        catch(Exception $ex)
        {
            $message = 'Cannot vote up answer '.$answer_id.'. Caught exception: '.$ex->getMessage();
            throw new Kohana_User_Exception('Fail to Vote Up', $message);
        }
    }

    //----------------------- PLACE HOLDERS --------------------------//

    /**
     * Edit Answers Action
     */
    public function edit($answer_id)
    {
        //TODO: Implement this method
    }

    /**
     * Delete Answers Action
     */
    public function delete($answer_id)
    {
        //TODO: Implement this method
    }

}//END class