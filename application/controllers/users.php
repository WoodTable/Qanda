<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Users Controller.
 *
 * @package Qanda
 * @subpackage User
 */

/**
 * Qanda Users Controller for all User Related Tasks.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage User
 * @uses Website_Controller Extends class
 */
class Users_Controller extends Website_Controller
{

    /**
     * Users Controller Constructor
     */
    public function __construct()
    {
        parent::__construct(); //-- This must be included
    }

    /**
     * Show a List of Users
     *
     * @uses User_Model::list_all_users()
     */
    public function browse()
    {
        //TODO: Error handling
        //TODO: Cater pagination
        //-- Model
        $users = ORM::factory('user')->list_all_users();

        //-- Render View
        $this->template->content = View::factory('themes/default/user_list')
            ->bind('users', $users);
    }

    /**
     * View User Details
     *
     * @param string $username
     * @uses Post_Model::get_asked_questions()
     * @uses Post_Model::get_answered_questions()
     * @uses Tag_Model::get_involved_tags()
     */
    public function detail($username)
    {
        //-- Get User
        $user = ORM::factory('user')->get($username);

        //-- Get User Involvements
        //TODO: Paginate it
        $asked_questions    = ORM::factory('post')->get_asked_questions($user->id);
        //TODO: Paginate it
        $answered_questions = ORM::factory('post')->get_answered_questions($user->id);
        //TODO: Limit Number of Tags Shown (instead of Paginate)
        $involved_tags      = ORM::factory('tag')->get_inolved_tags($user->id);
        
        //-- Render View
        $this->template->content = View::factory('themes/default/user_detail')
            ->bind('user', $user)
            ->bind('asked_questions', $asked_questions)
            ->bind('answered_questions', $answered_questions)
            ->bind('involved_tags', $involved_tags)
            ;
    }

    /**
     * User Login
     *
     * @uses User_Model::authenticate()
     */
    public function login()
    {
        if(Auth::instance()->logged_in())
        {//-- Already logged in as someone
            //TODO: Display 'Already Logged In' Error Page
            throw new Kohana_User_Exception('Already Logged In.', 'You have already logged in to the website');
        }
        elseif($_POST)
        {//-- Detect a Post Back
            $post = Validation::factory($_POST);

            //-- Attemp to Login
            try
            {
                ORM::factory('user')->authenticate($post);
            }
            catch(Exception $ex)
            {
                //TODO: Instead of throw Kohana Error page, redirect back to this method with error message displayed.
                throw new Kohana_User_Exception('Fail to Login.', 'Cannot login. Caught exception: '.$ex->getMessage());
            }

            //-- Login Success, Redirect
            if(isset($post->redirect_url))
                url::redirect($post->redirect_url);
            else
                url::redirect('/');
        }
        else
        {
            //-- Show Login Form
            $this->template->content = View::factory('themes/default/user_login');
        }
    }

    /**
     * User Log Out
     */
    public function logout()
    {
        //-- Log Out
        Auth::instance()->logout();

        //-- Redirect
        $get = Validation::factory($_GET);
        if(isset($get->redirect_url))
        {
            url::redirect($get->redirect_url);
        }
        else
        {
            url::redirect('/');
        }
    }

    /**
     * Register as a new User
     */
    public function register()
    {
        //-- Verify Currnet Authentication
        if(Auth::instance()->logged_in())
        {//-- Display 'Already Logged In' message
            //TODO: Display proper 'Already Logged In' page and provide link to log out
            throw new Kohana_User_Exception('Already Logged In.', 'You have already logged in to the website');
        }
        elseif($_POST)
        {//-- Detects a Post Back
            $post = Validation::factory($_POST);

            //-- Create new User
            try
            {
                $user_id    = ORM::factory('user')->create($post);
            }
            catch(Exception $ex)
            {
                //TODO: Instead of throw Kohana Error page, redirect back to this method with error message displayed.
                throw new Kohana_User_Exception('Fail to Create User.', 'Cannot create user. Caught exception: '.$ex->getMessage());
            }

            //-- Load this User
            $user = ORM::factory('user', $user_id);

            //-- Login using the collected data
            Auth::instance()->login($user->username, $post->password);

            //-- Redirect
            url::redirect('/users/detail/'.$user->username);
        }
        else
        {
            //-- Display User Registration Form
            $this->template->content = View::factory('themes/default/user_register');
        }
    }
    
    //----------------------- PLACE HOLDERS --------------------------//

    /**
     * Edit an Existing User
     */
    public function edit($user_id)
    {
        $this->template->content = "Method Not Implemented Yet.";
    }

}//END class