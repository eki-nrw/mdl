<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Subject\Utils;

use Eki\NRW\Mdl\Working\Subject\AbstractCallback;

use PHPUnit\Framework\TestCase;
use stdClass;

class CallbackUtils
{
	public function __createMock(
		TestCase $testCase,
		$class,   // class name to create mock
		array $props = [], 
		$isProperty = null, 
			// true: set properties for mock; 
			// false: use getter/setter; 
			// null: depends on $props
		$init = null,  // true: init prop by value; false: init prop by null; null: do nothing
		$getting = null, 
			// true: create get methods for mock
			// false: do not create get methods for mock
			// null: depends on $isProperty
		$setting = null,
			// true: create set methods for mock
			// false: do not create set methods for mock
			// null: depends on $isProperty
		$moreMethods = []  // More methods for some actions later
	)
	{
		if ($isProperty === null)
		{
			$isProperty = !empty($props);
		}
		if ($getting === null)
		{
			$getting = !$isProperty;
		}
		if ($setting === null)
		{
			$setting = !$isProperty;
		}
		
		if ($isProperty)
		{
			if (empty($moreMethods))
				$mock = $testCase->getMockBuilder($class)
					->disableOriginalConstructor()
					->getMock()
				;
			else
				$mock = $testCase->getMockBuilder($class)
					->setMethods($moreMethods)
					->disableOriginalConstructor()
					->getMock()
				;
			
			foreach($props as $propName => $propValue)
			{
				if ($init === true)
					$mock->$propName = $propValue;
				else if ($init === false)
					$mock->$propName = null;
			}
		}
		else  // getter/setter
		{
			$nameMethods = [];
			if ($getting)
			{
				$nameGetMethods = [];
				foreach($props as $name => $propValue)
				{
					$nameMethods[] =
					$nameGetMethods[$name] = 'get'.$this->changeSuffixMethodNameFromString($name);
				}
			}
			if ($setting)
			{
				$nameSetMethods = [];
				foreach($props as $name => $propValue)
				{
					$nameMethods[] =
					$nameSetMethods[$name] = 'set'.$this->changeSuffixMethodNameFromString($name);
				}
			}

			$mock = $testCase->getMockBuilder($class)
				->setMethods($nameMethods+$moreMethods)
				->getMockForAbstractClass()
			;

			$bag = new stdClass;
			foreach($props as $name => $propValue)
			{
				if ($init === true)
					$bag->$name = $propValue;
				else if ($init === false)
					$bag->$name = null;
			}
			
			if ($getting)
			{
				foreach($nameGetMethods as $name => $nameMethod)
				{
					$mock
						->expects($testCase->any())
						->method($nameMethod)
						->will($testCase->returnCallback(
							function () use ($name, $props, &$bag, $init) 
							{
								return $bag->$name;
							}
						))
					;
				}
			}

			if ($setting)
			{
				foreach($nameSetMethods as $name => $nameMethod)
				{
					$mock
						->expects($testCase->any())
						->method($nameMethod)
						->will($testCase->returnCallback(
							function ($val) use ($name, &$bag)
							{
								$bag->$name = $val;
							}
						))
					;
				}
			}
		}
		
		return $mock;
	}

	public function createCallback(
		TestCase $testCase,
		array $props = [], 
		$isProperty = null, $init = null, 
		$getting = null, $setting = null,
		$addProps = []
	)
	{
		$moreMethods = [];			
		if (!empty($addProps))
		{
			foreach($addProps as $propName => $propValue)
			{
				$moreMethods[] = 'add'.$this->changeSuffixMethodNameFromString($propName);
			}
		}

		$callback = $this->__createMock($testCase, AbstractCallback::class, 
			$props, $isProperty, $init, $getting, $setting, 
			$moreMethods
		);
		
		foreach($moreMethods as $m)
		{
			$callback
				->expects($testCase->any())
				->method($m)
				->will($testCase->returnCallback(function ($type, $data) {
					//...
				}))
			;
		}
		
		return $callback;
	}

	/**
	* Helper 
	* 
	* @param string $str
	* @param bool $first The first element in iteration changed or not to capital letter
	* 
	* @return string
	* 
	* Ex:.
	* + $str="abc_def_123": if $first=true, return "AbcDef123", if $first=false, return "abcdef123"
	* 
	*/
	private function changeSuffixMethodNameFromString($str, $first = true)
	{
		$suffix = '';
		$counter = 0;
		foreach(explode("_", $str) as $piece)
		{
			$suffix .= ( ($counter === 0 and $first === false) ? $piece : ucfirst($piece) );
			$counter++;
		}
		
		return $suffix;
	}
}
