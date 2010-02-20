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
     * Default Landing Action
     */
    public function index()
    {
        //TODO: Implement this method
    }

    /**
     * Show comments of a Question or an Answer
     */
    public function show($post_id)
    {
        //TODO: Implement this method
    }

    /**
     * Add a New Comment
     */
    public function add($post_id)
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