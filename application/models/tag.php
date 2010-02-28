<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Qanda Tags Model.
 *
 * @package Qanda
 * @subpackage Tag
 */

/**
 * Qanda Tags Model.
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Tag
 * @uses ORM Extends class
 */
class Tag_Model extends ORM
{
    protected $has_and_belongs_to_many = array('posts');

    /**
     * Set Tag Involvement of User
     *
     * @param int $tag_id
     * @param int $user_id
     */
    public function set_user_involvement($tag_id, $user_id)
    {
        //-- Attempt to Fetch Existing Tag Involvement
        $tags_user = ORM::factory('tags_user')->where('tag_id', $tag_id)
            ->where('user_id', $user_id)
            ->where('relation_type', 'involved')
            ->find();

        if($tags_user->id == 0)
        {//-- Create new Tag Involvement
            $tags_user->user_id         = $user_id;
            $tags_user->tag_id          = $tag_id;
            $tags_user->relation_type   = 'involved';
            $tags_user->post_count      = 1;
            $tags_user->date_created    = date('Y-m-d H:i:s', time());
            $tags_user->created_by      = 'tag::set_user_involvement';
            $tags_user->save();
        }
        else
        {
            //-- Check Tag Involvement Status
            if($tags_user->is_deleted == 1)
            {//-- Revitalise it
                $tags_user->post_count      = 1;
                $tags_user->date_modified   = date('Y-m-d H:i:s', time());
                $tags_user->modified_by     = 'tag::set_user_involvement';
                $tags_user->is_deleted      = 0;
                $tags_user->save();
            }
            else
            {//-- Increment Count
                $tags_user->post_count     += 1;
                $tags_user->date_modified   = date('Y-m-d H:i:s', time());
                $tags_user->modified_by     = 'tag::set_user_involvement';
                $tags_user->save();
            }
        }
    }



}//END class