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
}//END class