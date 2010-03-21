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
     * @param string $filler Does nothing
     * @param int $page_number
     * @param string $order_by
     * @param int $page_size
     * @uses browse_active()
     * @uses browse_unanswered()
     */
    public function browse($filler='page', $page_number=1, $order_by='active', $page_size=25)
    {
        //-- Determine Subcontroller
        switch($order_by)
        {
            case 'active':
                $this->browse_active($page_number, $page_size);
                break;
            case 'unanswered':
                $this->browse_unanswered($page_number, $page_size);
                break;
            default:
                throw new Kohana_User_Exception('Unknown Question Order Type.', "Cannot understand the 'order' value: $order_by");
                break;
        }
    }

    /**
     * View a Question and its Anwers
     *
     * @param int $question_id
     * @param string $slug
     * @param string $filler Does nothing
     * @param int $page_number
     * @param string $order_by
     * @param int $page_size
     * @uses increase_view_count()
     * @uses log_activity()
     * @uses set_pagination()
     * @uses Post_Model::count_all_answers()
     * @uses Post_Model::get_all_answers()
     */
    public function detail($question_id, $slug='', $filler='page', $page_number=1, $order_by='votes', $page_size=25)
    {
        //-- Get Question
        $question = ORM::factory('post', $question_id);

        //--
        $this->increase_view_count($question_id);
        $this->log_activity('view', 'post', $question_id);


        //-- Get Answers
        $total_items    = ORM::factory('post')->count_all_answers($question_id);
        $answers        = ORM::factory('post')->get_all_answers($question_id, $page_number, $page_size);

        //-- Display 'Accept Answer Button'
        $show_accept_button = false;
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {
            $user = $authentic->get_user();
            if($user->id == $question->user_id)
            {
                $show_accept_button = true;
            }
        }
        
        //-- Set Pagination
        $this->set_pagination("questions/detail/$question_id/$question->slug", $total_items, $page_size);

        //-- Render View
        $this->template->content = View::factory('themes/default/question_detail')
            ->bind('question', $question)
            ->bind('answers', $answers)
            ->bind('show_accept_button', $show_accept_button)
            ;
    }

    /**
     * Ask a Question
     *
     * @uses Post_Model::create_question()
     */
    public function create()
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
                throw new Kohana_User_Exception('Fail to Create Question', $message);
            }

            return; //-- Code Suppose to End Regardless
        }

        //-- Render View
        $this->template->content = View::factory('themes/default/question_ask');
    }
    
    /**
     * Up Vote a Question
     *
     * @param int $question_id
     * @uses Post_Model::vote()
     */
    public function vote_up($question_id)
    {
        try
        {
            //-- Initialise Model
            ORM::factory('post')->vote_up($question_id);

            //-- Redirect
            $question = ORM::factory('post', $question_id);
            url::redirect('/questions/detail/'.$question->id.'/'.$question->slug);
        }
        catch(Exception $ex)
        {
            $message = 'Cannot vote up question ID: '.$question_id.'. Caught exception: '.$ex->getMessage();
            throw new Kohana_User_Exception('Fail to Vote Up', $message);
        }
    }

    /**
     * Down Vote a Question
     *
     * @param int $question_id
     * @uses Post_Model::vote()
     */
    public function vote_down($question_id)
    {
        try
        {
            //-- Initialise Model
            ORM::factory('post')->vote_down($question_id);

            //-- Redirect
            $question = ORM::factory('post', $question_id);
            url::redirect('/questions/detail/'.$question->id.'/'.$question->slug);
        }
        catch(Exception $ex)
        {
            $message = 'Cannot vote down question ID: '.$question_id.'. Caught exception: '.$ex->getMessage();
            throw new Kohana_User_Exception('Fail to Vote Down', $message);
        }
    }

    /**
     * Bookmark a Question
     *
     * @param int $question_id
     * @uses Post_Model::bookmark()
     */
    public function bookmark($question_id)
    {
        try
        {
            //-- Initialise Model
            ORM::factory('post')->bookmark($question_id);

            //-- Redirect
            $question = ORM::factory('post', $question_id);
            url::redirect('/questions/detail/'.$question->id.'/'.$question->slug);
        }
        catch(Exception $ex)
        {
            $message = 'Cannot bookmark question ID: '.$question_id.'. Caught exception: '.$ex->getMessage();
            throw new Kohana_User_Exception('Fail to Vote Down', $message);
        }
    }

    //----------------------- PRIVATE METHODS --------------------------//

    /**
     * Browse a List of Questions order by its Activity
     *
     * @param int $page_number
     * @param int $page_size
     * @uses set_pagination()
     * @uses Post_Model::count_all_questions()
     * @uses Post_Model::get_active_questions()
     */
    private function browse_active($page_number, $page_size)
    {
        //-- Initialise Model
        $total_items    = ORM::factory('post')->count_all_questions();
        $questions      = ORM::factory('post')->get_active_questions($page_number, $page_size);

        //-- Set Pagination
        $this->set_pagination('questions/browse', $total_items, $page_size);

        //-- Render View
        $this->template->content = View::factory('themes/default/question_list')
            ->bind('questions', $questions);
    }

    /**
     * Browse a List of Unanswered Questions
     *
     * @param int $page_number
     * @param int $page_size
     * @uses set_pagination()
     * @uses Post_Model::count_unanswered_questions()
     * @uses Post_Model::get_unanswered_questions()
     */
    private function browse_unanswered($page_number, $page_size)
    {
        //-- Initialise Model
        $total_items    = ORM::factory('post')->count_unanswered_questions();
        $questions      = ORM::factory('post')->get_unanswered_questions($page_number, $page_size);

        //-- Set Pagination
        $this->set_pagination('questions/unanswered', $total_items, $page_size);

        //-- Render View
        $this->template->content = View::factory('themes/default/question_list')
            ->bind('questions', $questions);
    }

    /**
     * Setup Pagination Property for Website_Controller
     *
     * @param string $base_url
     * @param int $total_items
     * @param int $items_per_page
     */
    private function set_pagination($base_url, $total_items, $items_per_page)
    {
        $this->pagination = Pagination::factory();
        $this->pagination->initialize(array(
            'base_url'          => $base_url
            , 'uri_segment'     => 'page'
            , 'total_items'     => $total_items
            , 'items_per_page'  => $items_per_page
        ));
    }

    /**
     * Increase Question View Count by 1
     *
     * @param int $question_id
     */
    private function increase_view_count($question_id)
    {
        //-- Initialise Model
        $question = ORM::factory('post', $question_id);

        //--NOTE: Currently using linear incremental on view count, which means every refresh will increase this count
        $question->view_count += 1;
        $question->save();
    }

    //----------------------- PLACE HOLDERS --------------------------//

    /**
     * View Questions Contain Matching Tag
     */
    public function tagged($tag_slug)
    {
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * Search Questions with Specified Criteria
     */
    public function search($query='', $page_number=1, $page_size=25)
    {
        //-- Detect a Post Back
        if($_POST)
        {
            $post = Validation::factory($_POST);
            //...
        }
        else
        {
            //...
        }
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * Display RSS Feed for all Questions
     */
    public function feed_all()
    {
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * Display RSS feed for a Question and its Answers
     */
    public function feed($question_id)
    {
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * Edit an Existing Question
     */
    public function edit($question_id)
    {
        $this->template->content = "Method Not Implemented Yet.";
    }
    
}//END class