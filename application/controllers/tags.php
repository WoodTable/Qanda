<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Tags Controller.
 *
 * @package Qanda
 * @subpackage Tag
 */

/**
 * Qanda Tags Controller for all Tag Related Tasks.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Tag
 * @uses Website_Controller Extends class
 */
class Tags_Controller extends Website_Controller
{

    /**
     * Tags Controller Constructor
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
     * Show a List of Tags
     */
    public function show($current_page=1, $page_count=10, $sort_by="popular")
    {
        //-- Model
        $tags = ORM::factory('tag');
        $tags = $tags->orderby('post_count', 'desc')
            ->where('is_deleted', 0)
            ->find_all();

        //-- Render View
        $this->template->content = View::factory('themes/default/tag_list')
            ->bind('tags', $tags);
    }

    /**
     * Edit an Existing Tag
     */
    public function edit($tag_id)
    {
        //TODO: Implement this method
    }

    /**
     * Merge an Existing Tag into another Tag
     *
     * There will be no 'delete' method for tags. Merge will be the
     * only method to remove them.
     */
    public function merge($unwanted_tag_id, $merge_tag_id)
    {
        //TODO: Implement this method
    }

}//END class