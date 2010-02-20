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
     * Default Landing Action
     */
    public function index()
    {
        //-- Reroute
        $this->show();
    }

    /**
     * Show a List of Users
     */
    public function show()
    {
        //TODO: Cater pagination
        //-- Model
        $users = ORM::factory('user')->list_all_users();

        //-- Render View
        $this->template->content = View::factory('themes/default/user_list')
            ->bind('users', $users);
    }

    /**
     * View User Details
     */
    public function detail($username)
    {
        //-- Model
        $user = ORM::factory('user')->get($username);
        
        //-- Render View
        $this->template->content = View::factory('themes/default/user_detail')
            ->bind('user', $user);
    }

    /**
     * User Login
     */
    public function login()
    {
        if(Auth::instance()->logged_in())
        {//-- Already logged in as someone
            //TODO: Display 'Already Logged In' Error Page
            $this->template->content = "You have already logged in.";
        }
        elseif($_POST)
        {//-- Submitting login form
            $post = Validation::factory($_POST);

            //TODO: Sanitise user input
            $username = $post->username;
            $password = $post->password;

            $user = ORM::factory('user', $username);
            $this->auth = Auth::factory();

            if (!$user->loaded)
            {//-- No matching Username
                //TODO: Display 'Login Unsuccessful' Error Page
                $post->add_error('username', 'not_found');
                $this->template->content = "username not found";
            }
            elseif ($this->auth->login($user, $password))
            {
                //-- Login Success, Redirect
                //TODO: Provide Dynamic Redirect Location
                url::redirect('/');
            }
            else
            {//-- Incorrect Password
                //TODO: Display 'Login Unsuccessful' Error Page
                $post->add_error('password', 'incorrect_password');
                $this->template->content = "password don't match";
            }
        }
        else
        {//-- Show Login Form
            //-- Render View
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
        //TODO: Provide Dynamic Redirect Location
        url::redirect('/');
    }

    /**
     * Edit an Existing User
     */
    public function edit($user_id)
    {
        //TODO: Implement Edit User
    }

    /**
     * Register a new User
     */
    public function register()
    {
        if(Auth::instance()->logged_in())
        {//-- If already an existing login session, display error
            //TODO: Display 'Already Logged In' Error Page
            $this->template->content = "You have already logged in.";
        }
        elseif($_POST)
        {//-- Submitting register form

            $post = Validation::factory($_POST);

            //TODO: Sanitise user input
            $username = $post->username;
            $email = $post->email;
            $password = $post->password;
            $password_confirm = $post->password_confirm;
            $role_name = 'login';

            if($password != $password_confirm)
            {
                //TODO: Display 'Passwords Not Match' Error Page
            }

            //TODO: Check if username already exists (filter deleted records)
            //TODO: Check if email already exists (filter deleted records)

            //-- Create new user
            $user = ORM::factory('user');
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;

            if($user->add(ORM::factory('role', $role_name)) AND $user->save())
            {
                //-- Login using the collected data
                Auth::instance()->login($username, $password);
                //-- Redirect
                //TODO: Set Dynamic Redirect Location
                url::redirect('users');
            }
        }
        else
        {//-- Show Register Form
            //-- Render View
            $this->template->content = View::factory('themes/default/user_register');
        }
    }

    /**
     * List Users Owns Specified Badge
     */
    public function badged($badge_id, $badge_slug)
    {
        //TODO: Implement this method
        $this->template->content = "Method Not Implemented Yet.";
    }

}//END class