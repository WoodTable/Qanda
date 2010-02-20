<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Badges Controller.
 *
 * @package Qanda
 * @subpackage Badge
 */

/**
 * Qanda Badges Controller for all Badge Related Tasks.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Badge
 * @uses Website_Controller Extends class
 */
class Badges_Controller extends Website_Controller
{

    /**
     * Badges Controller Constructor
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
        //-- Reroute to 'show' action
        $this->show();
    }

    /**
     * Show a List of Badges
     */
    public function show($current_page=1, $page_count=10, $sort_by='popular')
    {
        //-- Model
        $badges = ORM::factory('badge');
        $badges = $badges->orderby('name', 'asc')
            ->where('is_deleted', 0)
            ->find_all();

        //-- Render View
        $this->template->content = View::factory('themes/default/badge_list')
            ->bind('badges', $badges);
    }

    /**
     * View Details of a Badge
     */
    public function detail($badge_id, $slug='')
    {
        //TODO: Implement this method
    }
    
    /**
     * Search Badges with Specified Criteria
     */
    public function search($query)
    {
        //TODO: Implement this method
    }
    
}//END class