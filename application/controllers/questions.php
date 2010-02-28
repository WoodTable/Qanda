<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Questions Controller.
 *
 * @package Qanda
 * @subpackage Question
 */

/**
 * Qanda Questions Controller for all Question Related Tasks.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Question
 * @uses Website_Controller Extends class
 */
class Questions_Controller extends Website_Controller
{

    /**
     * Questions Controller Constructor
     */
    public function __construct()
    {
        parent::__construct(); //-- This must be included
    }

    /**
     * Browse a List of Questions
     *
     * @param int $page_number
     * @param int $page_size
     * @param string $order_by
     */
    public function browse($page_number=1, $page_size=5, $order_by='active')
    {
        //TODO: Make use of $order_by argument

        
        //-- Model
        $post_model = ORM::factory('post');

        //-- Pagination
        $this->pagination = Pagination::factory();
        $this->pagination->initialize(array(
            'base_url' => 'questions/browse'
            //, 'uri_segment'     => 'page'
            , 'total_items'     => $post_model->get_all_questions_count()
            , 'items_per_page'  => $page_size
        ));
        
        //-- Render View
        $this->template->content = View::factory('themes/default/question_list')
            ->bind('questions', $post_model->get_active_questions($page_number, $page_size));
    }

    /**
     * View a Question and its Anwers
     *
     * @param int $question_id
     * @param string $slug
     */
    public function detail($question_id, $slug='')
    {
        //-- Fetch the Question
        $question = ORM::factory('post', $question_id);
        
        //-- Increase View Count
        //--NOTE: Currently using linear incremental on view count, which means every refresh will increase this count
        $question->view_count += 1;
        $question->save();

        //-- Track User View Activity
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {
            $user = $authentic->get_user();
            ORM::factory('activity')->track($user->id, 'view', 'post', $question_id);
        }

        //-- Fetch its Answers
        $answers = ORM::factory('post')->where('post_parent_id', $question_id)
            ->where('status', 'publish')
            ->where('post_type', 'answer')
            ->find_all();

        //-- Render View
        $this->template->content = View::factory('themes/default/question_detail')
            ->bind('question', $question)
            ->bind('answers', $answers);
    }

    /**
     * View Questions Contain Matching Tag
     */
    public function tagged($tag_slug)
    {
        //TODO: Implement this method
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * Ask a Question
     */
    public function ask()
    {
        //-- Detect a Post Back
        if($_POST)
        {
            $post = Validation::factory($_POST);
            
            try
            {//-- Instantiate New Question Model
                $question_id    = ORM::factory('post')->create_question($post);
                $question       = ORM::factory('post', $question_id);

                //-- Redirect
                url::redirect('/questions/detail/'.$question->id.'/'.$question->slug);
            }
            catch(Exception $ex)
            {//-- Throw an Error Message
                //TODO: Instead of throw Kohana Error page, redirect back to this method with error message displayed.
                $message = 'Cannot create question. Caught exception: '.$ex->getMessage();
                throw new Kohana_User_Exception('Fail to Create Question.', $message);
            }

            return; //-- Code Suppose to End Regardless
        }

        //-- Render View
        $this->template->content = View::factory('themes/default/question_ask');
    }

    /**
     * View List of Unanswered Questions
     */
    public function unanswered($page_number=1, $page_size=5)
    {
        //-- Model
        $post_model = ORM::factory('post');

        //-- Pagination
        $this->pagination = Pagination::factory();
        $this->pagination->initialize(array(
            'base_url'          => 'questions/unanswered/'
            //, 'uri_segment'     => 'page'
            , 'total_items'     => $post_model->get_unanswered_questions_count()
            , 'items_per_page'  => $page_size
        ));

        //-- Render View
        $this->template->content = View::factory('themes/default/question_list')
            ->bind('questions', $post_model->get_unanswered_questions($page_number, $page_size));
    }

    /**
     * Search Questions with Specified Criteria
     */
    public function search($query)
    {
        //TODO: Implement this method
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * Display RSS Feed for all Questions
     */
    public function feed_all()
    {
        //TODO: Implement this method
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * Display RSS feed for a Question and its Answers
     */
    public function feed($question_id)
    {
        //TODO: Implement this method
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * Edit an Existing Question
     */
    public function edit($question_id)
    {
        //TODO: Implement this method
        $this->template->content = "Method Not Implemented Yet.";
    }
    
}//END class