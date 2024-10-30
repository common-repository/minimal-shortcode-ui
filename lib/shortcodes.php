<?php
namespace Sui;

require_once 'abstract/shortcode.php';

/**
 * Shortcode factory
 *
 * Holds a global registry of shortcode objects that extend Sui\Shortcode.
 * 
 * Use Shortcodes::register('ShortcodeYourShortcodeName') to register your shortcode.
 * Use Shortcodes::unregister('ShortcodeYourShortcodeName') to unregister registered shortcodes.
 * Use Shortcodes::loadShortcodeFiles('/yourdir') to load all .php files in that dir.
 * Use Shortcodes::clear() to unregister all registered shortcodes.
 * Use Shortcodes::registration() to get an array of Sui/Shortcode extended objects.
 *
 * Please see the Sui\Shortcode documentation for creating a registrable Shortcode object.
 *
 * @copyright Copyright (c) Dutchwise V.O.F. (http://dutchwise.nl)
 * @author Max van Holten (<max@dutchwise.nl>)
 * @license http://www.opensource.org/licenses/mit-license.php MIT license
 */
class Shortcodes {
	
	/**
	 * Contains all registered shortcodes.
	 *
	 * @var array
	 */
	protected static $_shortcodes = array();
	
	/**
	 * The directory with all shortcode class files.
	 * This path is relative to the file where this
	 * class is located.
	 *
	 * @var string
	 */
	protected static $_dir = 'shortcodes/';
	
	/**
	 * Returns the full absolute path to the directory
	 * where all shortcode class files are located.
	 *
	 * @return string
	 */
	protected static function _getDefaultShortcodeDirectory() {
		return dirname(__FILE__) . DIRECTORY_SEPARATOR . self::$_dir;
	}
	
	/**
	 * Loads all shortcode class files that should contain
	 * a static call to this class ::register function.
	 *
	 * @param string $dir (optional) Default directory may be used
	 * @return boolean
	 */
	public static function loadShortcodeFiles($dir = null) {
		if(!is_dir($dir)) {
			return false;
		}
		
		if(is_null($dir)) {
			$dir = self::_getDefaultShortcodeDirectory();
		}
		else {
			$dir = rtrim($dir, '/\\') . DIRECTORY_SEPARATOR;
		}
		
		$query = "{$dir}*.php";
		$paths = glob($query);
		
		// load the shortcodes
		foreach($paths as $path) {
			if(is_file($path) && file_exists($path)) {
				include $path;
			}
		}
		
		return true;
	}
	
	/**
	 * Registers a shortcode with WordPress.
	 *
	 * @param string $classname
	 * @return boolean
	 */
	public static function register($classname) {		
		if(!is_subclass_of($classname, '\Sui\Shortcode')) {
			return false;
		}
		
		$shortcode = new $classname();
		$tagName = $shortcode->getTagName();
		
		if(false !== apply_filters('sui_shortcodes_before_add', $shortcode)) {
			add_shortcode($tagName, array($shortcode, 'render'));
		}
		if(false !== apply_filters('sui_shortcodes_before_register', $shortcode)) {
			self::$_shortcodes[$tagName] = $shortcode;
		}
		
		return true;
	}
	
	/**
	 * Unregisters a shortcode with WordPress.
	 *
	 * Accepts either a shortcode object, registered tagname
	 * or the shortcode classname.
	 *
	 * @param string|\Sui\Shortcode $shortcode
	 * @return boolean
	 */
	public static function unregister($shortcode) {
		$tagName = false;
		
		// accepts the shortcode object
		if(is_object($shortcode) && $shortcode instanceof \Sui\Shortcode) {
			$tagName = $shortcode->getTagName();
		}
		// accepts a registered shortcode tagname
		elseif(is_string($shortcode) && array_key_exists($shortcode, self::$_shortcodes)) {		
			$tagName = self::$_shortcodes[$shortcode]->getTagName();
		}
		// accepts a shortcode tagname
		elseif(is_string($shortcode) && is_subclass_of($shortcode, '\Sui\Shortcode')) {
			$shortcode = new $shortcode();
			$tagName = $shortcode->getTagName();
		}
		
		if($tagName) {
			if(false !== apply_filters('sui_shortcodes_before_remove', $shortcode)) {
				remove_shortcode($tagName);
			}
			if(false !== apply_filters('sui_shortcodes_before_unregister', $shortcode)) {
				unset(self::$_shortcodes[$tagName]);
			}
		}
		
		return true;
	}
	
	/**
	 * Unregisters all shortcodes that were added by this class.
	 *
	 * @return int
	 */
	public static function clear() {
		$count = 0;
		
		foreach(self::$_shortcodes as $shortcode) {
			if(self::unregister(get_class($shortcode))) {
				$count++;
			}
		}
		
		return $count;
	}
	
	/**
	 * Retrieves the shortcode object either by tagName 
	 * or by className (if registered).
	 * 
	 * @param string $identifier
	 * @return object|null
	 */
	public static function get($identifier) {
		// check if dealing with classname and convert to tagname	
		if(is_subclass_of($identifier, '\Sui\Shortcode')) {
			$temp_object = new $identifier();
			$identifier = $temp_object->getTagName();
			unset($temp_object);
		}
		
		$result = null;
		
		// look up shortcode object by tagname
		if(isset(self::$_shortcodes[$identifier])) {
			$result = self::$_shortcodes[$identifier];
		}
		
		$result = apply_filters('sui_shortcodes_get', $result, $identifier);
		
		return $result;
	}
	
	/**
	 * Checks if the shortcode object is registered,
	 * either by tagName or by className.
	 *
	 * @param string $identifier
	 * @return boolean
	 */
	public static function exists($identifier) {
		$object = self::get($identifier);
		return is_object($object);
	}
	
	/**
	 * Returns all registered shortcodes.
	 *
	 * @return array
	 */
	public static function registration() {
		do_action('sui_shortcodes_before_registration', self::$_shortcodes);
		
		$shortcodes = self::$_shortcodes;
		
		ksort($shortcodes);
		
		$shortcodes = apply_filters('sui_shortcodes_registration', $shortcodes);
		
		return $shortcodes;
	}
	
	/**
	 * Returns a JSON string of all registered shortcodes.
	 *
	 * @return string
	 */
	public static function json() {
		return json_encode(self::$_shortcodes);
	}
	
}