<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class SubjectTypeGetter implements SubjectTypeGetterInterface
{
	/**
	* @var string[]
	*/
	protected $classes;
	
	/**
	* @var callable
	*/
	protected $func;
	
	public function __construct($class, $func)
	{
		if (is_string($class))
			$classes = array($class);
		else if (is_array($class))
			$classes = $class;
		else
			throw new \InvalidArgumentException(sprintf(
				"Argument 1 of SubjectTypeGetter must be string or array. Given %s.", gettype($class)
			));
			
		foreach($classes as $class)
		{
			if (!class_exists($class))
				throw new \InvalidArgumentException("Class $class not exists.");
		}
		if (!is_callable($func))	
			throw new \InvalidArgumentException("Argument 2 must be callable.");
			
		$this->classes = $classes;
		$this->func = $func;
	}

	/**
	* @inheritdoc
	*/
	public function support($subject)
	{
		foreach($this->classes as $class)
		{
			if ($subject instanceof $class)
				return true;
		}
		
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function getSubjectType($subject)
	{
		if (!$this->support($subject))
			throw new \UnexpectedValueException(sprintf(
				"Getter only supports for one of subject classes [%s]. Given %s.",
				implode(", ", $this->classes), get_class($subject)
			));
			
		return call_user_func($this->func, $subject);
	}
}
