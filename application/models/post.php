<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Qanda Model for Questions and Answers.
 *
 * @package Qanda
 * @subpackage Post
 */

/**
 * Qanda Posts Model.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Post
 * @uses ORM Extends class
 */
class Post_Model extends ORM
{
    protected $belongs_to = array('user');
    protected $has_and_belongs_to_many = array('tags');

    /**
     * List of Active Questions
     *
     * @param int $page_number
     * @param int $page_size
     * @return ORM_Iterator
     * @static
     */
    public function get_active_questions($page_number, $page_size)
    {
        //-- Local Variables
        $limit = $page_size;
        $offset = ($page_number-1) * $page_size;

        //-- Query
        $questions = $this
            ->where('is_deleted', 0)
            ->where('post_type', 'question')
            ->where('status', 'publish')
            ->orderby('last_activity_date', 'desc')
            ->orderby('date_created', 'desc')
            ->find_all($limit, $offset);

        //-- Output
        return $questions;
    }

    /**
     * Count Questions
     *
     * @return int
     * @static
     */
    public function count_all_questions()
    {
        //-- Query
        $count = $this
            ->where('is_deleted', 0)
            ->where('post_type', 'question')
            ->where('status', 'publish')
            ->count_all();
        
        //-- Output
        return $count;
    }

    /**
     * List Unanswered Questions
     *
     * @param int $page_number
     * @param int $page_size
     * @return ORM_Iterator
     * @static
     */
    public function get_unanswered_questions($page_number, $page_size)
    {
        //-- Local Variables
        $limit = $page_size;
        $offset = ($page_number-1) * $page_size;

        //-- Query
        $questions = $this
            ->where('is_deleted', 0)
            ->where('post_type', 'question')
            ->where('status', 'publish')
            ->where('answer_count', 0)
            ->orderby('last_activity_date', 'desc')
            ->orderby('date_created', 'desc')
            ->find_all($limit, $offset);

        //-- Output
        return $questions;
    }

    /**
     * Count Unanswered Questions
     *
     * @return int
     * @static
     */
    public function count_unanswered_questions()
    {
        //-- Query
        $count = $this
            ->where('is_deleted', 0)
            ->where('post_type', 'question')
            ->where('status', 'publish')
            ->where('answer_count', 0)
            ->count_all();
        
        //-- Output
        return $count;
    }




    /**
     * List Answers of Specified Question
     *
     * @param int $question_id
     * @param int $page_number
     * @param int $page_size
     * @return ORM_Iterator
     * @static
     */
    public function get_all_answers($question_id, $page_number, $page_size)
    {
        //-- Local Variables
        $limit = $page_size;
        $offset = ($page_number-1) * $page_size;

        //-- Query
        $answers = $this
            ->where('is_deleted', 0)
            ->where('post_parent_id', $question_id)
            ->where('post_type', 'answer')
            ->where('status', 'publish')
            ->orderby('last_activity_date', 'desc')
            ->orderby('date_created', 'desc')
            ->find_all($limit, $offset);

        //-- Output
        return $answers;
    }


    /**
     * Count Number of Answers to a Specified Question
     *
     * @return int
     * @static
     */
    public function count_all_answers($question_id)
    {
        //-- Query
        $count = $this
            ->where('is_deleted', 0)
            ->where('post_parent_id', $question_id)
            ->where('post_type', 'answer')
            ->where('status', 'publish')
            ->count_all();

        //-- Output
        return $count;
    }



    /**
     * Create an Answer to Specified Question
     *
     * @param Validation_Object $post
     * @static
     */
    public function create_answer($post)
    {
        //-- Local Variables
        $body = $post->post_body;
        $question_id = $post->question_id;

        //-- Sanitize
        if($body == '')
            throw new Exception('Body field is required');
        if($question_id == 0 || $question_id == '')
            throw new Exception('Question ID is not provided');

        //TODO: Break this to a seperate concern
        //-- Check Authentication
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {//-- Find Current User ID
            //TODO: Try catch this
            $user = $authentic->get_user();
        }
        else
        {//TODO: Guest user management should be a seperate concern

            //TODO: Check permission for answering this question


            //TODO: Check if Existing Guest already in Database


            //-- Register as Guest
            $user               = ORM::factory('user');
            $user->display_name = $post->display_name;
            //$user->username     = 'guest-'.strtolower(text::random('alnum', 4)); //TODO: Use helper to generate guest account name
            $user->username     = url::title($user->display_name).'-'.strtolower(text::random('alnum', 4));
            $user->password     = $user->username;
            $user->email        = $post->email;
            //TODO: last activity date
            //TODO: last ip address
            //TODO: last user agent
            //TODO: question count
            $user->date_created = date('Y-m-d H:i:s', time());
            $user->created_by   = 'post::create_question';
            $user->add(ORM::factory('role', 'guest'));
            try
            {
                $user->save();
            }
            catch (Exception $ex)
            {
                throw new Exception('Failed to create guest user account. Caught exception: '.$ex->getMessage());
            }
        }

        //-- Save Answer
        $answer                 = ORM::factory('post');
        $answer->user_id        = $user->id;
        $answer->post_parent_id = $question_id;
        $answer->content        = $body;
        $answer->post_type      = 'answer';
        $answer->date_created   = date('Y-m-d H:i:s', time());
        $answer->created_by     = 'question::detail';
        //TODO: Needs to handle exception
        $success                = $answer->save();


        if($success == TRUE)
        {
            //-- Update Question's answer count and last activity date
            $question = ORM::factory('post', $question_id);
            $question->answer_count += 1;
            $question->last_activity_date = date('Y-m-d H:i:s', time());
            $question->date_modified = date('Y-m-d H:i:s', time());
            $question->modified_by = 'post::create_answer';
            $question->save();
            
            //-- Update User's answer count
            //NOTE: User model are already loaded
            $user->answer_count += 1;
            $user->save();

            //-- Add User activity
            ORM::factory('activity')->log($user->id, 'create', 'post', $answer->id);

            //-- Update User's tag involvement
            ORM::factory('tags_user')->tag_answer($user->id, $question->id, $answer->id);

            //-- Output
            return $answer->id;
        }
        else
            throw new Exception('Failed to save answer.');
    }

    /**
     * Create a New Question
     *
     * @param Validation_Object $post
     * @return int Id of the newly created question
     * @static
     */
    public function create_question($post)
    {
        //-- Local Variables
        $title = $post->post_title;
        $body = $post->post_body;
        $tags_string = $post->post_tags;
        

        //-- Sanitize
        if($title == '')
            throw new Exception('Title field is required');
        if($body == '')
            throw new Exception('Body field is required');
        if($tags_string == '')
            throw new Exception('Tags are not provided');

        //-- Setup User Details
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {//-- Check Authentication
            $user = $authentic->get_user();
        }
        else
        {//TODO: Guest user management should be a seperate concern

            //TODO: Check permission for asking question

            
            //TODO: Check if Existing Guest already in Database

            
            //-- Register as Guest
            $user               = ORM::factory('user');
            $user->display_name = $post->display_name;
            //$user->username     = 'guest-'.strtolower(text::random('alnum', 4)); //TODO: Use helper to generate guest account name
            $user->username     = url::title($user->display_name).'-'.strtolower(text::random('alnum', 4));
            $user->password     = $user->username;
            $user->email        = $post->email;
            //TODO: last activity date
            //TODO: last ip address
            //TODO: last user agent
            //TODO: question count
            $user->date_created = date('Y-m-d H:i:s', time());
            $user->created_by   = 'post::create_question';
            $user->add(ORM::factory('role', 'guest'));
            try
            {
                $user->save();
            }
            catch (Exception $ex)
            {
                throw new Exception('Failed to create guest user account. Caught exception: '.$ex->getMessage());
            }
        }

        //-- Save Question
        $question               = ORM::factory('post');
        $question->user_id      = $user->id;
        $question->title        = $title;
        $question->slug         = url::title($title);
        $question->content      = $body;
        $question->post_type    = 'question';
        $question->last_activity_date = date('Y-m-d H:i:s', time());
        $question->date_created = date('Y-m-d H:i:s', time());
        $question->created_by   = 'post::create_question';

        //TODO: Tag management should be a seperate concern

        //TODO: Need to handle max tags per post

        //TODO: Sanitize

        $tags = explode(',', $tags_string);
        foreach($tags as $tag_name)
        {
            $tag_name = trim($tag_name);

            //-- Sanitize
            if($tag_name == '')
                continue;
            
            $tag_slug = url::title($tag_name);

            //-- Get tag ID (check if it exist)
            $tag = ORM::factory('tag')->where('slug', $tag_slug)
                ->find();

            if($tag->id == 0)
            {
                $tag->name = $tag_name;
                $tag->slug = $tag_slug;
                $tag->post_count = 1;
                $tag->date_created = date('Y-m-d H:i:s', time());
                $tag->created_by = 'post::create_question';
                try
                {
                    $tag->save();
                }
                catch(Exception $ex)
                {
                    throw new Exception('Failed to create new tag. Caught exception: '.$ex->getMessage());
                }
            }
            else if($tag->is_deleted == 1)
            {//-- Revitalise deleted tag
                $tag->is_deleted = 0;
                $tag->post_count = 1;
                $tag->date_modified = date('Y-m-d H:i:s', time());
                $tag->modified_by = 'post::create_question';
                try
                {
                    $tag->save();
                }
                catch(Exception $ex)
                {
                    throw new Exception('Failed to update existing tag. Caught exception: '.$ex->getMessage());
                }
            }
            else
            {//-- Increment Tag count
                $tag->post_count += 1;
                $tag->date_modified = date('Y-m-d H:i:s', time());
                $tag->modified_by = 'post::create_question';
                try
                {
                    $tag->save();
                }
                catch(Exception $ex)
                {
                    throw new Exception('Failed to update existing tag. Caught exception: '.$ex->getMessage());
                }
            }

            //-- User Tag Involvement
            ORM::factory('tag')->set_user_involvement($tag->id, $user->id);
            
            //-- Add Tag to Qustion
            //TODO: Needs to handle exception
            $question->add(ORM::factory('tag', $tag->id));
        }

        //-- Save Question
        //TODO: Needs to handle exception
        $success = $question->save();

        if($success == TRUE)
        {
            //-- Increase User's Question Count
            $user->question_count += 1;
            $user->date_modified = date('Y-m-d H:i:s', time());
            $user->modified_by = 'post::create_question';
            $user->save();

            //-- Output
            return $question->id;
        }
        else
            throw new Exception('Failed to save question.');
    }



    /**
     * Cast a Vote to a Question or Answer
     *
     * @param int $post_id
     * @param int $score 1 or -1
     * @static
     */
    public function vote($post_id, $score)
    {
        //-- Sanitize $score value
        if($score != 1 && $score != -1)
            throw new Exception('Invalid score value: '.$score.'.');
        
        //-- Authentic User
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {//-- Find Current User ID
            //TODO: Try catch this
            $user = $authentic->get_user();
        }
        else
            throw new Exception('User has not yet authenticated.');

        //-- Verify Question/Answer
        $post = ORM::factory('post', $post_id);
        if($post->id == 0)
            throw new Exception('Post ID '.$post_id.' not found.');

        //-- Initialise Activity Log
        $activity = ORM::factory('activity');
        if($score >= 1)
            $action_key = 'vote_up';
        elseif($score <= -1)
            $action_key = 'vote_down';
        
        //-- Check Activity Already Exist
        if($activity->has_log($user->id, $action_key, 'post', $post_id))
            throw new Exception('User '.$user->id.' has already '.$action_key.' this post.');

        //-- Increase Up Vote Count
        if($score >= 1)
            $post->up_vote_count += 1;
        elseif($score <= -1)
            $post->down_vote_count += 1;
        $post->date_modified    = date('Y-m-d H:i:s', time());
        $post->modified_by      = 'post::vote';
        $post->save();

        //-- Log activity
        $activity->log($user->id, $action_key, 'post', $post_id);
    }



    /**
     * Bookmark a Question
     *
     * @param int $question_id
     * @static
     */
    public function bookmark($question_id)
    {
        //-- Authentic User
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {//-- Find Current User ID
            //TODO: Try catch this
            $user = $authentic->get_user();
        }
        else
            throw new Exception('User has not yet authenticated.');

        //-- Verify Question
        $question = ORM::factory('post', $question_id);
        if($question->id == 0)
            throw new Exception('Question ID '.$question_id.' not found.');

        //-- Initialise Activity Log
        $activity = ORM::factory('activity');

        //-- Check Activity Already Exist
        if($activity->has_log($user->id, 'bookmark', 'post', $question_id))
            throw new Exception('User '.$user->id.' has already bookmark this question.');

        //-- Log activity
        $activity->log($user->id, 'bookmark', 'post', $question_id);
    }

}//END class