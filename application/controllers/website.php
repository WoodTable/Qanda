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
    //-- Global Variables
    public $template = 'themes/default/master'; // In application/views folder
    //public $auto_render = TRUE;               // Not used
    //protected $db;                            // Not used
    //protected $session;                       // Not used
    protected $settings;
    
    /**
     * Website Controller Constructor
     */
	public function __construct()
	{
		parent::__construct();

        //-- Enable Session on All Pages
        //$this->session = Session::instance(); // Not used

        //-- Load Settings
        $this->settings = ORM::factory('setting');
        $this->settings->autoload();

        //-- Template Head
        $this->head = Head::instance();
        $this->head->css->append_file('media/themes/'.$this->settings->get('current_theme').'/css/layout');
        $this->head->title->set($this->settings->get('site_name'));
        $this->template->head = $this->head;

        //-- Template Global Variables
        $this->template->set_global('theme_url', 'themes/'.$this->settings->get('current_theme').'/');
	}

    //----------------------- PUBLIC METHODS --------------------------//

    //----------------------- STATIC METHODS --------------------------//

    /**
     * Create Log Record
     *
     * @param string $activity
     * @param string $object_type
     * @param int $object_id
     * @static
     * @uses Activity_Model::log()
     */
    protected function log_activity($activity, $object_type, $object_id)
    {
        //-- Log User View Activity
        $authentic = Auth::factory();
        if ($authentic->logged_in())
        {
            $user = $authentic->get_user();
            ORM::factory('activity')->log($user->id, $activity, $object_type, $object_id);
        }
    }

    //----------------------- PRIVATE METHODS --------------------------//

}//END class