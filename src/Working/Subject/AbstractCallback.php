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

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractCallback implements CallbackInterface
{
	/**
	* @var object
	*/	
	private $subject;
	
	/**
	* @var PropertyAccessorInterface
	*/
	private $propertyAccessor;
	
	/**
	* @var mixed
	*/
	private $validator;
	
	public function __construct(PropertyAccessorInterface $propertyAccessor = null,	$validator = null)
	{
		$this->propertyAccessor = $propertyAccessor;
		$this->validator = $validator;
	}
	
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
		if ($this->validator === null)
			return;
			
		try 
		{
			if (is_object($this->validator) and method_exists($this->validator, "validate"))
			{
				$this->validator->validate($subject);
			}
			else if (is_callable($this->validator))
			{
				call_user_func($this->validator, $subject);
			}
		}
		catch(\Exception $e)
		{
			throw new \InvalidArgumentException($e->getMessage());
		}		
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
	
	public function setPropertyAccessor(PropertyAccessorInterface $propertyAccessor)
	{
        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
	}
	
	/**
	* Validator should be one of formats:
	* + callback calls $subject to validate
	* + object has method validate that calls $subjet to validate
	* 
	* @param mixed $validator
	* 
	* @return void
	* @throws 
	*/
	public function setValidator($validator)
	{
		if (is_object($validator))
		{
			if (!method_exists($validator, "validate"))
				throw new \InvalidArgumentException("Object validator must have 'validate' method.");
		}
		else if (!is_callable($validator))
			throw new \InvalidArgumentException("Validator must be object or callable.");
		
		$this->validator = $validator;
	}
	
	/**
	* @inheritdoc
	*/
	public function get($name)
	{
		if (!$this->has($name))
			throw new \InvalidArgumentException(sprintf(
				"Callback cannot get '%s'. Call 'has' first to check.", $name
			));

		$accessor = $this->getAccessor();
		
		if ($accessor->isReadable($this, $name))
			return $accessor->getValue($this, $name);
			
		if ((new ReflectionClass($this))->hasProperty($this->changeSuffixMethodNameFromString($name, false)))
		{
			$prop = $this->changeSuffixMethodNameFromString($name, false);
			return $this->$prop;
		}
			
		if (null !== ($object = $this->getSubject()) and $accessor->isReadable($object, $name))
		{
			return $accessor->getValue($object, $name);
		}

		if (method_exists($this, ($method = 'get'.$this->changeSuffixMethodNameFromString($name))))
			return $this->$method();
	}
	
	/**
	* @inheritdoc
	*/
	public function set($name, $data)
	{
		if (!$this->canSet($name))
			throw new \InvalidArgumentException(sprintf(
				"Callback cannot write property '%s'. Call 'canSet' first to check.", $name
			));
		
		$accessor = $this->getAccessor();
		
		if ($accessor->isWritable($this, $name))
		{
			$accessor->setValue($this, $name, $data);
		}
		else if (method_exists($this, ($method = 'set'.$this->changeSuffixMethodNameFromString($name))))
		{
			$this->$method($data);
		}
		else if (null !== ($object = $this->getSubject()) and $accessor->isWritable($object, $name))
		{
			$accessor->setValue($object, $name, $data);
		}
	}

	/**
	* @inheritdoc
	*/
	public function has($name)
	{
		$accessor = $this->getAccessor();
		
		if ($accessor->isReadable($this, $name))
			return true;

		if ((new ReflectionClass($this))->hasProperty($this->changeSuffixMethodNameFromString($name, false)))
			return true;
			
		if (null !== ($object = $this->getSubject()) and $accessor->isReadable($object, $name))
			return true;
			
		if (method_exists($this, ($method = 'get'.$this->changeSuffixMethodNameFromString($name))))
			return true;
			
		return false;
	}
	
	/**
	* @inheritdoc
	*/
	public function canSet($name)
	{
		$accessor = $this->getAccessor();

		if ($accessor->isWritable($this, $name))
			return true;

		if (method_exists($this, ($method = 'set'.$this->changeSuffixMethodNameFromString($name))))
			return true;
			
		if (null !== ($object = $this->getSubject()) and $accessor->isWritable($object, $name))
			return true;
			
		return false;
	}
	
	/**
	* @inheritdoc
	*/
	public function add($name, $type, $data)
	{
		if (!$this->addSupport($name, $type, $data))
			throw new \InvalidArgumentException(sprintf('Cannot found %s element to add.', $name));

		if (method_exists($this, ($method = 'add'.$this->changeSuffixMethodNameFromString($name))))
			return $this->$method($type, $data);	
	}
	
	/**
	* @inheritdoc
	*/
	public function addSupport($name, $type, $data)
	{
		$method = 'add'.$this->changeSuffixMethodNameFromString($name);

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
	
	/**
	* Get Property accessor
	* 
	* @return PropertyAccessor
	*/
	private function getAccessor()
	{
		if ($this->propertyAccessor === null)
        	$this->propertyAccessor = PropertyAccess::createPropertyAccessor();
		
		return $this->propertyAccessor;		
	}
}
