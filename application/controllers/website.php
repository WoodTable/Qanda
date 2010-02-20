<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Qanda Website Controller.
 *
 * @package Qanda
 * @subpackage Website
 */

/**
 * Qanda Website Controller Extending All Application Controllers
 *
 * @since 1.0.0
 * @package Qanda
 * @subpackage Website
 * @uses Template_Controller Extends class
 */
class Website_Controller extends Template_Controller
{
    //-- Global
    public $template = 'themes/default/master'; // In application/views folder
    //public $auto_render = TRUE;               // Not used
    //protected $db;                            // Not used
    //protected $session;                       // Not used
    
    /**
     * Website Controller Constructor
     */
	public function __construct()
	{
		parent::__construct();

        //-- Enable Session on All Pages
        //$this->session = Session::instance(); // Not used

        //-- Template Head
        $this->head = Head::instance();
        $this->head->css->append_file('media/themes/default/css/layout');
        $this->head->title->set('Qanda Website Title');
        $this->template->head = $this->head;

        //-- Template Global Variables
        $this->template->set_global('theme_url', 'themes/default/');
	}

}//END class