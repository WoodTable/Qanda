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

    //protected $belongs_to = array('post_parent'=>'post');

    /**
     * List All Questions
     *
     * @param int $page_number
     * @param int $page_size
     * @param string $order_by newest|featured|hot|votes|active
     * @return ORM_Iterator
     */
    public function get_questions($page_number, $page_size, $order_by)
    {
        //-- Local Variables
        $limit = $page_size;
        $offset = ($page_number-1) * $page_size;

        //TODO: Implement usage of $order_by attribute
        
        //-- Query
        $questions = $this
            ->where('is_deleted', 0)
            ->where('post_type', 'question')
            ->orderby('last_activity_date', 'desc')
            ->find_all($limit, $offset);

        //-- Output
        return $questions;
    }

    /**
     * Count Questions
     *
     * @return int
     */
    public function get_questions_count()
    {
        //-- Query
        $count = $this
            ->where('is_deleted', 0)
            ->where('post_type', 'question')
            ->count_all();
        
        //-- Output
        return $count;
    }

    /**
     * List Unanswered Questions
     *
     * @param int $page_number
     * @param int $page_size
     * @param string $order_by my_tags|newest|votes
     * @return ORM_Iterator
     */
    public function get_unanswered_questions($page_number, $page_size, $order_by)
    {
        //-- Local Variables
        $limit = $page_size;
        $offset = ($page_number-1) * $page_size;

        //TODO: Implement usage of $order_by attribute

        //-- Query
        $questions = $this
            ->where('is_deleted', 0)
            ->where('post_type', 'question')
            ->where('answer_count', 0)
            ->orderby('date_created', 'desc')
            ->find_all($limit, $offset);

        //-- Output
        return $questions;
    }

    /**
     * Count Unanswered Questions
     *
     * @return int
     */
    public function get_unanswered_questions_count()
    {
        //-- Query
        $count = $this
            ->where('is_deleted', 0)
            ->where('post_type', 'question')
            ->where('answer_count', 0)
            ->count_all();
        
        //-- Output
        return $count;
    }

    /**
     * Add an Answer to Specified Question
     *
     * @param string $question_id
     * @param Validation_Object $post
     * @return bool
     */
    public function add_answer($question_id, $post)
    {
        //-- TODO: Sanitize
        $body = $post->post_body;

        //-- Check Authentication
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {//-- Find Current User ID
            $user = $authentic->get_user();
        }
        else
        {
            //TODO: Check if Existing Guest already in Database
            
            //-- Register as a new Guest
            $user               = ORM::factory('user');
            //TODO: Valid uniqueness of Generated Username
            $user->username     = 'guest-'.strtolower(text::random('alnum', 16));
            $user->password     = $user->username;
            //TODO: Sanitise User Input
            $user->email        = $post->email;
            $user->display_name = $post->display_name;
            $user->date_created = date('Y-m-d H:i:s', time());
            $user->created_by   = 'post::add_answer';
            $user->add(ORM::factory('role', 'guest'));
            $user->save();

            //TODO: Handle Exception when Save User Failed
        }

        //-- Save Answer
        $answer                 = ORM::factory('post');
        $answer->user_id        = $user->id;
        $answer->post_parent_id = $question_id;
        $answer->content        = $body;
        $answer->post_type      = 'answer';
        $answer->date_created   = date('Y-m-d H:i:s', time());
        $answer->created_by     = 'question::detail';
        $success                = $answer->save();
        
        return $success;
    }

    /**
     * Add a new Question
     *
     * @param string $post
     * @return bool
     */
    public function add_question($post)
    {
        //-- TODO: Sanitize User Input
        $title = $post->post_title;
        $body = $post->post_body;
        $tags = explode(',', $post->post_tags);

        //-- Check Authentication
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {
            $user = $authentic->get_user();
        }
        else
        {
            //TODO: Check if Existing Guest already in Database
            
            //-- Register as Guest
            $user               = ORM::factory('user');
            $user->username     = 'guest-'.strtolower(text::random('alnum', 16));
            $user->password     = $user->username;
            $user->email        = $post->email;
            $user->display_name = $post->display_name;
            $user->date_created = date('Y-m-d H:i:s', time());
            $user->created_by   = 'post::add_question';
            $user->add(ORM::factory('role', 'guest'));
            $user->save();

            //TODO: Handle Exception when Save User Failed.
        }

        //-- Save Question
        $question               = ORM::factory('post');
        $question->user_id      = $user->id;
        $question->title        = $title;
        $question->slug         = url::title($title);
        $question->content      = $body;
        $question->post_type    = 'question';
        $question->date_created = date('Y-m-d H:i:s', time());
        $question->created_by   = 'post::add_question';

        foreach($tags as $tag_name)
        {
            $tag_name = trim($tag_name);
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
                $tag->created_by = 'post::add_question';
                $tag->save();
            }
            else if($tag->is_deleted == 1)
            {//-- If tag found but has been marked as 'deleted'
                $tag->is_deleted = 0;
                $tag->post_count = 1;
                $tag->date_modified = date('Y-m-d H:i:s', time());
                $tag->modified_by = 'post::add_question';
                $tag->save();
            }

            //-- Add Tag to Qustion
            $question->add(ORM::factory('tag', $tag->id));
        }

        $success = $question->save();
        if($success == TRUE)
            return $question->id;
        else
            return -1;
    }

}//END class