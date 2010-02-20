<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * The routing configurations of the Qanda.
 *
 * @package Qanda
 */

/**
 * Sets the default route
 */
$config['_default'] = 'questions/show';

/**
 * Questions Listing and Pagination
 */
$config['questions/'] = 'questions/show/';
$config['questions/page/([0-9]+)'] = 'questions/show/$1';

/**
 * Unanswered Questions and Pagination
 */
$config['questions/unanswered'] = 'questions/unanswered/';
$config['questions/unanswered/page/([0-9]+)'] = 'questions/unanswered/$1';
