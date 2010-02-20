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

}//END class