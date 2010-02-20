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

        //$this->db = Database::instance();
        //$this->session = Session::instance();
    }
    
    /**
     * Default Landing Action
     */
    /***travo20100131: Deprecate landing page as it should be managed through route
    public function index()
    {
        //-- Reroute to 'show' action
        return $this->show();
    }
    */

    /**
     * Show a List of Questions
     */
    public function show($page_number=1, $page_size=5, $order_by='active')
    {
        //-- Model
        $questions = ORM::factory('post');

        //-- Pagination
        $this->pagination = Pagination::factory();
        $this->pagination->initialize(array(
            'base_url' => 'questions/'
            , 'uri_segment'       => 'page'
            , 'total_items'     => $questions->get_questions_count()
            , 'items_per_page'  => $page_size
        ));
        
        //-- Render View
        $this->template->content = View::factory('themes/default/question_list')
            ->bind('questions', $questions->get_questions($page_number, $page_size, $order_by));
    }

    /**
     * View a Question and its Anwers
     *
     * @param int $question_id
     * @param string $slug
     */
    public function detail($question_id, $slug='')
    {
        if($_POST)
        {//-- An Answer is Submitted
            $post = Validation::factory($_POST);
            $success = ORM::factory('post')->add_answer($question_id, $post);

            if($success)
            {
                //-- TODO: Fetch Question & Increase Answer Count
                $question = ORM::factory('post', $question_id);

                //-- Redirect
                //-- NOTE: You will require to redirect, otherwise submission will be trigger again upon page refresh
                url::redirect('/questions/detail/'.$question_id.'/'.$question->slug);
            }
            else
            {
                //TODO: Display Answer Submission Failed Message
            }
            return; //-- Code Suppose to End Regardless
        }

        
        //-- Model
        $question = ORM::factory('post')->where('id', $question_id)
            ->find();
        
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
        if($_POST)
        {
            $post = Validation::factory($_POST);
            $question_id = ORM::factory('post')->add_question($post);
            
            if($question_id > 0)
            {//-- Redirect
                //-- NOTE: You will require to redirect, otherwise submission will be trigger again upon page refresh
                $question = ORM::factory('post', $question_id);
                url::redirect('/questions/detail/'.$question->id.'/'.$question->slug);
            }
            else
            {
                //TODO: Display Question Submission Failed Message
            }
            return; //-- Code Suppose to End Regardless
        }

        //-- Render View
        $this->template->content = View::factory('themes/default/question_ask');
    }

    /**
     * View List of Unanswered Questions
     */
    public function unanswered($page_number=1, $page_size=5, $order_by='newest')
    {
        //-- Model
        $questions = ORM::factory('post');

        //-- Pagination
        $this->pagination = Pagination::factory();
        $this->pagination->initialize(array(
            'base_url'          => 'questions/unanswered/'
            , 'uri_segment'     => 'page'
            , 'total_items'     => $questions->get_unanswered_questions_count()
            , 'items_per_page'  => $page_size
        ));

        //-- Render View
        $this->template->content = View::factory('themes/default/question_list')
            ->bind('questions', $questions->get_unanswered_questions($page_number, $page_size, $order_by));
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