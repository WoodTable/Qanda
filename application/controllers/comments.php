<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Comments Controller.
 *
 * @package Qanda
 * @subpackage Comment
 */

/**
 * Qanda Comments Controller for all Comment Related Tasks.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Comment
 * @uses Website_Controller Extends class
 */
class Comments_Controller extends Website_Controller
{

    /**
     * Comments Controller Constructor
     */
    public function __construct()
    {
        parent::__construct(); //-- This must be included
    }

    /**
     * Post a comment
     *
     * @uses Post_Model::create_comment()
     */
    public function create($post_type, $post_id=0)
    {
        //-- Detect a Post Back
        if($_POST)
        {
            $post = Validation::factory($_POST);

            try
            {//-- Instantiate New Question Model
                $comment_id     = ORM::factory('post')->create_comment($post);
                $comment        = ORM::factory('post', $comment_id);
                
                if($post_type == 'answer')
                {
                    $answer     = ORM::factory('post', $comment->parent_id);
                    $question   = ORM::factory('post', $answer->parent_id);
                }
                elseif($post_type == 'question')
                {
                    $question   = ORM::factory('post', $comment->parent_id);
                }
                
                //-- Redirect
                url::redirect('/questions/detail/'.$question->id.'/'.$question->slug);
            }
            catch(Exception $ex)
            {//-- Throw an Error Message
                //TODO: Instead of throw Kohana Error page, redirect back to this method with error message displayed.
                $message = 'Cannot create question. Caught exception: '.$ex->getMessage();
                throw new Kohana_User_Exception('Fail to Create Question', $message);
            }

            return; //-- Code Suppose to End Regardless
        }
        
        //-- Obtain models
        if($post_type == 'question')
        {
            //-- Get Question
            $answer     = null;
            $question   = ORM::factory('post', $post_id);
        }
        elseif($post_type == 'answer')
        {
            //-- Get both Question and Answer
            $answer     = ORM::factory('post', $post_id);
            $question   = ORM::factory('post', $answer->parent_id);
        }
        else
        {
            //-- Nothing
        }
        
        //-- Render View
        $this->template->content = View::factory('themes/default/comment_create')
            ->bind('answer', $answer)
            ->bind('question', $question)
            ->bind('post_type', $post_type)
            ->bind('target_post_id', $post_id)
            ;
    }

    //----------------------- PLACE HOLDERS --------------------------//

    /**
     * Show comments of a Question or an Answer
     */
    public function show($post_id)
    {
        //TODO: Implement this method
    }

    /**
     * Edit an Existing Comment
     */
    public function edit($comment_id)
    {
        //TODO: Implement this method
    }

    /**
     * Delete an Existing Comment
     */
    public function delete($comment_id)
    {
        //TODO: Implement this method
    }

}//END class