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
class DelegateValidator implements ValidatorInterface
{
	/**
	* @var ValidatorInterface[]
	*/
	private $validators;
	
	public function __construct(array $validators)
	{
		foreach($validators as $validator)
		{
			if (!$validator instanceof ValidatorInterface)
				throw new \InvalidArgumentException(sprintf(
					"Validator is not instance of %s. Given %s.",
					ValidatorInterface::class,
					get_class($validator)
				));
				
			$this->validators[] = $validator;
		}
	}
	
	/**
	* Validate object
	* 
	* @param object $object
	* @param array $contexts
	* 
	* @return void
	* @throws
	*/
	public function validate($object, array $contexts = [])
	{
		foreach($this->validators as $validator)
		{
			if ($validator->support($object))
			{
				$validator->validate($object, $contexts);
				return;
			}	
		}
	}
	
	/**
	* Checks if validator supportsan object
	* 
	* @param object $object
	* 
	* @return bool
	*/
	public function support($object)
	{
		foreach($this->validators as $validator)
		{
			if ($validator->support($object))
				return true;
		}
		
		return false;
	}
}
