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
abstract class AbstractObjectBuilder implements ObjectBuilderInterface
{
	/**
	* @var string
	*/
	private $objectType; 
	
	/**
	* @var object
	*/
	private $object;
	
	/**
	* @var CallbackInterface
	*/
	protected $callback;
	
	/**
	* 
	* @var ValidatorInterface
	* 
	*/
	protected $validator;
	
	/**
	* 
	* @var ImportorInterface
	* 
	*/
	protected $importor;
	
	/**
	* Constructor
	* 
	* @param CallbackInterface $callback
	* @param ImportorInterface $importor
	* @param ValidatorInterface $validator
	*/
	public function __construct(
		CallbackInterface $callback,
		ImportorInterface $importor,
		ValidatorInterface $validator
	)
	{
		$this->callback = $callback;
		$this->importor = $importor;
		$this->validator = $validator;
	}
	
	/**
	* @inheritdoc
	*/
	public function setObject($object)
	{
		if (null !== $object)
		{
			if ($this->object !== null)
				throw new \RuntimeException('Cannot set object twice.');	
				
			if (!is_object($object))
				throw new \InvalidArgumentException('object parameter is not object.');	
				
			if (!$this->supportObject($object))
				throw new \InvalidArgumentException(sprintf("Object with class '%s' is not supported.", get_class($object)));

			if ($this->objectType !== null)
				throw new \RuntimeException("Cannot set object type when object is not null. Call 'setObject' first.");	
		}
			
		$this->callback->assignSubject($object);
		$this->object = $object;
		
		return $this;
	}

	/**
	* @inheritdoc
	*/
	public function setObjectType($objectType)
	{
		if (!empty($objectType))
		{
			if ($this->objectType !== null)
				throw new \RuntimeException('Cannot set object type twice.');	

			if (!$this->supportObjectType($objectType))
				throw new \InvalidArgumentException(sprintf('Object type %s is not supported.', $objectType));
			if ($this->object !== null)
				throw new \RuntimeException("Cannot set object when object type is not null. Call 'setObjectType' first.");	
		}

		$this->objectType = $objectType;
			
		return $this;
	}

	protected function getObject()
	{
		return $this->object;
	}
	
	/**
	* @inheritdoc
	*/
	public function add($name, $type = null, $data = null)
	{
		if (!$this->addSupport($name, $type, $data))
			throw new \InvalidArgumentException(sprintf(
				"Cannot support add %s with type %s by data %s",
				$name, $type,
				is_object($data) ? get_class($data) : gettype($data)
			));
		
		$this->createObjectIfAny();

		$this->callback->add($name, $type, $data);
		
		return $this;
	}

	/**
	* @inheritdoc
	*/
	public function set($name, $data = null)
	{
		if ($this->canSet($name))
			throw new \InvalidArgumentException(sprintf("Cannot set %s", $name));
			
		$this->createObjectIfAny();

		$this->callback->set($name, $data);
		
		return $this;
	}

	public function canSet($name)
	{
		return $this->callback->canSet($name);
	}
	
	public function addSupport($name, $type, $data)
	{
		return $this->callback->addSupport($name, $type, $data);
	}
	
	/**
	* @inheritdoc
	*/
	public function map($name, $type = null, $data = null)
	{
		if (!$this->mapSupport($name, $type, $data))
			throw new \InvalidArgumentException(sprintf(
				"Cannot support map %s with type %s by data %s",
				$name, $type,
				is_object($data) ? get_class($data) : get_type($data)
			));

		$this->createObjectIfAny();

		$this->mapper->map($name, $type, $data);
		
		return $this;
	}

	public function mapSupport($name, $type, $data)
	{
		return $this->mapper->support($name, $type, $data);
	}
	
	protected function createObjectIfAny()
	{
		if ($this->object === null)
		{
			if (null === $this->objectType)
				throw new \RuntimeException("It must call 'setObject' or 'setObjectType' first.");
			
			$object = $this->createObject($this->objectType);
			
			$this->setObject($object);
		}
		
		return $this->getObject();
	}
	
	
	/**
	* @inheritdoc
	*/
	public function build()
	{
		$object = $this->createObjectIfAny();
		
		$this->validateObject($object, array('action' => 'build'));
	
		return $this->getObject();
	}

	/**
	* @inheritdoc
	*/
	public function reset()
	{
		$this->setObjectType(null);
		$this->setObject(null);
		
		return $this;
	}
	
	protected function validateObject($object, array $contexts)
	{
		$this->validator->validate($object, $contexts);		
	}
	
	/**
	* Import external data
	* 
	* @param mixed $data
	* @param array $contexts
	* 
	* @return this
	*/
	public function import($data, array $contexts = [])
	{
		if (!$this->importSupport($data))
			throw new \InvalidArgumentException(sprintf(
				"Cannot support importing from data. Data is given %s.",
				is_object($data) ? get_class($data) : get_type($data)
			));
	
		$this->createObjectIfAny();

		$this->importor->import($data, $this->getObject(), $contexts);
		
		return $this;
	}
	
	/**
	* Checks what data can import
	* 
	* @param mixed $data
	* 
	* @return bool
	*/
	public function importSupport($data)
	{
		return $this->importor->support($data, $this->getObject());
	}

	/**
	* Checks if object type can set
	* 
	* @param string $objectType
	* 
	* @return bool|null
	*/	
	abstract protected function supportObjectType($objectType);

	/**
	* Checks if object can set
	* 
	* @param object $object
	* 
	* @return bool|null
	*/	
	abstract protected function supportObject($object);

	/**
	* Create object
	* 
	* @param string $objectType
	* 
	* @return object
	*/
	abstract protected function createObject($objectType);
}
