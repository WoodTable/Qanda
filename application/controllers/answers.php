<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Answers Controller.
 *
 * @package Qanda
 * @subpackage Answer
 */

/**
 * Qanda Answers Controller for all Answer Related Tasks.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Answer
 * @uses Website_Controller Extends class
 */
class Answers_Controller extends Website_Controller
{

    /**
     * Answers Controller Constructor
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
     * Edit Answers Action
     */
    public function edit($answer_id)
    {
        //TODO: Implement this method
    }

    /**
     * Delete Answers Action
     */
    public function delete($answer_id)
    {
        //TODO: Implement this method
    }

}//END class