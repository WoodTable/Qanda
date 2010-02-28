<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Qanda Users Model.
 *
 * @package Qanda
 * @subpackage User
 */

/**
 * Qanda Users Model.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage User
 * @uses ORM Extends class
 */
class User_Model extends Auth_User_Model
{

    /**
     * List All Users
     *
     * @return ORM_Iterator
     */
    public function list_all_users()
    {
        //-- Query
        $users = $this->orderby('reputation_score', 'desc')
            ->where('is_deleted', 0)
            ->find_all();

        //-- Output
        return $users;
    }

    /**
     * List All Users
     *
     * @param string $username
     * @return User_Model
     */
    public function get($username)
    {
        //-- Query
        $user = $this->where('username', $username)
            ->where('is_deleted', 0)
            ->find();
        //-- Output
        return $user;
    }

    /**
     * Create a New User
     *
     * @param Validation_Object $post
     * @return int Id of the newly created user
     */
    public function create($post)
    {
        //-- Fetch User Input
        $username           = $post->username;
        $email              = $post->email;
        $password           = $post->password;
        $password_confirm   = $post->password_confirm;
        $role_name          = 'login';

        //-- Sanitize
        if($username == '')
            throw new Exception('Username field is required.');
        //TODO: Verify existance of this username
        if($email == '')
            throw new Exception('Email field is required.');
        if(valid::email_rfc($email) == FALSE)
            throw new Exception('Invalid email address format.');
        //TODO: Verify existance of this email
        if($password == '')
            throw new Exception('Password field is required.');
        if($password != $password_confirm)
        {
            throw new Exception('Retype password does not match.');
        }

        //-- Create new user
        $user = ORM::factory('user');
        $user->username                 = $username;
        $user->email                    = $email;
        $user->password                 = $password;
        $user->activation_key           = strtolower(text::random('alnum', 32));
        $user->last_activity_date       = date('Y-m-d H:i:s', time());
        $user->last_ip_address          = Input::instance()->ip_address();
        $user->last_user_agent          = Kohana::user_agent();
        $user->consecutive_visit_day    = 1;
        $user->date_created             = date('Y-m-d H:i:s', time());
        $user->created_by               = 'user::create_user';

        //-- Insert user and its role
        if($user->add(ORM::factory('role', $role_name)) AND $user->save())
        {
            return $user->id;
        }
        else
        {
            throw new Exception('Failed to save user and/or create its role.');
        }
    }

    /**
     * Authenticate an User
     *
     * @param Validation_Object $post
     */
    public function authenticate($post)
    {
        //-- Local Variables
        $username = $post->username;
        $password = $post->password;

        //-- Sanitize
        if($username == '')
            throw new Exception('Username field is required');
        if($password == '')
            throw new Exception('Password field is required');

        //-- Authorise
        //TODO: Catch error upon $auth->login()
        $user = ORM::factory('user', $username);
        $auth = Auth::factory();

        if (!$user->loaded)
        {//-- No matching Username
            throw new Exception('Username not found.');
        }
        elseif ($auth->login($user, $password))
        {//-- Login Success
            return;
        }
        else
        {//-- Incorrect Password
            throw new Exception('Incorrect password.');
        }
    }

}//END class