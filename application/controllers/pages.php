<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Pages Controller.
 *
 * @package Qanda
 * @subpackage Page
 */

/**
 * Qanda Pages Controller for all Page Related Tasks.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Page
 * @uses Website_Controller Extends class
 */
class Pages_Controller extends Website_Controller
{

    /**
     * Pages Controller Constructor
     */
    public function __construct()
    {
        parent::__construct(); //-- This must be included
    }

    /**
     * Default Landing Action
     */
    public function index($page_id, $slug='')
    {
        //-- Reroute
        return $this->detail($page_id);
    }

    /**
     * Display Static Page
     */
    public function detail($page_id)
    {
        //TODO: Implement this method
    }

}//END class