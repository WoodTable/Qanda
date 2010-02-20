<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Text Helper Class Extended.
 *
 * @package    Qanda
 * @subpackage Helper
 */
class text extends text_Core
{

    /**
     * Slugify a String of Words
     *
     * Modifies a string to remove al non ASCII characters and spaces.
     * 
     * @link    http://snipplr.com/view.php?codeview&id=22741
     */
    /***travo20100131: Deprecated as it does same thing as url::title();
    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
    */
    
}//END class