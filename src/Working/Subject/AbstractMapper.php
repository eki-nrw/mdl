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

use Eki\NRW\Mdl\Working\ObjectBuilderInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractMapper implements MapperInterface
{
	/**
	* @var object
	*/	
	private $subject;
	
	/**
	* @inheritdoc
	*/
	public function assignSubject($subject)
	{
		$this->validateAssignSubject($subject);
		
		$this->subject = $subject;
	}
	
	/**
	* Validate Assign subject
	* 
	* @param object $subject
	* 
	* @return void
	* @throws
	*/
	protected function validateAssignSubject($subject)
	{
		//...
	}
	
	/**
	* Returns subject
	* 
	* @return object
	*/
	protected function getSubject()
	{
		return $this->subject;
	}
	
	/**
	* @inheritdoc
	*/
	public function map($name, $type, $data)
	{
		if (!$this->mapSupport($name, $type, $data))
			throw new \InvalidArgumentException(sprintf('Cannot found %s element to map.', $name));

		if (method_exists($this, ($method = 'map'.$this->changeSuffixMethodNameFromString($name))))
			return $this->$method($type, $data);	
	}
	
	/**
	* @inheritdoc
	*/
	public function support($name, $type, $data)
	{
		$method = 'map'.$this->changeSuffixMethodNameFromString($name);
		
		$methodSupport = $method . "Support";
		if (method_exists($this, $methodSupport))
		{
			 return $this->$methodSupport($type, $data);
		}
		
		return method_exists($this, $method);
	}
	
	/**
	* Helper 
	* 
	* @param string $str
	* @param bool $first The first element in iteration changed or not
	* 
	* @return string
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
