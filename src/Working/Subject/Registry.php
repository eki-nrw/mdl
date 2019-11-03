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

use Eki\NRW\Common\Res\Factory\FactoryInterface;
use Eki\NRW\Mdl\Working\ObjectBuilderInterface;

use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Registry
{
	/**
	* Type name of registry
	* 
	* @var string
	*/
	private $type;

	/**
	* Full qualified class name of subject
	* 
	* @var string|object
	* 
	*/	
	private $subjectInfo;
	
	/**
	* Full qualified class name of callback
	* 
	* @var string|CallbackInterface
	* 
	*/
	private $callbackInfo;
	
	/**
	* Full qualified class name of importor
	* 
	* @var array(string|ImportorInterface)
	* 
	*/
	private $importorInfo;
	
	/**
	* Full qualified class name of validator
	* 
	* @var string|ValidatorInterface
	* 
	*/
	private $validatorInfo;
	
	/**
	* Factory to create new subject
	*  
	* @var string|FactoryInterface
	* 
	*/
	private $factoryInfo;

	/**
	* Constructor
	* 
	* @param string $type
	* @param string|object $subjectInfo
	* @param string|object $callbackInfo
	* @param array(string|object)|string|object $importorInfo
	* @param string|object $validatorInfo
	* @param string|FactoryInterface|null $factoryInfo
	* 
	* @throws \InvalidArgumentException
	*/	
	public function __construct($type, 
		$subjectInfo, $callbackInfo, $importorInfo, $validatorInfo, $factoryInfo = null
	)
	{
		$this->invalidateClassNotFoundExecption('subject', $subjectInfo);
		$this->invalidateClassNotFoundExecption('callback', $callbackInfo);
		$this->invalidateClassNotFoundExecption('importor', $importorInfo);
		$this->invalidateClassNotFoundExecption('validator', $validatorInfo);
		$this->invalidateClassNotFoundExecption('factory', $factoryInfo);
		
		$this->type = $type;
		$this->subjectInfo = $subjectInfo;
		$this->callbackInfo = $callbackInfo;
		
		if (!is_array($importorInfo))
			$this->importorInfo = array($importorInfo);
		else
			$this->importorInfo = $importorInfo;
		
		$this->validatorInfo = $validatorInfo;
		$this->factoryInfo = $factoryInfo;
	}
	
	private function invalidateClassNotFoundExecption($kind, $info)
	{
		if ($kind === 'subject')
		{
			if (!class_exists($info))
				throw new \InvalidArgumentException(sprintf("No %s class '%s' found.", $kind, $info));
		}
			
		if ($kind === 'callback')
		{
			if (!(new ReflectionClass($info))->implementsInterface(CallbackInterface::class))
				throw new \InvalidArgumentException(sprintf(
					"Callback Class must be instance of '%s'",
					CallbackInterface::class
				));
		}
		
		if ($kind === 'importor')
		{
			if (is_string($info) or is_object($info))
			{
				if (!(new ReflectionClass($info))->implementsInterface(ImportorInterface::class))
					throw new \InvalidArgumentException(sprintf(
						"Importor Class must implement interface '%s'",
						ImportorInterface::class
					));
			}
			else if (is_array($info))
			{
				foreach($info as $__info)
				{
					if (!(new ReflectionClass($__info))->implementsInterface(ImportorInterface::class))
						throw new \InvalidArgumentException(sprintf(
							"Importor Class must implement interface '%s'",
							ImportorInterface::class
						));
				}	
			}
			else
				throw new \InvalidArgumentException(sprintf("Importor info. must be string or object or array. Given %s.", gettype($info)));
		}
		
		if ($kind === 'validator')
		{
			if (!(new ReflectionClass($info))->implementsInterface(ValidatorInterface::class))
				throw new \InvalidArgumentException(sprintf(
					"Validator Class must implement interface '%s'",
					ValidatorInterface::class
				));
		}
		
		if ($kind === 'factory' and null !== $info)
		{
			if (!(new ReflectionClass($info))->implementsInterface(FactoryInterface::class))
				throw new \InvalidArgumentException(sprintf(
					"Factory Class must implement interface '%s'",
					FactoryInterface::class
				));
		}
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function getSubjectInfo()
	{
		return $this->subjectInfo;
	}
	
	public function getCallbackInfo()
	{
		return $this->callbackInfo;
	}

	public function getImportorInfo()
	{
		return $this->importorInfo;
	}
	
	public function getValidatorInfo()
	{
		return $this->validatorInfo;
	}

	public function getFactoryInfo()
	{
		return $this->factoryInfo;
	}
}
