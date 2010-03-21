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
        try
        {
            //-- Initialise Model
            ORM::factory('post')->vote_up($answer_id);

            //-- Redirect
            $answer     = ORM::factory('post', $answer_id);
            $question   = ORM::factory('post', $answer->parent_id);
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
        try
        {
            //-- Initialise Model
            ORM::factory('post')->vote_down($answer_id);

            //-- Redirect
            $answer     = ORM::factory('post', $answer_id);
            $question   = ORM::factory('post', $answer->parent_id);
            url::redirect('/questions/detail/'.$question->id.'/'.$question->slug.'#'.$answer_id);
        }
        catch(Exception $ex)
        {
            $message = 'Cannot vote up answer '.$answer_id.'. Caught exception: '.$ex->getMessage();
            throw new Kohana_User_Exception('Fail to Vote Up', $message);
        }
    }

    /**
     * Accept an Existing Answer
     *
     * @param int $answer_id
     * @uses Post_Model::has_accepted_answer()
     * @uses User_Model::adjust_reputation()
     * @uses Activity_Model::log()
     */
    public function accept($answer_id)
    {
        //-- Validate Answer
        $answer = ORM::factory('post', $answer_id);
        if($answer->id == 0)
        {
            throw new Kohana_User_Exception('Cannot Find Answer', 'Cannot find answer ID: '.$answer_id);
        }

        //-- Validate Question
        $question = ORM::factory('post', $answer->parent_id);
        if($question->id == 0)
        {
            throw new Kohana_User_Exception('Question Does not Exist', 'Cannot find the Question to answer ID: '.$answer_id);
        }

        //-- Validate Logged In User
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {
            $user = $authentic->get_user();
        }
        else
        {
            throw new Kohana_User_Exception('Authentication Required', 'You are required to login before accept an answer.');
        }
        
        //-- Authenticate Current User, make sure current user is same as Question author
        if($user->id != $question->user_id)
        {
            throw new Kohana_User_Exception('Authentication Failed', 'You can only accept answer if it is your question.');
        }
        
        //-- Verify no Answers has been Previously Accepted
        $has_accepted_answer = ORM::factory('post')->has_accepted_answer($question->id);
        if($has_accepted_answer == true)
        {
            throw new Kohana_User_Exception('Already has Accepted Answer', 'You Already has Accepted Answer for Question ID: '.$question->id);
        }

        //-- Set Answer as accepted
        $answer->status         = 'accepted';
        $answer->date_modified  = date::timestamp();
        $answer->modified_by    = 'answers::accept';
        $answer->save();

        //-- Update Question Status (to 'answer-accepted')
        $question->status           = 'answered';
        $question->date_modified    = date::timestamp();
        $question->modified_by      = 'answers::accept';
        $question->save();

        //-- Update User's Last Activity
        $user->last_activity_date   = date::timestamp();
        $user->last_ip_address      = client::ip_address();
        $user->last_user_agent      = Kohana::user_agent();
        $user->save();
        
        //-- Update Answer Author's Reputation
        ORM::factory('user')->adjust_reputation($answer->user_id, 5);
        
        //-- Log Question Acceptance Activity (for Question Author)
        ORM::factory('activity')->log($question->user_id, 'answer-accepted', 'question', $question->id);
        
        //-- Redirect
        url::redirect('/questions/detail/'.$question->id.'/'.$question->slug.'#'.$answer->id);
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