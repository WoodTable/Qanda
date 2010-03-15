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
    
    //----------------------- PLACE HOLDERS --------------------------//

    /**
     * Browse a List of Badges
     *
     * @param string $order_by
     */
    public function browse($order_by='active')
    {
        $this->template->content = "Method Not Implemented Yet.";
    }

    /**
     * View owners of a badge
     *
     * @param int $badge_id
     * @param string $slug
     * @param string $filler Does nothing
     * @param int $page_number
     * @param string $order_by
     * @param int $page_size
     */
    public function detail($badge_id, $slug='', $filler='page', $page_number=1, $order_by='votes', $page_size=25)
    {
        $this->template->content = "Method Not Implemented Yet.";
    }
    
    /**
     * Search Badges with Specified Criteria
     */
    public function search($query)
    {
        $this->template->content = "Method Not Implemented Yet.";
    }
    
}//END class