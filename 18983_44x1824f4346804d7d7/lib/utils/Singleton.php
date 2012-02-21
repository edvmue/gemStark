<?php
/**
* singleton design pattern.
*/
class Singleton
{
	var $instances = array();
	function Singleton() {}

	function &instance($class)
	{
		//echo "find $class in " . print_r($this->instances, true) . "? <br />";
		if( !isset($this->instances[$class]))
		{
			//echo "load new $class <br />";
			$this->instances[$class] = new $class();
		}
		$pointer = &$this->instances[$class];
		return $pointer;
	}
}




/**
* funktion zum pointer zurückgeben von klassen.
* @param string className
* @return pointer instanceOfClassName
*/
function &singleton($class)
{
	static $singleton;
	if(!is_object($singleton))
	{
		$singleton = new Singleton();
	}
	return $singleton->instance($class);
}