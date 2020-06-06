<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.9
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
Use Skytells\Core;
use Skytells\Core\Runtime;
Class Driver {
	protected $_parent;
	protected $_methods = array();
	protected $_properties = array();
	protected static $_reflections = array();
	public function Init($parent) {
		$this->_parent = $parent;
		$class_name = get_class($parent);

		if ( ! isset(self::$_reflections[$class_name]))
		{
			$r = new ReflectionObject($parent);

			foreach ($r->getMethods() as $method)
			{
				if ($method->isPublic())
				{
					$this->_methods[] = $method->getName();
				}
			}

			foreach ($r->getProperties() as $prop)
			{
				if ($prop->isPublic())
				{
					$this->_properties[] = $prop->getName();
				}
			}

			self::$_reflections[$class_name] = array($this->_methods, $this->_properties);
		}
		else
		{
			list($this->_methods, $this->_properties) = self::$_reflections[$class_name];
		}
	}

	public function __call($method, $args = array()) {
		if (in_array($method, $this->_methods)) {
			return call_user_func_array(array($this->_parent, $method), $args);
		}

		throw new \BadMethodCallException('No such method: '.$method.'()');
	}

	public function __get($var) {
		if (in_array($var, $this->_properties))
		{
			return $this->_parent->$var;
		}
	}

	public function __set($var, $val) {
		if (in_array($var, $this->_properties)) {
			$this->_parent->$var = $val;
		}
	}

}
